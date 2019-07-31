<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="input-group">
            <input class="form-control" id="search"
                   value="{{ $search }}"
                   onkeydown="if (event.keyCode == 13) ajaxLoad('{{url($modulo)}}?search='+this.value)"
                   placeholder="Buscar" name="search"
                   type="text" id="search"/>
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"
                        onclick="ajaxLoad('{{url($modulo)}}?search='+$('#search').val())"
                >
                    <i class="fa fa-search" aria-hidden="true"></i>

                </button>
                <button type="submit" class="btn btn-default"
                        onclick="ajaxLoad('{{url($modulo)}}?search=')"
                >
                    <i class="fa fa-trash" aria-hidden="true"></i>

                </button>
            </div>
        </div>
    </div>

</div>
<br>