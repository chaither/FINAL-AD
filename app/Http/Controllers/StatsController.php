<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        // Cache comprehensive stats for 300 seconds (5 minutes)
        $stats = cache()->remember('admin_comprehensive_stats', 300, function () {
            // Get current date and week
            $today = Carbon::today();
            $weekStart = Carbon::now()->startOfWeek();
            $monthStart = Carbon::now()->startOfMonth();
            
            // Total counts
            $totalFeedback = Feedback::count();
            $totalMessages = ContactMessage::count();
            
            // Today's counts
            $todaysFeedback = Feedback::whereDate('created_at', $today)->count();
            $todaysMessages = ContactMessage::whereDate('created_at', $today)->count();
            
            // This week's counts
            $weeksFeedback = Feedback::where('created_at', '>=', $weekStart)->count();
            $weeksMessages = ContactMessage::where('created_at', '>=', $weekStart)->count();
            
            // This month's counts
            $monthsFeedback = Feedback::where('created_at', '>=', $monthStart)->count();
            $monthsMessages = ContactMessage::where('created_at', '>=', $monthStart)->count();
            
            // Feedback ratings distribution
            $ratingStats = Feedback::select('rating', DB::raw('count(*) as count'))
                ->groupBy('rating')
                ->orderBy('rating')
                ->get();
            
            // Recent activity (last 7 days)
            $recentActivity = collect();
            
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $feedbackCount = Feedback::whereDate('created_at', $date)->count();
                $messageCount = ContactMessage::whereDate('created_at', $date)->count();
                
                $recentActivity->push([
                    'date' => $date->format('M d'),
                    'feedback' => $feedbackCount,
                    'messages' => $messageCount,
                    'total' => $feedbackCount + $messageCount
                ]);
            }
            
            // Top feedback contributors
            $topContributors = Feedback::select('name', DB::raw('count(*) as feedback_count'))
                ->groupBy('name')
                ->orderByDesc('feedback_count')
                ->limit(5)
                ->get();
            
            // Average rating
            $averageRating = Feedback::avg('rating') ?? 0;
            
            return compact(
                'totalFeedback',
                'totalMessages',
                'todaysFeedback',
                'todaysMessages',
                'weeksFeedback',
                'weeksMessages',
                'monthsFeedback',
                'monthsMessages',
                'ratingStats',
                'recentActivity',
                'topContributors',
                'averageRating'
            );
        });
        
        return view('admin.stats.index', $stats);
    }
    
    public function getStatsData()
    {
        // Cache basic stats for 180 seconds (3 minutes)
        $stats = cache()->remember('basic_stats_data', 180, function () {
            return [
                'total_feedback' => Feedback::count(),
                'total_messages' => ContactMessage::count(),
                'average_rating' => round(Feedback::avg('rating') ?? 0, 1),
                'this_month_feedback' => Feedback::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
                'this_month_messages' => ContactMessage::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            ];
        });
        
        return response()->json($stats);
    }
}
