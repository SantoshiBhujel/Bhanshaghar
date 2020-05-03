<?php

namespace App\Http\Controllers;

use auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']])||$this->middleware('admin');
        
    }

    public function index() // /posts route ley ya point garcha,, layout ko blog ma ra tala store function ley ya redirect garcha
    {
        
        $posts= Post::all();
        
        return view('posts.posts')->with('posts',$posts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //post create garna lai form display garcha
    {
        //
        return view('posts.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  //naya post store garcha
    {
        $this->validate($request,[
            'title'=> 'required',
            'body'=> 'required',
            'cover_image'=>'image | nullable | max:2047',
        ]);

        // if(!Auth::user())  mathi authentication constructor use garena vane yeari garna milcha 
        // {
        //     return redirect('/posts/create')->with('posterror','You have to login first');
        // }

        if($request->hasFile('cover_image'))
        {
            //Get file original name with extension
            $fileNameWithExt= $request->file('cover_image')->getClientOriginalName();
            //Get file name only
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get extension only
            $extension= $request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path=$request->file('cover_image')->storeAs('public/posts_images',$fileNameToStore);

        }
        else
        {
            $fileNameToStore='noimage.jpg';
        }

        $post= new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->users_id=  auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        //return 123;
   
        return redirect()->route('posts.personal')->with('success','Post Created');
    }


    /** 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->with('posts',$post);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //edit garna page display garcha
    {
        $post= Post::find($id);
        return view('posts.edit')->with('post',$post);
    
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //edit page ko update request ya aucha
    {
        $this->validate($request,[
            'title'=> 'required',
            'body'=> 'required',
            'cover_image'=>'image | max:2047',
        ]);
        
        if($request->hasFile('cover_image'))
        {
            //Get file original name with extension
            $fileNameWithExt= $request->file('cover_image')->getClientOriginalName();
            //Get file name only
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //Get extension only
            $extension= $request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path=$request->file('cover_image')->storeAs('public/posts_images',$fileNameToStore);
        }
        
        $post= Post::find($id);
        if(Gate::denies('update-post',$post))
        {
            return response()->json('Unauthorized access', 404);
            //abort ('404',' Sorry you cannot update');
        }
        $post->title = $request->title;
        $post->body = $request->body;
        if($request->hasFile('cover_image'))
        {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
       
        return redirect('/posts')->with('success','Post Updated'); 
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  // post delete garne
    {
        $post=Post::find($id);
        if($post->cover_image!='noimage.jpg')
        {
            //Delete the image from storge as well i.e. store vako folder bata nai delete garne
            Storage::delete('public/posts_images'.$post->cover_image); 
        }
        $post->delete();

        return redirect()->route('posts.personal')->with('success','Post Deleted');
    }

    /**
     * Display the blog of the logged in user
     * 
     */
    public function personal()
    {
        $user_id= auth()->user()->id;
        // print_r($user_id);
        $user=User::find($user_id);
        //$posts=$user->Posts;
       //print_r($posts);
        return view('posts.personalpost')->with('posts',$user->Posts);
    }
}
