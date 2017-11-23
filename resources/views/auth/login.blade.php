@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-6 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">

                  <div class="row">
                    <div class="thumb-div">
                      <a href="#" class="thumbnail">
                          <img width="100%" src="{{ Storage::disk('public')->url( "img/logo.png") }}" alt="Logo">
                      </a>
                    </div>
                  </div>


                  <h3 class="panel-title text-center">Login</h3>
                </div>

                @if (session('logout'))
                 <div class="alert alert-info" role="alert">
                   {{ session('logout') }}
                 </div>
                @endif

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('loginUsuario') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="loginUsuario" type="text" class="form-control" name="loginUsuario" value="{{ old('loginUsuario') }}"  autofocus placeholder="User">

                                @if ($errors->has('loginUsuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('loginUsuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('claveUsuario') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="claveUsuario" type="password" class="form-control" name="claveUsuario"  placeholder="Password">

                                @if ($errors->has('claveUsuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('claveUsuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-1">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-1">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
