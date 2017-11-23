@extends('layouts.dashboard')

@section('title')
	Productos
@endsection

@section('content')

  <div class="container-fluid">

		<div class="pull-left">
			<a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
		</div>

		<div class="pull-right">
			<form class="" action="{{ route('users.index') }}" method="GET">

		    <div class="input-group custom-search-form">
		        <input class="form-control" placeholder="Search..." type="text" name="param" value="{{ old('param') }}">
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
	@if($users) <?php $x=0; ?>
	<div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
		@foreach($users as $user)<?php $x++; ?>
				<tr>
					<td scope="row">{{ $x }}</td>
					<td>
					 <img src="{{ Storage::disk('public')->url( ($user->avatar) ? $user->avatar : "avatars/default.png") }}"
					 class="thumbnail miniatura" >
					 <strong><a class="" href="{{ route('users.edit', ['id' => $user->idField() ]) }}" >
						 {{ $user->getNameUser() }}
					 </a></strong>
					</td>
					<td>{{ $user->getEmailForPasswordReset() }}</td>
				</tr>
		@endforeach
			</tbody>
		</table>
	</div>

	@else
	  <p>No hay Usuarios Registrados</p>
	@endif

</div>

@endsection

@section('links')
	{{ $users->links() }}
@endsection
