<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
            ->where('status', 'published')
            ->latest()
            ->paginate(5);

        return view('frontend.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $headings = collect();
        $content = $post->content;

        preg_match_all('/<h([2-5])[^>]*>(.*?)<\/h\1>/i', $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $text = strip_tags($match[2]);
            $id = Str::slug($text);

            $headings->push([
                'level' => $match[1],
                'text'  => $text,
                'id'    => $id,
            ]);

            // inject id into heading
            $content = preg_replace(
                '/<h'.$match[1].'([^>]*)>'.preg_quote($match[2], '/').'<\/h'.$match[1].'>/i',
                '<h'.$match[1].'$1 id="'.$id.'">'.$match[2].'</h'.$match[1].'>',
                $content,
                1
            );
        }

        return view('frontend.blog.show', [
            'post'     => $post,
            'headings' => $headings,
            'content'  => $content,
        ]);
    }
}
