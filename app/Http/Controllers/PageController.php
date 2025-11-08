<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // ✅ Menampilkan semua halaman
    public function index()
    {
        // return response()->json(Page::all());
        $pages = Page::with(['sections.rows'])->get();
        return response()->json($pages);
    }

    // ✅ Menyimpan halaman baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'image' => 'nullable|string|max:255',
    ]);

    // 🧠 Cek apakah slug sudah ada
    $page = \App\Models\Page::where('slug', $validated['slug'])->first();

    if ($page) {
        // 🔄 Jika sudah ada, update data
        $page->update($validated);
        $status = 200;
    } else {
        // 🆕 Jika belum ada, buat baru
        $page = \App\Models\Page::create($validated);
        $status = 201;
    }

    return response()->json($page, $status);
}


    // ✅ Menampilkan detail halaman tertentu
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return response()->json($page);
    }

    // ✅ Mengupdate halaman tertentu
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:pages,slug,' . $page->id,
            'image' => 'nullable|string|max:255',
        ]);

        $page->update($validated);
        return response()->json($page);
    }

    // ✅ Menghapus halaman
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return response()->json(['message' => 'Page deleted successfully']);
    }
}

