<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:pages',
            'content' => 'required',
            'status' => 'required',
            'show_in_menu' => 'nullable|boolean',
            'menu_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'show_in_menu' => $request->has('show_in_menu'),
            'menu_order' => $request->menu_order ?? 0,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created');
    }



    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|unique:pages,title,' . $page->id,
            'status' => 'required',
            'show_in_menu' => 'nullable|boolean',
            'menu_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'show_in_menu' => $request->has('show_in_menu'),
            'menu_order' => $request->menu_order ?? 0,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Updated');
    }



    public function destroy(Page $page)
    {
        $page->delete();
        return back()->with('success','Deleted');
    }
}
