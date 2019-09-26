<table class='table table-responsive'>
    <tr>
        @foreach( $headers as $header )
            <th>{{$header}}</th>
        @endforeach
    </tr>
    <tr>
        @foreach( $examples as $ex )
            <td>{{$ex}}</td>
        @endforeach
    </tr>
</table>
