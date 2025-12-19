<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|unique:posts,title',
            'content' => 'required',
            'status' => 'required|in:published,draft',
            'featured_image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['category_id', 'title', 'content', 'excerpt', 'status']);
        $data['slug'] = Str::slug($request->title);

        $post = Post::create($data);

        if ($request->hasFile('featured_image')) {
            $post->addMediaFromRequest('featured_image')->toMediaCollection('featured_images');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');

    }

    public function ckeditorUpload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:4096', // CKEditor sends file in "upload"
        ]);

        $path = $request->file('upload')->store('posts/content', 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($path),
        ]);
    }


    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|unique:posts,title,' . $post->id,
            'content' => 'required',
            'status' => 'required|in:published,draft',
            'featured_image' => 'nullable|image|max:2048',
           // 'gallery_images' => 'nullable|array',
           // 'gallery_images.*' => 'image|max:4096',
        ]);

        $data = $request->only(['category_id', 'title', 'content', 'excerpt', 'status']);
        $data['slug'] = Str::slug($request->title);

        $post->update($data);

        // Handle featured image with Spatie
        if ($request->hasFile('featured_image')) {
            // Remove old featured image
            $post->clearMediaCollection('featured_images');

            $post->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_images');
        }

        // Handle gallery images
//        if ($request->hasFile('gallery_images')) {
//            foreach ($request->file('gallery_images') as $img) {
//                $post->addMedia($img)
//                    ->toMediaCollection('post_images');
//            }
//        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }


    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            \Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return back()->with('success', 'Post deleted successfully.');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
}
