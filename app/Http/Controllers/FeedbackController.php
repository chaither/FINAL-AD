<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        // Cache feedback data for 60 seconds
        $feedback = cache()->remember('admin_feedback_list', 60, function () {
            return Feedback::orderByDesc('created_at')->paginate(12);
        });
        
        return view('admin.feedback.index', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        
        // Clear cached feedback data after deletion
        cache()->forget('admin_feedback_list');
        cache()->forget('public_feedback_list');
        cache()->forget('feedback_stats');
        
        return redirect()->route('feedback.index')->with('success', 'Feedback deleted');
    }

    // Public submit
    public function storePublic(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
        ]);

        Feedback::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => true,
        ]);

        // Clear cached feedback data after creating new feedback
        cache()->forget('admin_feedback_list');
        cache()->forget('public_feedback_list');
        cache()->forget('feedback_stats');

        return redirect('/')->with('status', 'Thank you for your feedback!')->with('openFeedback', true);
    }

    // Public feedback overview
    public function getPublicFeedback()
    {
        // Cache public feedback for 120 seconds (2 minutes)
        $feedback = cache()->remember('public_feedback_list', 120, function () {
            return Feedback::where('is_approved', true)
                           ->orderByDesc('created_at')
                           ->limit(20)
                           ->get();
        });
        
        return response()->json($feedback);
    }
}


