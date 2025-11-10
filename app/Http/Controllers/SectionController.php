<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the sections.
     */
    public function index()
    {
        $sections = Section::with('page')->latest()->get();

        return view('sections.index', [
            'title' => 'Sections',
            'sub_title' => 'Manage all sections',
            'sections' => $sections,
        ]);
    }

    /**
     * Show the form for creating a new section.
     */
    public function create()
    {
        $pages = Page::all();

        return view('sections.create', [
            'title' => 'Sections',
            'sub_title' => 'Create Section',
            'pages' => $pages,
        ]);
    }

    /**
     * Store a newly created section in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'link_title' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
        ]);

        Section::create($validated);

        return redirect()->route('sections.index')
            ->withSuccess(['Section created successfully.']);
    }

    /**
     * Show the form for editing the specified section.
     */
    public function edit(Section $section)
    {
        $pages = Page::all();

        return view('sections.edit', [
            'title' => 'Sections',
            'sub_title' => 'Edit Section',
            'section' => $section,
            'pages' => $pages,
        ]);
    }

    /**
     * Update the specified section in storage.
     */
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'link_title' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
        ]);

        $section->update($validated);

        return redirect()->route('sections.index')
            ->withSuccess(['Section updated successfully.']);
    }

    /**
     * Remove the specified section from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')
            ->withSuccess(['Section deleted successfully.']);
    }
}
