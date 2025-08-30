<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PinController extends Controller
{
    public function index(Request $request): View
    {
        // Cache user pins for 60 seconds
        $pins = cache()->remember('user_pins_' . $request->user()->id, 60, function () use ($request) {
            return Pin::where('user_id', $request->user()->id)->latest()->get();
        });
        
        return view('admin.pins.pins', compact('pins'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'content' => ['nullable', 'string', 'max:2000'],
        ]);

        $request->user()->pins()->create($data);

        // Clear cached pins after creating new pin
        cache()->forget('user_pins_' . $request->user()->id);

        return back()->with('status', 'Pin added');
    }

    public function destroy(Pin $pin): RedirectResponse
    {
        abort_unless($pin->user_id === request()->user()->id, 403);
        $pin->delete();
        
        // Clear cached pins after deleting pin
        cache()->forget('user_pins_' . $pin->user_id);
        
        return back()->with('status', 'Pin removed');
    }
}


