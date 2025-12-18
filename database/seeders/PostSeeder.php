<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'category_id' => 1,
            'title' => 'Welcome to the Blog',
            'slug' => 'welcome-to-the-blog',
            'excerpt' => 'This is the first blog post.',
            'content' => 'Full blog post content goes here.',
            'status' => 'published'
        ]);
    }
}
