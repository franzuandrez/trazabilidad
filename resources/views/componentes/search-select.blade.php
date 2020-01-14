    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="id_select_search">{{$busqueda}}</label>
            <select name="id_select_search"
                    id="id_select_search"
                    class="form-control selectpicker"
                    onchange="buscar_existencias()">
                <option value="">SELECCIONE AREA</option>
                <option value="0">{{$default}}</option>
                @foreach( $elements as $e )
                    <option value="{{$e->id}}">{{$e->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>
