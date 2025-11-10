<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Menampilkan daftar semua halaman.
     */
    public function index(Request $request)
    {
        $title = 'Pages';
        $menu_active = 'pages';
        $pages = Page::orderBy('created_at', 'desc');

        if (!empty($request->search)) {
            $pages = $pages->where('title', 'ilike', '%' . $request->search . '%');
        }

        $pages = $pages->paginate(10);

        return view('pages.index', compact('title', 'pages', 'menu_active'));
    }

    /**
     * Form tambah page baru.
     */
    public function create()
    {
        $title = 'Create Page';
        return view('pages.create', compact('title'));
    }

    /**
     * Simpan page baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pages', 'public');
        }

        Page::create($validated);

        return redirect()->route('pages.index')->withSuccess(['Page created successfully.']);
    }

    /**
     * Form edit page.
     */
    public function edit(Page $page)
    {
        $title = 'Edit Page';
        return view('pages.edit', compact('title', 'page'));
    }

    /**
     * Simpan hasil edit page.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }
            $validated['image'] = $request->file('image')->store('pages', 'public');
        }

        $page->update($validated);

        return redirect()->route('pages.index')->withSuccess(['Page updated successfully.']);
    }

    /**
     * Hapus page.
     */
    public function destroy(Page $page)
    {
        if ($page->image) {
            Storage::disk('public')->delete($page->image);
        }

        $page->delete();

        return redirect()->route('pages.index')->withSuccess(['Page deleted successfully.']);
    }
}
