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
        ]);

        $path = storage_path('app/contact_info.json');
        $existing = [];
        if (file_exists($path)) {
            $content = @file_get_contents($path);
            $existing = json_decode($content, true) ?? [];
        }
        foreach ($data as $k => $v) {
            if ($v !== null) $existing[$k] = $v;
        }
        file_put_contents($path, json_encode($existing, JSON_PRETTY_PRINT));

        // Clear the cached contact info data after update to ensure fresh data
        cache()->forget('contact_info_data');

        return redirect()->back()->with('status', 'Contact info updated successfully');
    }
}
