@extends('layouts.dashboard')

@section('title')
<a href="{{ route('users.index') }}"><i class="fa fa-chevron-circle-left fa-fw">
  	<span class="tooltiptext">Volver</span>
</i></a>
 Editar Usuario
@endsection

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-body">
                      <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('users.update', ['id' => $user->idField() ]) }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('loginUsuario') ? ' has-error' : '' }}">
                              <label for="loginUsuario" class="col-md-4 control-label">User</label>

                              <div class="col-md-6">
                                  <input id="loginUsuario" type="text" class="form-control" name="loginUsuario" value="{{ $user->getNameUser() }}" required>

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
                                  <input id="emailUsuario" type="text" class="form-control" name="emailUsuario" value="{{ $user->getEmailForPasswordReset() }}" required>

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
														<label for="avatar" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12">
                                  <img src="{{ Storage::disk('public')->url( ($user->avatar) ? $user->avatar : "avatars/default.png") }}"
                                   class="thumbnail miniatura" >
                                </div>

    														<div class="col-md-12">
                                  Selecciona para cambiar:
    										        	<input name="avatar" id="avatar" type="file" class="" value="">
    														</div>
                              </div>
                            </div>

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary">
                                      Guardar
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
