@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-tasks',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Racks
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'registro/racks/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LOCALIDAD</label>
            <select name="id_localidad" class="form-control selectpicker" id="localidades" onchange="cargarBodegas()">
                <option value="">SELECCIONAR LOCALIDAD</option>
                @foreach($localidades as $localidad)
                    <option value="{{$localidad->id_localidad}}">{{$localidad->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">BODEGA</label>
            <select name="id_bodega" id="bodegas" class="form-control selectpicker" onchange="cargarSectores()">
                <option value="">SELECCIONAR BODEGA</option>

            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">SECTOR</label>
            <select name="id_sector" id="sectores" class="form-control selectpicker" onchange="cargarPasillos()">
                <option value="">SELECCIONAR SECTOR</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">PASILLOS</label>
            <select name="id_pasillo"
                    required
                    id="pasillos" class="form-control selectpicker">
                <option value="">SELECCIONAR PASILLO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras"
                   required
                   value="{{old('codigo_barras')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion"
                   required
                   value="{{old('descripcion')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">LADO</label>
            <select name="lado"
                    required
                    id="lado" class="form-control selectpicker">
                <option value="">SELECCIONAR LADO</option>
                <option value="A" >A</option>
                <option value="B" >B</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/racks')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection

@section('scripts')
    <script>
        function cargarBodegas(){


            let idLocalidad = $('#localidades option:selected').val();
            idLocalidad = idLocalidad =="" ? 0 : idLocalidad;
            $.ajax({

                url :   "{{url('registro/bodegas_by_localidad/')}}" +"/"+idLocalidad ,
                type:   "get",
                dataType:  "json",
                success : function(response){

                    let bodegas = $('#bodegas');
                    let sectores = $('#sectores');
                    let pasillos = $('#pasillos');
                    clearSelect(bodegas);
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    response.bodegas.forEach(function(e){
                        addToSelect(e.id_bodega,e.descripcion,bodegas);
                    })
                },
                error: function(e){

                }

            })


        }
        function cargarSectores(){


            let idBodega = $('#bodegas option:selected').val();
            idBodega = idBodega =="" ? 0 : idBodega;
            $.ajax({

                url :   "{{url('registro/sectores_by_bodega/')}}" +"/"+idBodega ,
                type:   "get",
                dataType:  "json",
                success : function(response){

                    let sectores = $('#sectores');
                    let pasillos = $('#pasillos');
                    clearSelect(sectores);
                    clearSelect(pasillos);
                    response.sectores.forEach(function(e){
                        addToSelect(e.id_sector,e.descripcion,sectores);
                    })
                },
                error: function(e){

                }

            })


        }

        function cargarPasillos(){


            let idSector = $('#sectores option:selected').val();
            idSector = idSector =="" ? 0 : idSector;
            $.ajax({

                url :   "{{url('registro/pasillos_by_sector/')}}" +"/"+idSector ,
                type:   "get",
                dataType:  "json",
                success : function(response){

                    let pasillos = $('#pasillos');
                    clearSelect(pasillos);
                    response.pasillos.forEach(function(e){
                        addToSelect(e.id_pasillo,e.descripcion,pasillos);
                    })
                },
                error: function(e){

                }

            })


        }
        function clearSelect(select){

            $(select).find('option:not(:first)').remove();
            $(select).selectpicker('refresh');
        }
        function addToSelect(value,txt,select){

            let option = `<option value='${value}'>${txt}</option>`;
            $(select).append(option);
            $(select).selectpicker('refresh');
        }

    </script>
@endsection
