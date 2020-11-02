<div class="row">
    @include('operaciones.trazabilidad.search')
    @if($producto_trazabilidad!=null)
        @include('operaciones.trazabilidad.producto_trazabilidad')
    @endif
</div>

@include('operaciones.trazabilidad.eventos')
