@extends('layouts.app')

@section('content')

	<div class="container">
		
		@include('partials.links')
			  @include('partials.errors')
		
@if($posts->count()>0)

@foreach($posts->chunk(Config::get('constants.options.option_columns_quantity')) as $chunk)
<div class="row">
	@foreach($chunk as  $post)
	<div class="col-md-4">
		<div class="card card-default">

			<div class="card-header">
				
				<div class="row">
					@if($post->trashed())
				<form action="{{route('restore-post', $post->id)}}" method="POST">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-success">Restore</button>
				</form>
				@else
				<a class="btn btn-success" href="{{route('posts.edit', $post->id)}}">Edit</a>
				@endif
				<form method="POST" action="{{route('posts.destroy', $post->id)}}">
					@csrf
					@method('DELETE')
					@if($post->trashed())
					<button type="submit" class="btn btn-danger">Delete completely</button>
					@else
					<button type="submit" class="btn btn-danger">Archive</button>
					@endif
				</form>
				</div>

				<div>


					Category <a href="{{route('categories.edit', $post->category->id)}}">{{$post->category->name}}</a></div>
				<br>

				{{$post->title}}
				


			</div>
			<div class="card-body">
		<img src="{{asset('storage/'.$post->image)}}" width="100%">
		</div>
		<div class="card-footer">
			{{$post->content}}
		</div>
			
	</div>
	</div>

	@endforeach
</div>

@endforeach
	
@else
<h1>There's no posts at the time. <a href="{{route('posts.create')}}">Create one!</a></h1>
@endif

</div>
@endsection
