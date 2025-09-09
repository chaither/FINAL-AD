<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use App\Models\Photo;
use App\Models\Package;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // Static pages
        $urls[] = [
            'loc' => url('/'),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ];
        $urls[] = [ 'loc' => url('/gallery/wedding'), 'changefreq' => 'monthly', 'priority' => '0.7' ];
        $urls[] = [ 'loc' => url('/gallery/corporate'), 'changefreq' => 'monthly', 'priority' => '0.7' ];
        $urls[] = [ 'loc' => url('/gallery/birthday'), 'changefreq' => 'monthly', 'priority' => '0.7' ];

        // Packages as conceptual pages
        foreach (Package::query()->orderBy('created_at', 'desc')->get(['id','name','updated_at']) as $package) {
            $urls[] = [
                'loc' => url('/#pricing'),
                'lastmod' => optional($package->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // Photos (event categories only, avoid listing each image)
        $eventTypes = Photo::query()->active()->whereNotNull('event_type')->distinct()->pluck('event_type');
        foreach ($eventTypes as $eventType) {
            $slug = strtolower(str_replace(' ', '-', $eventType));
            $urls[] = [
                'loc' => url('/gallery/' . $slug),
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ];
        }

        $content = view('sitemap', compact('urls'))->render();
        return new Response($content, 200, [ 'Content-Type' => 'application/xml' ]);
    }
}


