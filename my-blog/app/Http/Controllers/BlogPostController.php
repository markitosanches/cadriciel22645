<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::check()){
            $blogs = BlogPost::all();
            return view('blog.index', compact('blogs'));
        // }
        // return redirect(route('login'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::categorySelect();
        //return $categories;
        return view('blog.create', compact('categories'));
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
            'category_id' =>  $request->category_id,
            'user_id' => Auth::user()->id,
        ]);

        // $newBlog = new BlogPost;
        // $newBlog->fill($request->all()); 
        // $newBlog->user_id =  Auth::user()->id;
        // $newBlog->save();



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
       // $categories = Category::select()->orderby('category')->get();
        
       $categories = Category::categorySelect();

       return view('blog.edit', compact('blogPost', 'categories'));
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
            'category_id' =>  $request->category_id,
        ]);


        // $blogPost->fill($request->all()); 
        // $blogPost->save();



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

    public function pagination(){
       // $blogs = BlogPost::all();
        $blogs = BlogPost::select()->paginate(5);

        return view('blog.pagination', compact('blogs'));
    }

    public function query(){
        //select * from blog_posts;
        //$blog = BlogPost::all();

        //$blog = BlogPost::Select('title', 'body')->get();
        
         //select * from blog_posts orderby id desc limit 1;
        //$blog = BlogPost::Select()->orderby('id', 'desc')->first();

        //$blog = BlogPost::where('id', 1)->get();

        //select * from table where id = ?; // fetch
       // $blog = BlogPost::find(1);

        //select title, body from blog_posts where title like 'a%'orderby title;
       //$blog = BlogPost::select('title', 'body')->where('title','like', 'Article%')->orderby('title')->get();

       //AND - SELECT * FROM TABLE WHERE user_id = 1 AND title like  '%te%';
        //$blog = BlogPost::select()->where('user_id',1)->where('title', 'like', '%te%')->get();

        //OR
        //$blog = BlogPost::select()->where('user_id',1)->orWhere('id', 4)->get();

        //INNER
        //Select * from blog_posts INNER JOIN users on  user_id = users.id;
        $blog = BlogPost::select()
                        ->join('users', 'user_id','=','users.id')
                        ->get();

        //OUTER
        //Select * from blog_posts RIGHT OUTER JOIN users on  user_id = users.id;
        $blog = BlogPost::select()
                        ->rightJoin('users', 'user_id','=','users.id')
                        ->get();
        

        //$blog = BlogPost::select('title', 'body')->where('title', 'Article')->orderby('title')->count();
        
        // $blog = BlogPost::max('id');

        //Raw Query
        // SELECT count(*) as blogs, user_id
        // FROM my_blog.blog_posts
        // group by user_id;

        // $blog = BlogPost::select(DB::raw('count(*) as blogs, user_id'))
        //     ->groupBy('user_id')
        //     ->get();

        $blog = BlogPost::find(1);

        return $blog->blogHasUser->name;

    }


}
