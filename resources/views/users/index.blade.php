@extends('layouts.app')

@section('content')

	<div class="container">
		
		@include('partials.links')
			  @include('partials.errors')
		
@if($users->count()>0)

@foreach($users->chunk(Config::get('constants.options.option_columns_quantity')) as $chunk)
<div class="row">
	@foreach($chunk as  $user)
	<div class="col-md-4">
		<div class="card card-default">

			<div class="card-header">
				@if(!$user->isAdmin())
				<h1>{{$user->role}}</h1>
				<form method="POST" action="{{route('users.make-admin', $user->id)}}">
					@csrf
					<button type="submit" class="btn btn-success btn-sm">Make Admin</button>
				</form>
@else
<h1>{{$user->role}}</h1>
<form method="POST" action="{{route('users.undo-admin', $user->id)}}">
					@csrf
					<button type="submit" class="btn btn-success btn-sm">Undo Admin role</button>
				</form>
@endif

				<div class="row">About</div>
				<div>{{$user->email}}</div>
				<br>
				{{$user->name}}</div>
			<div class="card-body">
		Avatar
		</div>
		<div class="card-footer">
			{{$user->content}}
		</div>
			
	</div>
	</div>

	@endforeach
</div>

@endforeach
	
@else
<h1>There's no users at the time</h1>
@endif

</div>
@endsection
