@extends('layouts.dashboard')

@section('title')
	Categorias
@endsection

@section('content')

  <div class="container-fluid">

		<div class="pull-left">
			<a href="{{ route('categories.create') }}" class="btn btn-primary">Nueva Categoria</a>
		</div>

		<div class="pull-right">
			<form class="" action="{{ route('categories.index') }}" method="GET">

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
	@if($categories) <?php $x=0; ?>
	<div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
		@forelse($categories as $cat)<?php $x++; ?>
				<tr>
					<td scope="row">{{ $x }}</td>
					<td>
					 <strong><a class="" href="{{ route('categories.edit', ['id' => $cat->idField() ]) }}" >
						 {{ $cat->nameCategorie() }}
					 </a></strong>
					</td>
				</tr>
		@empty
		</tbody>
	</table>
		  <p class="bg-warning padding-15">No hay Categorias Registradas</p>
		@endforelse
			</tbody>
		</table>
	</div>

	@else
	  <p>No hay Categorias Registradas</p>
	@endif

</div>

@endsection

@section('links')
	{{ $categories->links() }}
@endsection
