<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display all published blog posts
     */
    public function index()
    {
        $blogs = Blog::published()
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', compact('blogs'));
    }

    /**
     * Display a single blog post
     */
    public function show($slug)
    {
        $blog = Blog::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('blog.show', compact('blog'));
    }
}