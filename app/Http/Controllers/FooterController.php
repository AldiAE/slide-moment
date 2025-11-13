<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        $menu_active = 'footers';
        $query = Footer::query();

        // Searching berdasarkan description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $footers = $query->orderBy('id', 'asc')->paginate(10);
        $footers->appends(['search' => $request->search]);

        return view('settings.footers.index', compact('footers', 'menu_active'))
            ->with('title', 'Footer');
    }

    public function create()
    {
        $menu_active = 'footers';
        return view('settings.footers.create', compact('menu_active'))
            ->with('title', 'Add Footer');
    }

    public function store(Request $request)
    {
        $menu_active = 'footers';
        $request->validate([
            'description' => 'nullable|string',
            'socials' => 'nullable|array',
        ]);

        Footer::create([
            'description' => $request->description,
            'socials' => $request->socials,
        ]);

        return redirect()->route('footers.index')
            ->withSuccess(['Footer created successfully.']);
    }

    public function edit(Footer $footer)
    {
        $menu_active = 'footers';
        return view('settings.footers.edit', compact('footer', 'menu_active'))
            ->with('title', 'Edit Footer');
    }

    public function update(Request $request, Footer $footer)
    {
        $menu_active = 'footers';
        $request->validate([
            'description' => 'nullable|string',
            'socials' => 'nullable|array',
        ]);

        $footer->update([
            'description' => $request->description,
            'socials' => $request->socials,
        ]);

        return redirect()->route('footers.index')
            ->withSuccess(['Footer updated successfully.']);
    }

    public function destroy(Footer $footer)
    {
        $menu_active = 'footers';
        $footer->delete();

        return redirect()->route('footers.index')
            ->withSuccess(['Footer deleted successfully.']);
    }
}
