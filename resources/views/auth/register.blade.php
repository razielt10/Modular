@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('loginUsuario') ? ' has-error' : '' }}">
                            <label for="loginUsuario" class="col-md-4 control-label">User</label>

                            <div class="col-md-6">
                                <input id="loginUsuario" type="text" class="form-control" name="loginUsuario" value="{{ old('loginUsuario') }}" required>

                                @if ($errors->has('loginUsuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('loginUsuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('emailUsuario') ? ' has-error' : '' }}">
                            <label for="loginUsuemailUsuarioario" class="col-md-4 control-label">E-mail</label>

                            <div class="col-md-6">
                                <input id="emailUsuario" type="text" class="form-control" name="emailUsuario" value="{{ old('emailUsuario') }}" required>

                                @if ($errors->has('emailUsuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emailUsuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('claveUsuario') ? ' has-error' : '' }}">
                            <label for="claveUsuario" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="claveUsuario" type="password" class="form-control" name="claveUsuario" required>

                                @if ($errors->has('claveUsuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('claveUsuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="claveUsuario-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="claveUsuario-confirm" type="password" class="form-control" name="claveUsuario_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
