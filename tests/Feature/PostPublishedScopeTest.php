<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PostPublishedScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_scope_only_returns_public_posts(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Actualites',
            'slug' => 'actualites',
        ]);

        $published = Post::create([
            'title' => 'Visible',
            'slug' => 'visible',
            'body' => 'Body',
            'status' => Post::STATUS_PUBLISHED,
            'published_date' => Carbon::now()->subHour(),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        Post::create([
            'title' => 'Brouillon',
            'slug' => 'brouillon',
            'body' => 'Body',
            'status' => Post::STATUS_DRAFT,
            'published_date' => Carbon::now()->subHour(),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        Post::create([
            'title' => 'Planifie',
            'slug' => 'planifie',
            'body' => 'Body',
            'status' => Post::STATUS_PUBLISHED,
            'published_date' => Carbon::now()->addHour(),
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $visiblePostIds = Post::query()->published()->pluck('id');

        $this->assertCount(1, $visiblePostIds);
        $this->assertTrue($visiblePostIds->contains($published->id));
    }
}

