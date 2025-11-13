<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventGallery;
use App\Models\EventGalleryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Events';
        $menu_active = 'events';
        $events = Event::orderBy('created_at', 'desc');

        if (!empty($request->search)) {
            $events = $events->where('title', 'ilike', '%' . $request->search . '%');
        }

        $events = $events->paginate(10);

        return view('master-data.events.index', compact('title', 'events', 'menu_active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Event';
        $categories = Category::all();
        return view('master-data.events.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_ids' => 'required|array',
            'title' => 'required',
            'subtitle' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'slug' => 'required|unique:events,slug',
            'date' => 'required',
        ]);

        $dir = 'events/' . $request->slug . '/';
        if(!Storage::disk('public')->exists($request->slug)) {
            Storage::disk('public')->makeDirectory($request->slug);
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_new_name = time() . '_' . 'thumbnail.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('public')->put($dir . $thumbnail_new_name, file_get_contents($thumbnail));
            $validatedData['thumbnail'] = $dir . $thumbnail_new_name;
        }

        if ($request->hasFile('background')) {
            $background = $request->file('background');
            $background_new_name = time() . '_' . 'background.' . $background->getClientOriginalExtension();
            Storage::disk('public')->put($dir . $background_new_name, file_get_contents($background));
            $validatedData['background'] = $dir . $background_new_name;
        }

        $event = Event::create($validatedData);

        if (!empty($validatedData['category_ids'])) {
            $event->categories()->sync($validatedData['category_ids']);
        }
        return redirect()->route('events.index')->withSuccess(['Create event success!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $title = 'Edit Event';
        $categories = Category::all();
        return view('master-data.events.edit', compact('title', 'event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'category_ids' => 'required|array',
            'title' => 'required',
            'subtitle' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'slug' => 'required|unique:events,slug,' . $event->id,
            'date' => 'required',
        ]);

        $dir = 'events/' . $request->slug . '/';
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        if ($request->hasFile('thumbnail')) {
            if ($event->thumbnail && Storage::disk('public')->exists($event->thumbnail)) {
                Storage::disk('public')->delete($event->thumbnail);
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnail_new_name = time() . '_' . 'thumbnail.'.request()->file('thumbnail')->getClientOriginalExtension();
            Storage::disk('public')->put($dir . $thumbnail_new_name, file_get_contents($thumbnail));
            $validatedData['thumbnail'] = $dir . $thumbnail_new_name;
        } else {
            $validatedData['thumbnail'] = $event->thumbnail;
        }

        if ($request->hasFile('background')) {
            if ($event->background && Storage::disk('public')->exists($event->background)) {
                Storage::disk('public')->delete($event->background);
            }

            $background = $request->file('background');
            $background_new_name = time() . '_' . 'background.'.request()->file('background')->getClientOriginalExtension();
            Storage::disk('public')->put($dir . $background_new_name, file_get_contents($background));
            $validatedData['background'] = $dir . $background_new_name;
        } else {
            $validatedData['background'] = $event->background;
        }

        $event->update($validatedData);
        $event->categories()->sync($validatedData['category_ids']);

        return redirect()->route('events.index')->withSuccess(['Update event success!']);
    }

    public function gallery(Event $event)
    {
        $title = 'Gallery Event - ' . $event->title;

        // Load relasi gallery group + gallery di dalamnya
        $event->load([
            'galleryGroups' => function ($q) {
                $q->with(['galleries' => function ($g) {
                    $g->orderBy('order', 'asc');
                }])->orderBy('order', 'asc');
            }
        ]);

        $galleryGroups = $event->galleryGroups;

        return view('master-data.events.gallery', compact('event', 'title', 'galleryGroups'));
    }
    public function syncGallery(Event $event)
    {
        $baseDir = 'events/' . $event->slug . '/gallery';
        $disk = Storage::disk('public');

        if (!$disk->exists($baseDir)) {
            return back()->withErrors(['Gallery folder not found.']);
        }

        $existingGroupIds = [];
        $existingGalleryIds = [];

        $groupFolders = $disk->directories($baseDir);

        foreach ($groupFolders as $index => $groupPath) {
            $groupName = basename($groupPath);

            $groupMediaPath = $groupPath . '/group-media';
            $itemMediaPath = $groupPath . '/items';

            $groupMediaFile = null;
            if ($disk->exists($groupMediaPath)) {
                $groupFiles = $disk->files($groupMediaPath);
                $groupMediaFile = $groupFiles[0] ?? null;
            }

            $group = EventGalleryGroup::updateOrCreate(
                [
                    'event_id' => $event->id,
                    'name' => $groupName,
                ],
                [
                    'media_path' => $groupMediaFile,
                    'order' => $index + 1,
                ]
            );

            $existingGroupIds[] = $group->id;

            if ($disk->exists($itemMediaPath)) {
                $itemFiles = $disk->files($itemMediaPath);

                foreach ($itemFiles as $fileIndex => $filePath) {
                    $fileName = basename($filePath);

                    $gallery = EventGallery::updateOrCreate(
                        [
                            'event_id' => $event->id,
                            'event_gallery_group_id' => $group->id,
                            'name' => $fileName,
                        ],
                        [
                            'media_path' => $filePath,
                            'order' => $fileIndex + 1,
                        ]
                    );

                    $existingGalleryIds[] = $gallery->id;
                }
            }
        }

        EventGalleryGroup::where('event_id', $event->id)
            ->whereNotIn('id', $existingGroupIds)
            ->delete();

        EventGallery::where('event_id', $event->id)
            ->whereNotIn('id', $existingGalleryIds)
            ->delete();

        return back()->withSuccess(['Gallery fully synced (added/updated/removed)!']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->categories()->sync([]);
        $event->delete();
        return redirect()->route('events.index')->withSuccess(['Delete event success!']);
    }
}
