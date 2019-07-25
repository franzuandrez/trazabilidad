<nav aria-label="breadcrumb" role="navigation">

    <ol class="breadcrumb">
        <li class="active"><i class=" fa {{$menu_icon}} "></i> {{$menu}}</li>
        <li class="active"><i class=" fa {{$submenu_icon}}  "></i> {{$submenu}}</li>
        @if($operation != 'LIST')
        <li class="active"><i class=" fa {{$operation_icon}}  "></i> {{$operation}}</li>
        @endif
    </ol>

</nav>