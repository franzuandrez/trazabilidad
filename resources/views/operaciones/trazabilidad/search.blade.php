<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="input-group">
        <input class="form-control" id="search"
               value="{{ $search }}"
               onkeydown="if (event.keyCode == 13)
                   ajaxLoad('{{Request::url()}}?search='+this.value)"
               placeholder="Buscar" name="search"
               type="text" id="search"/>
        <div class="input-group-btn">
            <button type="submit" class="btn btn-primary"
                    onclick="ajaxLoad('{{Request::url()}}?search='+$('#search').val())"
            >
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <button type="submit" class="btn btn-primary"
                    onclick="ajaxLoad('{{Request::url()}}?search=')"
            >
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>



