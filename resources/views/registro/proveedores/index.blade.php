@extends('layouts.admin')
@section('contenido')

@component('componentes.nav',['operation'=>'LIST',
'menu_icon'=>'fa-file-text',
'submenu_icon'=>'fa fa-users',
'operation_icon'=>'',])
    @slot('menu')
        Registro
    @endslot
    @slot('submenu')
        Proveedores
    @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        @component('componentes.btn-create',['url'=>url('registro/proveedores/create')])
        @endcomponent
        @component('componentes.btn-edit',['url'=>'javascript:editar()'])
        @endcomponent
        @component('componentes.btn-ver',['url'=>'javascript:ver()'])
        @endcomponent
        @component('componentes.btn-eliminar',['url'=>'javascript:eliminar()'])
        @endcomponent


    </div>
</div>



<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                    <tr>
                        <th>
                            Razon Social
                        </th>
                        <th>
                            Nombre Comercial
                        </th>
                        <th>
                            NIT
                        </th>
                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection