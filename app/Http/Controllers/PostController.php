<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts(): Factory|View|Application
    {
        $posts = BlogPost::where('status', '=', 'PUBLISHED')->orderBy('published_date', 'DESC')->paginate(6);
        $categories = Category::all();

        $seo = [
            'seo_title' => 'Actualités',
            'seo_description' => 'Les dernières actualités de l\'association',
        ];

        foreach ($posts as $post) {
            $post->user = User::where('id', '=', $post->author_id)->first();
        }

        return view('blog.index', ['posts' => $posts, 'categories' => $categories, 'seo' => $seo]);
    }

    public function category($slug): Factory|View|Application
    {

        $category = Category::where('slug', '=', $slug)->firstOrFail();
        $posts = BlogPost::where('status', '=', 'PUBLISHED')->where('category_id', '=', $category->id)->orderBy('published_date', 'DESC')->paginate(6);
        $categories = Category::all();

        $seo = [
            'seo_title' => $category->name . '- Actualités',
            'seo_description' => $category->name . '- Les dernières actualités de l\'association',
        ];

        foreach ($posts as $post) {
            $post->user = User::where('id', '=', $post->author_id)->first();
        }

        return view('blog.index', compact('posts', 'category', 'categories', 'seo'));
    }

    public function post($category, $slug): Factory|View|Application
    {

        $post = BlogPost::where('slug', '=', $slug)->firstOrFail();
        $category = Category::where('slug', '=', $category)->firstOrFail();

        $seo = [
            'seo_title' => $post->title,
            'seo_description' => $post->seo_description,
        ];

        return view('blog.post', compact('post', 'seo'));
    }
}
