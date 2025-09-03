<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        // Cache contact info data for 60 seconds to avoid file reads on every request
        $data = cache()->remember('contact_info_data', 60, function () {
            $path = storage_path('app/contact_info.json');
            $data = [];
            if (file_exists($path)) {
                $content = @file_get_contents($path);
                $data = json_decode($content, true) ?? [];
            }
            return $data;
        });

        return view('admin.contact-information.contact-info-edit', ['contactInfo' => $data]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'phone'   => 'nullable|string|max:50',
            'email'   => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'nullable|string|max:50',
            // Relax URL validation to avoid blocking saves; we'll lightly sanitize instead
            'social_links.*.url' => 'nullable|string|max:255',
            'social_links.*.icon' => 'nullable|string|max:50',

            // Event preview media (for gallery cards)
            'gallery_previews' => 'nullable|array',
            'gallery_previews.*.event' => 'nullable|string|max:100',
            'gallery_previews.*.type' => 'nullable|in:image,video',
            'gallery_previews.*.url' => 'nullable|string|max:500',
            'gallery_previews.*.poster' => 'nullable|string|max:500',
        ]);

        $path = storage_path('app/contact_info.json');
        $existing = [];
        if (file_exists($path)) {
            $content = @file_get_contents($path);
            $existing = json_decode($content, true) ?? [];
        }
        // Normalize social_links: keep only rows that have a non-empty URL
        if (isset($data['social_links']) && is_array($data['social_links'])) {
            $normalized = [];
            foreach ($data['social_links'] as $row) {
                $url = isset($row['url']) ? trim((string) $row['url']) : '';
                $platform = isset($row['platform']) ? trim((string) $row['platform']) : '';
                $icon = isset($row['icon']) ? trim((string) $row['icon']) : '';

                if ($url === '') {
                    continue; // skip empty entries
                }

                // Auto-add scheme if missing for better compatibility
                if (!preg_match('/^https?:\/\//i', $url)) {
                    $url = 'https://' . $url;
                }

                $normalized[] = [
                    'platform' => $platform,
                    'url' => $url,
                    'icon' => $icon,
                ];
            }
            $data['social_links'] = $normalized;
        }

        // Normalize gallery_previews: map by event, ensure url has scheme
        if (isset($data['gallery_previews']) && is_array($data['gallery_previews'])) {
            $gp = [];
            foreach ($data['gallery_previews'] as $row) {
                $event = isset($row['event']) ? trim((string) $row['event']) : '';
                $type = isset($row['type']) ? trim((string) $row['type']) : '';
                $url = isset($row['url']) ? trim((string) $row['url']) : '';
                $poster = isset($row['poster']) ? trim((string) $row['poster']) : '';
                if ($event === '' || $type === '' || $url === '') {
                    continue;
                }
                if (!preg_match('/^https?:\/\//i', $url)) {
                    $url = 'https://' . $url;
                }
                if ($poster !== '' && !preg_match('/^https?:\/\//i', $poster)) {
                    $poster = 'https://' . $poster;
                }
                $gp[$event] = [
                    'type' => $type,
                    'url' => $url,
                    'poster' => $poster,
                ];
            }
            $data['gallery_previews'] = $gp;
        }

        foreach ($data as $k => $v) {
            if ($v !== null) {
                $existing[$k] = $v;
            }
        }
        file_put_contents($path, json_encode($existing, JSON_PRETTY_PRINT));

        // Clear the cached contact info data after update to ensure fresh data
        cache()->forget('contact_info_data');

        return redirect()->back()->with('status', 'Contact info updated successfully');
    }
}
