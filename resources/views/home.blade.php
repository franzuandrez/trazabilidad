@extends('layouts.admin')

@section('content')

@endsection
@section('scripts')
    <script>

        if(document.getElementsByClassName('navbar-nav').length == 2){
            document.getElementsByClassName('navbar-nav')[0].children[0].classList.add("open")
            document.getElementById('mynavbar-content').classList.add('in');
        }
    </script>
@endsection
