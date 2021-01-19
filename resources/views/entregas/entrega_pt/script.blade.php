<script src="{{asset('js-brc/tools/lectura_codigo.js')}}">

</script>
<script>
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const CODIGO_DUN_14 = 1;
    const LOTE = 3;
    var PRODUCTO_PT = null;
    var UNIDADES_ENTREGADAS = 0;
    var CAJAS_ENTREGADAS = 0;

    function limpiar_producto() {
        document.getElementById('codigo').value = '';
        PRODUCTO_PT = null;
    }

    function mostar_info_producto(data) {
        document.getElementById('descripcion_producto').value = data.producto.descripcion;
    }

    function buscar_producto() {

        const codigo = descomponerInput(document.getElementById('codigo'), false);
        $('.loading').show();

        if (codigo[CODIGO_DUN_14] !== document.getElementById('codigo_dun_14').value) {
            alert("Producto incorrecto");
            return;
        }
        if (codigo[LOTE] !== document.getElementById('lote').value) {
            alert("Lote incorrecto");
            return;
        }
        $.ajax({
            url: "{{url('produccion/entrega_pt/buscar_producto?lote=')}}" + codigo[LOTE],
            type: "get",
            dataType: "json",
            success: function (response) {
                const data = response.data.trazabilidad;
                if (data !== null) {
                    if (response.esta_entregado) {
                        alert("Producto ya entregado");
                    } else {
                        mostar_info_producto(data);
                        limpiar_producto();
                        PRODUCTO_PT = data;
                        UNIDADES_ENTREGADAS = response.data.unidades_entregadas;
                        CAJAS_ENTREGADAS = response.data.cajas_entregadas;
                        document.getElementById('cantidad').focus();
                    }
                } else {
                    alert("Producto no encontrado");
                }
                $('.loading').hide();
            },
            error: function (e) {
                alert("Producto no encontrado");
                console.log(e);
                $('.loading').hide();
            }
        })
    }

    function agregar_producto() {


        let no_tarima = document.getElementById('no_tarima').value;
        if (no_tarima === "") {
            document.getElementById('no_tarima').focus();
            alert("No. Tarima en blanco");
            return;
        }

        if (!es_valida()) {
            document.getElementById('cantidad').focus();
            alert("Cantidad no valida");
            return;
        }

        let id_entrega = document.getElementById('id_entrega').value;
        let cantidad = document.getElementById('cantidad').value;
        let unidad_medida = document.getElementById('unidad_medida').value;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/entrega_pt/agregar_producto')}}",
            type: "post",
            dataType: "json",
            data: {
                id: id_entrega,
                id_control: PRODUCTO_PT.id_control,
                cantidad: cantidad,
                no_tarima: no_tarima,
                unidad_medida: unidad_medida

            },
            success: function (response) {

                if (response.success) {
                    add_to_table();
                    document.getElementById('id_entrega').value = response.data.id_enc;
                    limpiar_formulario();
                } else {
                    alert('Algo salió mal ,' + response.data);
                }
                $('.loading').hide();
            },
            error: function (e) {
                alert('Algo salió mal ,' + e.message);
                console.log(e);
                $('.loading').hide();
            }
        })

    }

    function limpiar_formulario() {


        document.getElementById('descripcion_producto').value = "";
        document.getElementById('no_tarima').value = "";
        limpiar_producto();
    }

    function add_to_table() {


        let codigo_interno = PRODUCTO_PT.producto.codigo_interno;
        let unidad_medida = document.getElementById('unidad_medida').value;
        let cantidad = document.getElementById('cantidad').value;
        let no_tarima = document.getElementById('no_tarima').value;
        let lote = document.getElementById('lote').value;
        let td_cantidad = document.getElementById(lote + '-' + unidad_medida + '-' + no_tarima);
        let esta_agregado = td_cantidad !== null;

        if (esta_agregado) {
            td_cantidad.innerText = (parseFloat(td_cantidad.innerText) + parseFloat(cantidad)).toString();
            ;
        } else {
            let row = `<tr>
            <td>${codigo_interno}</td>
            <td>${unidad_medida}</td>
            <td id="${lote + '-' + unidad_medida + '-' + no_tarima}"> ${cantidad}</td>
            <td>${no_tarima}</td>
            </tr>`;

            $('#detalle').prepend(row);
        }

    }

    function es_valida() {

        const unidad_medidad = (document.getElementById('unidad_medida').value);
        const cantidad = document.getElementById('cantidad').value;

        let es_valida;
        if (unidad_medidad === 'CA') {
            es_valida = cantidad <= getCajas() && getCajas() > 0;
        } else {
            es_valida = cantidad <= getUnidades() && getUnidades() > 0;
        }
        return es_valida;
    }

    function getUnidades() {

        if (PRODUCTO_PT) {

            return parseInt(PRODUCTO_PT.cantidad_producida % PRODUCTO_PT.producto.cantidad_unidades) - UNIDADES_ENTREGADAS;
        }
        return 0;
    }

    function getCajas() {

        if (PRODUCTO_PT) {
            return parseInt(PRODUCTO_PT.cantidad_producida / PRODUCTO_PT.producto.cantidad_unidades) - CAJAS_ENTREGADAS;
        }
        return 0;
    }
</script>
