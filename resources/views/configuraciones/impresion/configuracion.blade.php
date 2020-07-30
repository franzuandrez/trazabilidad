<div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
    <div class="form-group">
        <label for="DATO_INICIAL">{{$configuracion['descripcion']}}</label>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
        <input
            name="{{$configuracion['configuracion']}}"
            {{$configuracion['readonly']==1?'disabled':'' }}
            value="{{$configuracion['valor']}}"
            class="form-control valor">
    </div>
</div>
@if(count($configuracion['extras'] ) > 0)
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul>
            @foreach($configuracion['extras'] as $key=>$extra)
                <li><b>{{$key}}</b> : {{$extra}}</li>
            @endforeach
        </ul>
    </div>
@endif
