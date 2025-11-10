<?php

namespace App\Http\Controllers;

use App\Models\Row;
use Illuminate\Http\Request;

class RowController extends Controller
{
    public function index()
    {
        return response()->json(Row::with(['page', 'section'])->get());
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'section_id' => 'required|exists:sections,id',
        'content' => 'nullable|string',
    ]);

    $row = \App\Models\Row::where('slug', $validated['slug'])->first();

    if ($row) {
        $row->update($validated);
        $status = 200;
    } else {
        $row = \App\Models\Row::create($validated);
        $status = 201;
    }

    return response()->json($row, $status);
}


    public function show($id)
    {
        $row = Row::with(['page', 'section'])->findOrFail($id);
        return response()->json($row);
    }

    public function update(Request $request, $id)
    {
        $row = Row::findOrFail($id);

        $validated = $request->validate([
            'page_id' => 'sometimes|exists:pages,id',
            'section_id' => 'sometimes|exists:sections,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|string|max:255',
        ]);

        $row->update($validated);
        return response()->json($row);
    }

    public function destroy($id)
    {
        $row = Row::findOrFail($id);
        $row->delete();

        return response()->json(['message' => 'Row deleted successfully']);
    }
}
