<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        // Cache photos and event data for 60 seconds
        $data = cache()->remember('photos_index_data', 60, function () {
            $photos = Photo::ordered()->get();
            $eventTypes = ['Wedding', 'Corporate Event', 'Birthday Party', 'Graduation', 'Other'];
            
            // Get photo counts by event type
            $photoCounts = [];
            foreach ($eventTypes as $eventType) {
                $photoCounts[$eventType] = Photo::where('event_type', $eventType)->count();
            }
            
            return compact('photos', 'eventTypes', 'photoCounts');
        });
        
        return view('admin.photos.index', $data);
    }

    public function create()
    {
        // Cache event types for 300 seconds (5 minutes) as they rarely change
        $eventTypes = cache()->remember('photo_event_types', 300, function () {
            return ['Wedding', 'Corporate Event', 'Birthday Party', 'Graduation', 'Other'];
        });
        
        return view('admin.photos.create', compact('eventTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type_input' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Handle unchecked checkbox
        $validated['is_active'] = $request->has('is_active');

        // Map typed event to known categories or label as Other
        $knownEventTypes = ['Wedding', 'Corporate Event', 'Birthday Party', 'Graduation', 'Other'];
        $typed = trim($request->input('event_type_input', ''));
        $matched = collect($knownEventTypes)->first(function($t) use ($typed){
            return strcasecmp($t, $typed) === 0;
        });
        if ($matched) {
            $validated['event_type'] = $matched;
            $validated['event_label'] = null;
        } else {
            $validated['event_type'] = 'Other';
            $validated['event_label'] = $typed;
        }

        // Store the image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos', 'public');
            $validated['image_path'] = $imagePath;
        }

        Photo::create($validated);

        // Clear caches so homepage and admin reflect the new photo
        cache()->forget('photos_index_data');
        cache()->forget('public_packages_data');

        return redirect()->route('photos.index')
            ->with('success', 'Photo uploaded successfully!');
    }

    public function edit(Photo $photo)
    {
        // Cache event types for 300 seconds (5 minutes) as they rarely change
        $eventTypes = cache()->remember('photo_event_types', 300, function () {
            return ['Wedding', 'Corporate Event', 'Birthday Party', 'Graduation', 'Other'];
        });
        
        return view('admin.photos.edit', compact('photo', 'eventTypes'));
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type_input' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Handle unchecked checkbox
        $validated['is_active'] = $request->has('is_active');

        // Map typed event to known categories or label as Other
        $knownEventTypes = ['Wedding', 'Corporate Event', 'Birthday Party', 'Graduation', 'Other'];
        $typed = trim($request->input('event_type_input', ''));
        $matched = collect($knownEventTypes)->first(function($t) use ($typed){
            return strcasecmp($t, $typed) === 0;
        });
        if ($matched) {
            $validated['event_type'] = $matched;
            $validated['event_label'] = null;
        } else {
            $validated['event_type'] = 'Other';
            $validated['event_label'] = $typed;
        }

        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
            
            $imagePath = $request->file('image')->store('photos', 'public');
            $validated['image_path'] = $imagePath;
        }

        $photo->update($validated);

        // Clear caches so homepage and admin reflect updates
        cache()->forget('photos_index_data');
        cache()->forget('public_packages_data');

        return redirect()->route('photos.index')
            ->with('success', 'Photo updated successfully!');
    }

    public function destroy(Photo $photo)
    {
        // Delete the image file
        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $photo->delete();

        // Clear caches so homepage and admin reflect deletion
        cache()->forget('photos_index_data');
        cache()->forget('public_packages_data');

        return redirect()->route('photos.index')
            ->with('success', 'Photo deleted successfully!');
    }

    public function toggleStatus(Photo $photo)
    {
        $photo->update(['is_active' => !$photo->is_active]);

        // Clear caches so homepage and admin reflect status change
        cache()->forget('photos_index_data');
        cache()->forget('public_packages_data');

        return redirect()->route('photos.index')
            ->with('success', 'Photo status updated!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'photos' => 'required|array',
            'photos.*.id' => 'required|exists:photos,id',
            'photos.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($request->photos as $photoData) {
            Photo::where('id', $photoData['id'])->update(['sort_order' => $photoData['sort_order']]);
        }

        // Clear caches so homepage and admin reflect new order
        cache()->forget('photos_index_data');
        cache()->forget('public_packages_data');

        return response()->json(['success' => true]);
    }
}
