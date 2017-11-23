@extends('layouts.dashboard')

@section('title')
<a href="{{ route('categories.index') }}"><i class="fa fa-chevron-circle-left fa-fw">
	<span class="tooltiptext">Volver</span>
</i></a>
 Nueva Categoria
@endsection

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-body">
	                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('categories.store') }}" id="add-form">
												<fieldset >
	                        {{ csrf_field() }}

	                        <div class="form-group{{ $errors->has('nameCategorie') ? ' has-error' : '' }}">
	                            <label for="nameCategorie" class="col-md-4 control-label">Nombre</label>

	                            <div class="col-md-6">
	                                <input id="nameCategorie" type="text" class="form-control" name="nameCategorie" value="{{ old('nameCategorie')?? 'primera' }}" >

	                                @if ($errors->has('nameCategorie'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('nameCategorie') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary" id="send-button">
	                                    Guardar
	                                </button>
	                            </div>
	                        </div>
												</fieldset>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('add-js')

<script src="{{ asset('node_modules/jquery-validation/dist/jquery.validate.min.js') }}" ></script>
<script src="{{ asset('node_modules/jquery-validation/dist/additional-methods.js') }}" ></script>
<script src="{{ asset('js/admin/categories/new.js') }}" ></script>
@endsection
