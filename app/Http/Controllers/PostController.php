<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function getPosts(): Factory|View|Application
    {
        $posts = Post::with('user', 'category')
            ->published()
            ->orderBy('published_date', 'DESC')
            ->paginate(6);
        $categories = Category::all();

        $seo = [
            'seo_title' => 'Actualités',
            'meta_description' => 'Les dernières actualités de l\'association',
        ];

        return view('blog.index', compact('posts', 'categories', 'seo'));
    }

    public function category($slug): Factory|View|Application
    {

        $category = Category::where('slug', '=', $slug)->firstOrFail();
        $posts = Post::with('user', 'category')
            ->where('category_id', $category->id)
            ->published()
            ->orderBy('published_date', 'DESC')
            ->paginate(6);

        $categories = Category::all();

        $seo = [
            'seo_title' => $category->name . ' - Actualités',
            'meta_description' => $category->name . ' - Les dernières actualités de l\'association',
        ];

        return view('blog.index', compact('posts', 'category', 'categories', 'seo'));
    }

    public function post($categorySlug, $slug): Factory|View|Application
    {

        $post = Post::with('user', 'category')
            ->where('slug', $slug)
            ->firstOrFail();

        if ($post->category->slug !== $categorySlug) {
            return abort(404);
        }

        $seo = [
            'seo_title' => $post->title,
            'meta_description' => $post->meta_description,
        ];

        return view('blog.post', compact('post', 'seo'));
    }
}
