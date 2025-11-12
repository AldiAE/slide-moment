<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
{
    $footers = Footer::orderBy('id', 'asc')->paginate(10);

    return view('settings.footers.index', compact('footers'))
        ->with('title', 'Footer');
}


    public function create()
    {
        return view('settings.footers.create')
            ->with('title', 'Add Footer');
    }

    public function store(Request $request)
    {
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
        return view('settings.footers.edit', compact('footer'))
            ->with('title', 'Edit Footer');
    }

    public function update(Request $request, Footer $footer)
    {
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
        $footer->delete();

        return redirect()->route('footers.index')
            ->withSuccess(['Footer deleted successfully.']);
    }
}
