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


    function confirmar_producto() {


        const info_codigo_barras = descomponerInput(document.getElementById('codigo_confirmacion_producto'), false);

        const lote_digitado = info_codigo_barras[3];
        const codigo_dun_producto_digitado = info_codigo_barras[1];

        const lote = "{{$control_trazabilidad->lote}}"
        const codigo_dun_producto = "{{$control_trazabilidad->producto->codigo_dun}}"

        console.log(lote,codigo_dun_producto)
        if (lote_digitado != lote) {
            alert("Lote incorrecto");
            return;
        }

        if (codigo_dun_producto_digitado != codigo_dun_producto) {
            alert("Producto incorrecto");
            return;
        }


        document.getElementById('confirmar_producto').style.display= 'none';

    }


    function modal_guardar() {

        const tarimas_sin_finalizar = document.getElementsByClassName('label-warning').length
        if (tarimas_sin_finalizar > 0) {
            alert("Tarima sin finalizar");
            return;
        }

        $('#modal_guardar').modal();
    }

    function limpiar_producto() {
        document.getElementById('codigo').value = '';
        PRODUCTO_PT = null;
    }

    function mostar_info_producto(data) {
        document.getElementById('descripcion_producto').value = data.producto.descripcion;
    }


    function buscar_no_tarima() {

        let no_tarima = document.getElementById('no_tarima').value;

        if (no_tarima === "") {
            document.getElementById('no_tarima').focus();
            alert("No. Tarima en blanco");
            return;
        }


        const id_control = document.getElementById('id_control').value;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/entrega_pt/buscar_no_tarima')}}",
            type: "get",
            dataType: "json",
            data: {
                id_control: id_control,
                no_tarima: no_tarima

            },
            success: function (response) {

                if (response.success) {
                    document.getElementById('no_tarima').disabled = true;
                    document.getElementById('codigo').focus();
                } else {
                    alert(response.data);
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

    function buscar_producto() {

        const codigo = document.getElementById('codigo').value;
        const id_control = document.getElementById('id_control').value;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/entrega_pt/buscar_producto?sscc=')}}" + codigo,
            type: "get",
            data: {
                id_control: id_control,
            },
            dataType: "json",
            success: function (response) {

                if (response.success) {
                    const data = response.data.trazabilidad;
                    if (data !== null) {
                        if (response.esta_entregado) {
                            alert("Producto ya entregado");
                        } else {
                            PRODUCTO_PT = data;
                            UNIDADES_ENTREGADAS = response.data.unidades_entregadas;
                            CAJAS_ENTREGADAS = response.data.cajas_entregadas;
                            document.getElementById('no_tarima').focus();
                            agregar_producto();
                        }
                    } else {
                        alert("Producto no encontrado");
                    }
                } else {
                    alert(response.data);
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


    async function agregar_producto() {


        let no_tarima = document.getElementById('no_tarima').value;

        if (no_tarima === "") {
            document.getElementById('no_tarima').focus();
            alert("No. Tarima en blanco");
            return;
        }
        let sscc = document.getElementById('codigo').value;
        if (sscc === "") {
            document.getElementById('codigo').value
            alert("SSCC en blanco");
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
                unidad_medida: unidad_medida,
                sscc: sscc

            },
            success: function (response) {

                if (response.success) {
                    add_to_table();
                    document.getElementById('id_entrega').value = response.data.id_enc;
                    document.getElementById('codigo').focus();
                    document.getElementById('codigo').value = "";
                    document.getElementById('cantidad').value = 1;
                } else {
                    alert(response.data);
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
        //limpiar_producto();
    }

    function add_to_table() {


        let unidad_medida = document.getElementById('unidad_medida').value;
        let cantidad = document.getElementById('cantidad').value;
        let no_tarima = document.getElementById('no_tarima').value.trim();
        let sscc = document.getElementById('codigo').value;
        let lote = document.getElementById('lote').value;
        let td_cantidad = document.getElementById(lote + '-' + unidad_medida + '-' + no_tarima + '-' + sscc);
        let esta_agregado = td_cantidad !== null;

        if (esta_agregado) {
            td_cantidad.innerText = (parseFloat(td_cantidad.innerText) + parseFloat(cantidad)).toString();

        } else {
            const tarima_existente = document.getElementById('tarima-' + no_tarima);
            let row = '';
            if (tarima_existente) {

                const current_row = parseInt(tarima_existente.rowSpan);
                tarima_existente.rowSpan = current_row + 1;

                $('#tarima-' + no_tarima + '-' + current_row).after(function () {
                    return `<tr id=tarima-${no_tarima}-${parseInt(tarima_existente.rowSpan)} >
                <td>${sscc}</td>
                <td>${unidad_medida}</td>
                <td id="${lote + '-' + unidad_medida + '-' + no_tarima + '-' + sscc}"> ${cantidad}</td>
            </tr>`;
                });
            } else {
                row = `<tr id='tarima-${no_tarima}-1'>
                <td>${sscc}</td>
                <td>${unidad_medida}</td>
                <td id="${lote + '-' + unidad_medida + '-' + no_tarima + '-' + sscc}"> ${cantidad}</td>
                <td id='tarima-${no_tarima}' >${no_tarima}
                      <label class="label label-warning">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                        </label>
                </td>
            </tr>`;
                $('#detalle').prepend(row);
            }

        }


    }


    function terminar_tarima() {

        let no_tarima = document.getElementById('no_tarima').value.trim();

        if (no_tarima === "") {
            document.getElementById('no_tarima').focus();
            alert("No. Tarima en blanco");
            return;
        }

        const id_control = document.getElementById('id_control').value;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/entrega_pt/terminar_tarima')}}",
            type: "post",
            dataType: "json",
            data: {
                id_control: id_control,
                no_tarima: no_tarima,
            },
            success: function (response) {

                if (response.success) {
                    alert('Tarima terminada');
                    document.getElementById('no_tarima').disabled = false;
                    cambiar_a_terminado(no_tarima);
                } else {
                    alert(response.data);
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

    function cambiar_a_terminado(no_tarima) {
        console.log(document.getElementById('tarima-' + no_tarima));
        console.log(document.getElementById('tarima-' + no_tarima).children[0]);
        console.log(document.getElementById('tarima-' + no_tarima).children[0].children[0]);

        document.getElementById('tarima-' + no_tarima).children[0].classList.remove('label-warning');
        document.getElementById('tarima-' + no_tarima).children[0].classList.add('label-success');
        document.getElementById('tarima-' + no_tarima).children[0].children[0].classList.add('fa-check');
        document.getElementById('tarima-' + no_tarima).children[0].children[0].classList.remove('fa-info');
    }

    function limpiar_tarima() {
        document.getElementById('no_tarima').value = '';
        document.getElementById('no_tarima').disabled = false;
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
