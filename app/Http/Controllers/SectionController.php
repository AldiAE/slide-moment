<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Sections';
        $menu_active = 'sections';
        $sections = Section::with('page')->orderBy('created_at', 'desc');

        if (!empty($request->search)) {
            $sections = $sections->where('title', 'ilike', '%' . $request->search . '%');
        }

        $sections = $sections->paginate(10);

        return view('sections.index', compact('title', 'sections', 'menu_active'));
    }

    public function create()
    {
        $title = 'Create Section';
        $pages = Page::all();
        return view('sections.create', compact('title', 'pages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link_title' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sections', 'public');
        }

        Section::create($validated);

        return redirect()->route('sections.index')->withSuccess(['Section created successfully.']);
    }

    public function edit(Section $section)
    {
        $title = 'Edit Section';
        $pages = Page::all();
        return view('sections.edit', compact('title', 'section', 'pages'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link_title' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('sections', 'public');
        }

        $section->update($validated);

        return redirect()->route('sections.index')->withSuccess(['Section updated successfully.']);
    }

    public function destroy(Section $section)
    {
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->route('sections.index')->withSuccess(['Section deleted successfully.']);
    }
}
