@extends('layouts.app')


@section('content')
<div><a href="{{ route('posts.create') }}">Create new post</a>
    <a href="{{ route('posts.index') }}">All Posts</a>
    <a href="{{ route('trashed-posts.index') }}">Archived posts</a>
    <a href="{{ route('categories.create') }}">Create new Category</a></div>
<div class="d-flex justify-content-end mb-2">

	<a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
</div>
<div class="card card-default">
	<div class="card-header">Categories</div>
  <div class="card-body">
    @if($categories->count()>0)
    <table class="table">
    <thead>
      <th>Name</th>
      <th>Post Count</th>
      <th></th>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <td>
          {{$category->name}}
        </td>
        <td>
          {{$category->post->count()}}
        </td>
        <td>

          <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm ">Edit</a>
          <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
        </td>
      </tr>

      @endforeach
    </tbody>
  </table>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form action="" method="POST" id="deleteCategoryForm">
@method('DELETE')
@csrf
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="text-center text-bold">
        Please confirm that you want to delete this category
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
    <h1>There's no categories yet. <a href="{{route('categories.create')}}">Create one!</a></h1>

    @endif
  </div>
	
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
    function handleDelete(id){
    	//Get form
    	var form = document.getElementById('deleteCategoryForm');
    	//Make form submit to specific category with id
    	form.action = '/categories/'+id;
    	//Ask before deleting
    	$('#deleteModal').modal('show');
    }
  </script>
@endsection