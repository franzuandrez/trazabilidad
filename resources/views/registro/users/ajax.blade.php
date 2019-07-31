@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection
@section('contenido')
<div id="content">
    @include('registro.users.index')
</div>
<div class="loading">
    <i class="fa fa-refresh fa-spin "></i><br/>
    <span>Cargando</span>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection