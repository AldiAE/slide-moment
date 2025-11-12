<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeaderController extends Controller
{
    public function index()
    {
        $headers = Header::orderBy('id', 'asc')->get();
        return view('settings.headers.index', compact('headers'))
            ->with('title', 'Header Management');
    }

    public function create()
    {
        $parents = Header::whereNull('parent_id')->get();
        return view('settings.headers.create', compact('parents'))
            ->with('title', 'Add Header');
    }

    public function store(Request $request)
    {
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
        $parents = Header::whereNull('parent_id')->where('id', '!=', $header->id)->get();
        return view('settings.headers.edit', compact('header', 'parents'))
            ->with('title', 'Edit Header');
    }

    public function update(Request $request, Header $header)
    {
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
        $header->delete();
        return redirect()->route('headers.index')
            ->withSuccess(['Header deleted successfully.']);
    }
}
