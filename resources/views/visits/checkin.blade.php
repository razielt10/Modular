@extends('layouts.dashboard')

@section('title')
	Visitas de Personas
@endsection

@section('content')

  <div class="container-fluid">

		<div class="pull-left">
			<a href="{{ route('visits.create') }}" class="btn btn-info">
				<span class="fa fa-plus fa-fw"></span>
				Nueva Visita</a>
		</div>

		<div class="pull-right">
			<form class="" action="{{ route('visits.index') }}" method="GET">

		    <div class="input-group custom-search-form">
		        <input class="form-control" placeholder="Buscar Visitas" type="text"
						 name="param" value="{{ old('param') }}">
		        <span class="input-group-btn">
		            <button class="btn btn-primary" type="submit">
		                <i class="fa fa-search"></i>
		            </button>
		    </span>
		    </div>
		    <!-- /input-group -->

			</form>
		</div>
	</div>


@endsection
