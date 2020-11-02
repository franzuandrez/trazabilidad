{{--
$campo_busqueda -------> Es el campo por el cual se hará la busqueda.
$campos_busqueda ---------->son los campos disponibles para hacer una busqueda.
$search ---------> Es el texto a buscar.
$sort   ---------->Tipo de ordenamiento (asc ó desc).
$sortField --------> El campo por el cual se hará el ordenamiento.
--}}
<div class="row">

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

        <div class="input-group ">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        id="btn_campo_busqueda"
                        aria-expanded="true">
                    @if($id_estado=="0")
                        Pendiente
                    @else
                        Despachada
                    @endif

                    <span class="fa fa-caret-down"></span>
                </button>

                <ul class="dropdown-menu" id="options">
                    <input type="hidden"
                           value="{{$id_estado}}"
                           id="campo_busqueda">

                    <li>
                        <a href="javascript:setCampoBusqueda('0')">
                            Pendiente
                        </a>
                    </li>


                    <li>
                        <a href="javascript:setCampoBusqueda('1')">
                            Despachada
                        </a>
                    </li>

                </ul>
            </div>

            <input class="form-control"
                   value="{{ $search }}"
                   onkeydown="if (event.keyCode == 13)
                       ajaxLoad(('{{Request::url()}}?search='+encodeURIComponent(this.value)+'&sort={{$sort}}&field={{$sortField}}&id_estado='+document.getElementById('campo_busqueda').value))"
                   placeholder="Buscar" name="search"
                   type="text" id="search"/>
            <span class="input-group-btn">
                    <button type="submit" class="btn  btn-flat btn-default"
                            onclick=" ajaxLoad('{{Request::url()}}?search='+encodeURIComponent(document.getElementById('search').value)+'&sort={{$sort}}&field={{$sortField}}&id_estado='+document.getElementById('campo_busqueda').value)"
                    >
                        <i class="fa fa-search" aria-hidden="true"></i>

                    </button>
                    <button type="submit" class="btn  btn-flat btn-default"
                            onclick="ajaxLoad('{{Request::url()}}?search=')"
                    >
                        <i class="fa fa-trash" aria-hidden="true"></i>

                    </button>
                </span>

        </div>

    </div>
</div>


<br>
<script>


    setTimeout(function () {
        var options = document.getElementById('options');
        options.addEventListener('click', function (evt) {
            if (evt.target.tagName == "A") {
                document.getElementById('btn_campo_busqueda').childNodes[0].data = evt.target.text + ' ';

            }
        })
    }, 10);

    function setCampoBusqueda(value) {
        document.getElementById('campo_busqueda').value = value;
    }
</script>
