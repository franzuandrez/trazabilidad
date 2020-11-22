@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-list-ol',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Categoria Clientes
        @endslot
    @endcomponent



    {!!Form::model($categoria,['method'=>'PATCH','route'=>['categoria_clientes.update',$categoria->id_categoria]])!!}
    {{Form::token()}}
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">
                DESCRIPCION
            </label>
            <input type="text" name="descripcion" value="{{$categoria->descripcion}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tipo_documento">TIPO DOCUMENTO</label>
            <select name="tipo_documento" class="form-control selectpicker">

                @foreach($tipos_documentos as $tipo )

                    @if($tipo->codigo == $categoria->tipo_documento)
                        <option selected value="{{$tipo->codigo}}">{{$tipo->descripcion}} </option>
                    @else
                        <option value="{{$tipo->codigo}}">{{$tipo->descripcion}} </option>
                    @endif
                @endforeach

            </select>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="impresion_recibo">IMPRESION RECIBO</label>
            <select name="impresion_recibo" class="form-control selectpicker">
                @if($categoria->impresion_recibo == 1)
                    <option selected value="1">SI</option>
                    <option  value="0">NO</option>
                @else
                    <option  value="1">SI</option>
                    <option selected value="0">NO</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/categoria_clientes ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>


        </div>
    </div>


    {!!Form::close()!!}
@endsection
