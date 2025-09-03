<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController
{
    public function index(Request $request): View
    {
        // Create a unique cache key based on request parameters
        $cacheKey = 'messages_filtered_' . md5(serialize($request->all()));
        
        // Cache filtered messages for 30 seconds
        $messages = cache()->remember($cacheKey, 30, function () use ($request) {
            $query = ContactMessage::query();

            // Filter by name (first or last)
            if ($request->filled('name')) {
                $name = $request->input('name');
                $query->where(function($q) use ($name) {
                    $q->where('first_name', 'like', "%$name%")
                      ->orWhere('last_name', 'like', "%$name%")
                      ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%$name%"]);
                });
            }

            // Filter by event
            if ($request->filled('event')) {
                $query->where('event_type', 'like', "%" . $request->input('event') . "%");
            }

            // Filter by date (created_at)
            if ($request->filled('date')) {
                $query->whereDate('created_at', $request->input('date'));
            }

            return $query->latest()->paginate(20)->appends($request->all());
        });
        
        return view('admin.message.messages', compact('messages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'event_type' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create($validated);

        // Clear all cached messages after creating new message
        $this->clearMessageCache();

        return back()->with('status', 'Thank you! Your message has been saved.');
    }

    /**
     * Delete a message
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();
        
        // Clear message cache after deletion
        $this->clearMessageCache();
        
        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }

    /**
     * Clear all message-related cache
     */
    private function clearMessageCache(): void
    {
        // Clear all cached message data
        cache()->flush();
    }
}


