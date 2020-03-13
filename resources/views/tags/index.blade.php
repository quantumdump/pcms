@extends('layouts.app')


@section('content')
<div><a href="{{ route('posts.create') }}">Create new post</a>
    <a href="{{ route('posts.index') }}">All Posts</a>
    <a href="{{ route('trashed-posts.index') }}">Archived posts</a>
    <a href="{{ route('tags.create') }}">Create new Tag</a></div>
<div class="d-flex justify-content-end mb-2">

	<a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
</div>
<div class="card card-default">
  @include('partials.links')
	<div class="card-header">Tags</div>
  <div class="card-body">
    @if($tags->count()>0)
    <table class="table">
    <thead>
      <th>Name</th>
      <th>Post Count</th>
      <th></th>
    </thead>
    <tbody>
      @foreach($tags as $tag)
      <tr>
        <td>
          {{$tag->name}}
        </td>
        <td>
          {{$tag->post->count()}}
        </td>
        <td>

          <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info btn-sm ">Edit</a>
          <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
        </td>
      </tr>

      @endforeach
    </tbody>
  </table>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form action="" method="POST" id="deleteTagForm">
@method('DELETE')
@csrf
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="text-center text-bold">
        Please confirm that you want to delete this tag
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Confirm and Delete</button>
      </div>
    </div>
    
   </form>
  </div>
</div>

    @else
    <h1>There's no tags yet. <a href="{{route('tags.create')}}">Create one!</a></h1>

    @endif
  </div>
	
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
    function handleDelete(id){
    	//Get form
    	var form = document.getElementById('deleteTagForm');
    	//Make form submit to specific tag with id
    	form.action = '/tags/'+id;
    	//Ask before deleting
    	$('#deleteModal').modal('show');
    }
  </script>
@endsection