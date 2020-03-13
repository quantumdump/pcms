@extends('layouts.app')


@section('content')
 @include('partials.errors')
<div class="card card-default">
	@include('partials.links')
	<div class="card-header">
		{{isset($tag)? 'Edit Tag': 'Create Tag'}}
	</div>
	<div class="card-body">
		@if($errors->any())
		<div class="alert alert-danger">
			<ul class="list-group">
				@foreach($errors->all() as $error)
				<li class="list-group-item text-danger">{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form action="{{ isset($tag)? route('tags.update', $tag->id) : route('tags.store')}}" method="POST">
			@csrf
			@if (isset($tag))
				@method('PUT')
			@endif
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text"  id="name" name="name" class="form-control" value="{{isset($tag)? $tag->name: ''}}"></input>
			</div>
			<div class="form-group">
				<button class="btn btn-success">{{isset($tag)? 'Edit Tag': 'Add Tag'}}</button>
			</div>
		</form>
	</div>
</div>
@endsection
