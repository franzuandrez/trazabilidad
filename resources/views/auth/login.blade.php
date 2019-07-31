@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="panel-body" align="center">
                <div class="alert alert-warning">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-1">


                <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>

                @csrf
                <div class="panel-body" align="center">

                    <div class="col-md-6 col-md-offset-4" >
                        <input type="image" src="{{('img/Login_WebRUTEO_GBC.png')}}">
                        <br>
                        <br>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}" >
                            <div class="col-md-7 col-md-offset-4">
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="name" type="text" class="form-control" name="username" value="{{ old('username') }}" >


                                </div>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-7 col-md-offset-4">
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" >
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordar
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                <button type="submit" id="acceder" class="btn btn-primary">

                                    <i class="fa fa-btn fa-sign-in"></i> Acceder
                                </button>


                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
