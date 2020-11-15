@extends('layouts.app')

@section('content')
<div class="card">
	@include('partials.links')
	<div class="card-header">Create Post</div>
	
  <div class="card-body">

           @include('partials.errors')

<form method="POST" action="
@if(isset($post))
{{route('posts.update', $post->id)}}
@else
{{route('posts.store')}}
@endif
" enctype="multipart/form-data">
    @csrf
             @if(isset($post))
  @method('PUT')
@endif
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" id="title" name="title" value="@if(isset($post))
{{$post->title}}
@endif
">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description">@if(isset($post)){{$post->description}}
@endif
</textarea>

        </div>
        <div class="form-group">
            <label for="content">Content</label>
           <input id="content" type="hidden" name="content" value="@if(isset($post))
{{$post->content}}
@endif">
  <trix-editor input="content"></trix-editor>
        </div>

          @if(isset($post))
          <div class="form-group">
{{$post->image}}
</div>
@else
   <div class="form-group">
            <label for="image">Image</label>
            <input class="form-control" type="file" name="image">
            
        </div>
@endif
<div class="form-group">
	<label for="category">Category</label>

<select name="category" id="category" class="form-control">
	@if($categories->count()>0)
	@foreach($categories as $category)
	<option value="{{$category->id}}"
		@if(isset ($post))
		    
		@if($category->id==$post->category_id)
		selected

		@endif
		@endif

		>{{$category->name}}</option>

	@endforeach
	@else
	<option value=""></option>
	@endif
</select>
 </div>	
         @if($tags->count()>0)

  <div class="form-group">
  <label for="tags">Tags</label>
  
  <select name="tags[]" id="tags" class="form-control" multiple>
    @foreach($tags as $tag)
<option 
@if(isset($post))
@if($post->hasTag($tag->id))
selected
@endif
@endif

 value="{{$tag->id}}">
  {{$tag->name}}
</option>

    @endforeach
  </select>

</div>
 @endif


          <div class="form-group">
            <label for="published_at">Published at</label>
            <input type="date" class="form-control" name="published_at">
        </div>

 <div class="form-group">

            <button type="submit" class="btn btn-success">@if(isset($post))
            	Update
@else
  Submit
@endif

            </button>
            
        </div>
        
        
    </form>

 </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/trix.js')}}"></script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/trix.css')}}">
@endsection