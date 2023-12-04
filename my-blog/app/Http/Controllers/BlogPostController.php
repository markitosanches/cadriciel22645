<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select * from blog_posts; 
        $blogs = BlogPost::all();
       // return $blog;
       // return view('blog.index', ['blogs'=> $blogs]);
       return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create () -> insert into .......
        // last inserted id ?
        // select * from... where Id = last inserted
       
        $newBlog = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => 1,
        ]);

        //return $newBlog;
        return redirect(route('blog.show', $newBlog->id))->withSuccess('Article enregistré!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {

        //New BlogPost
        //$blogPost = select * from blog_posts where id = $blogPost
        
        //return $blogPost;
        return view('blog.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('blog.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect(route('blog.show', $blogPost->id))->withSuccess('Article mis a jour!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect(route('blog.index'))->withSuccess('Article effacé!');;
    }
}
