<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Tag;




class PostController extends Controller
{
    //Constructor
    public function __construct(){
  $this->middleware('verifyCategoriesCount')->only(['create', 'store']);


}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)

    {
//dd($request);
        $image = $request->image->store('posts');
       $post = Post::create([
'title'=>$request->title,
'description'=>$request->description,
'content'=>$request->content,
'image' =>$image,
'category_id'=>$request->category,
//'published_at'=>''
]);

       if($request->tags){

  $post->tags()->attach($request->tags);
}

//Put a session message
session()->flash('success', 'Post created successfully!');

//Redirect
return redirect(route('posts.index'));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)

    {
        //

        if($request->tags){
  $post->tags()->sync($request->tags);
}




      $post->update([
'title'=> $request->title,
'content' => $request->content,
'description'=> $request->description,
'category_id'=>$request->category,
]);
//Put a session message
session()->flash('success', 'Post updated successfully!');
return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        //if post is archived, delete it!
        if($post->trashed()){
           $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Post deleted completely successfully');
            return redirect(route('trashed-posts.index'));
        }else{
            //If post is not archived, archive it
            $post->delete();
            session()->flash('success', 'Post archived successfully');
            return redirect(route('posts.index'));
        }
        

        
        
    }
    //////////////
    public function trashed(){
  $trashed = Post::onlyTrashed()->get();
  return view('posts.index')->with('posts', $trashed);
}

//restores the archived post
public function restore($id){
    $post = Post::withTrashed()->where('id', $id)->firstOrFail();
    $post->restore();
       session()->flash('success', 'Post restored successfully');
            return redirect(route('posts.index'));
}

}
