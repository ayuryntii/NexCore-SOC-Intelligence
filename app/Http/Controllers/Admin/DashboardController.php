<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'published' => Post::published()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
