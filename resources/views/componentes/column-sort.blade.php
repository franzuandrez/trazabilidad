<a href="javascript:ajaxLoad('{{
Request::url().'?field='.$field.'&sort='.($sort=='asc'?'desc':'asc').'&search='.$search
}}')">
    {{strtoupper($titulo)}}



@if($sortField==$field)
    @if($sort=='asc')
        <i class="fa fa-sort-asc" aria-hidden="true"></i>
    @else
        <i class="fa fa-sort-desc" aria-hidden="true"></i>
    @endif
@else
    <i class="fa fa-sort" aria-hidden="true"></i>
@endif
</a>
