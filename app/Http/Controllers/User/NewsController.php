<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category', 'user')->published();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->latest()->paginate(9);
        $categories = Category::all();

        if ($request->ajax()) {
            return view('user.news.partials.grid', compact('posts'))->render();
        }

        return view('user.news.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'user'])->where('slug', $slug)->published()->firstOrFail();
        $related = Post::where('category_id', $post->category_id)->where('id', '!=', $post->id)->published()->limit(3)->get();
        
        return view('user.news.show', compact('post', 'related'));
    }
}
