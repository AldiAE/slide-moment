<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeaderController extends Controller
{
    public function index(Request $request)
    {
        $menu_active = 'headers';
        $query = Header::query();

        // Jika ada keyword pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        // Pagination (10 per halaman)
        $headers = $query->orderBy('id', 'asc')->paginate(10);

        // Agar pagination tetap membawa keyword search
        $headers->appends(['search' => $request->search]);

        return view('settings.headers.index', compact('headers', 'menu_active'))
            ->with('title', 'Header');
    }

    public function create()
    {
        $menu_active = 'headers';
        $parents = Header::whereNull('parent_id')->get();
        return view('settings.headers.create', compact('parents', 'menu_active'))
            ->with('title', 'Add Header');
    }

    public function store(Request $request)
    {
        $menu_active = 'headers';
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:headers,id',
        ]);

        Header::create([
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('headers.index')
            ->withSuccess(['Header created successfully.']);
    }

    public function edit(Header $header)
    {
        $menu_active = 'headers';
        $parents = Header::whereNull('parent_id')->where('id', '!=', $header->id)->get();
        return view('settings.headers.edit', compact('header', 'parents', 'menu_active'))
            ->with('title', 'Edit Header');
    }

    public function update(Request $request, Header $header)
    {
        $menu_active = 'headers';
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:headers,id',
        ]);

        $header->update([
            'parent_id' => $request->parent_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->route('headers.index')
            ->withSuccess(['Header updated successfully.']);
    }

    public function destroy(Header $header)
    {
        $menu_active = 'headers';
        $header->delete();
        return redirect()->route('headers.index')
            ->withSuccess(['Header deleted successfully.']);
    }
}
