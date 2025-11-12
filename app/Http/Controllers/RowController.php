<?php

namespace App\Http\Controllers;

use App\Models\Row;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;

class RowController extends Controller
{
    /**
     * Display a listing of the rows.
     */
    public function index(Request $request)
    {
        $title = 'Rows';
        $sub_title = 'Manage all rows';
        $menu_active = 'rows'; // ✅ tambahkan ini seperti di SectionController

        // 🔍 Tambahkan fitur pencarian (sama seperti SectionController)
        $rows = Row::with(['page', 'section'])->orderBy('created_at', 'desc');

        if (!empty($request->search)) {
            $rows = $rows->where('title', 'ilike', '%' . $request->search . '%');
        }

        $rows = $rows->paginate(10); // gunakan pagination agar identik dengan sections

        return view('rows.index', compact('title', 'sub_title', 'rows', 'menu_active'));
    }

    /**
     * Show the form for creating a new row.
     */
    public function create()
    {
        $pages = Page::with('sections')->get();

        return view('rows.create', [
            'title' => 'Rows',
            'sub_title' => 'Create Row',
            'pages' => $pages,
        ]);
    }

    /**
     * Store a newly created row in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'section_id' => 'required|exists:sections,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('rows', 'public');
    }

        Row::create($validated);

        return redirect()->route('rows.index')
            ->withSuccess(['Row created successfully.']);
    }

    /**
     * Show the form for editing the specified row.
     */
    public function edit(Row $row)
    {
        $pages = Page::with('sections')->get();

        return view('rows.edit', [
            'title' => 'Rows',
            'sub_title' => 'Edit Row',
            'row' => $row,
            'pages' => $pages,
        ]);
    }

    /**
     * Update the specified row in storage.
     */
    public function update(Request $request, Row $row)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'section_id' => 'required|exists:sections,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $row->update($validated);

        return redirect()->route('rows.index')
            ->withSuccess(['Row updated successfully.']);
    }

    /**
     * Remove the specified row from storage.
     */
    public function destroy(Row $row)
    {
        $row->delete();

        return redirect()->route('rows.index')
            ->withSuccess(['Row deleted successfully.']);
    }
}
