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
        cache()->forget('featured_feedback');
        
        return redirect()->route('feedback.index')->with('success', 'Feedback deleted');
    }

    // Toggle featured status
    public function toggleFeatured(Feedback $feedback)
    {
        // Check if we're trying to feature this feedback
        if (!$feedback->is_featured) {
            // Count current featured feedback
            $featuredCount = Feedback::where('is_featured', true)->count();
            
            // Only allow 3 featured feedback items
            if ($featuredCount >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maximum 3 featured feedback items allowed. Please unfeature another item first.'
                ], 400);
            }
        }
        
        $feedback->update(['is_featured' => !$feedback->is_featured]);
        
        // Clear cached data
        cache()->forget('admin_feedback_list');
        cache()->forget('public_feedback_list');
        cache()->forget('feedback_stats');
        cache()->forget('featured_feedback');
        
        return response()->json([
            'success' => true,
            'is_featured' => $feedback->is_featured,
            'message' => $feedback->is_featured ? 'Feedback featured successfully!' : 'Feedback unfeatured successfully!'
        ]);
    }

    // Get featured feedback for welcome page
    public function getFeaturedFeedback()
    {
        $featuredFeedback = cache()->remember('featured_feedback', 300, function () {
            return Feedback::where('is_approved', true)
                           ->where('is_featured', true)
                           ->orderBy('created_at', 'desc')
                           ->limit(3)
                           ->get();
        });
        
        return response()->json($featuredFeedback);
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
            'is_featured' => false,
        ]);

        // Clear cached feedback data after creating new feedback
        cache()->forget('admin_feedback_list');
        cache()->forget('public_feedback_list');
        cache()->forget('feedback_stats');
        cache()->forget('featured_feedback');

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


