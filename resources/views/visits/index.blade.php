@extends('layouts.dashboard')

@section('title')
	Ficha Personal (Personas)
@endsection

@section('content')

  <div class="container-fluid">

		<div class="pull-left">
			<a href="{{ route('personalfile.create') }}" class="btn btn-info">
				<span class="fa fa-plus fa-fw"></span>
				Nueva Persona</a>
		</div>

		<div class="pull-right">
			<form class="" action="{{ route('personalfile.index') }}" method="GET">

		    <div class="input-group custom-search-form">
		        <input class="form-control" placeholder="Buscar" type="text"
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


<div class="row">
	@if($personalfile) <?php $x=0; ?>
	<div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Cédula</th>
					<th>Pasaporte</th>
					<th>DNI/Precaria</th>
					<th>Localidad</th>
					<th>Estado Civil</th>
					<th>Vivo</th>
				</tr>
			</thead>
			<tbody>
		@foreach($personalfile as $person)<?php $x++; ?>
				<tr>
					<td scope="row">{{ $x }}</td>
					<td>
					 <img src="{{ Storage::disk('public')->url( ($person->avatar)
						  ? $person->avatar : "avatars/default.png") }}"
					 class="thumbnail miniatura" >
					 <strong><a class="" href="{{ route('personalfile.edit',
						  ['id' => $person->idField() ]) }}" >
						 {{ $person->getFullName() }}
					 </a></strong>
					</td>
					<td>{{ $person->personalID }}</td>
					<td>{{ $person->passportNumber }}</td>
					<td>Ninguno</td>
					<td>Algun Sitio</td>
					<td>{{ $person->civilStateName() }}</td>
					<td>{{ $person->aliveName() }}</td>
				</tr>
		@endforeach
			</tbody>
		</table>
	</div>

	@else
	  <p>No hay Personas Registradas</p>
	@endif

</div>

@endsection

@section('links')
	{{ $personalfile->links() }}
@endsection
