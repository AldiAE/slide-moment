<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        return response()->json(Section::with('page')->get());
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'page_id' => 'required|exists:pages,id',
        'content' => 'nullable|string',
    ]);

    $section = \App\Models\Section::where('slug', $validated['slug'])->first();

    if ($section) {
        $section->update($validated);
        $status = 200;
    } else {
        $section = \App\Models\Section::create($validated);
        $status = 201;
    }

    return response()->json($section, $status);
}


    public function show($id)
    {
        $section = Section::with('page')->findOrFail($id);
        return response()->json($section);
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);

        $validated = $request->validate([
            'page_id' => 'sometimes|exists:pages,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'link_title' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
        ]);

        $section->update($validated);
        return response()->json($section);
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return response()->json(['message' => 'Section deleted successfully']);
    }
}
