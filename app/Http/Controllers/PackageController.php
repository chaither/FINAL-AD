<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Photo;

class PackageController extends Controller
{
    public function index()
    {
        // Cache packages data for 120 seconds (2 minutes)
        $packages = cache()->remember('admin_packages_list', 120, function () {
            return Package::ordered()->get();
        });
        
        
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Handle unchecked checkbox
        $validated['is_active'] = $request->has('is_active');

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($feature) {
                return !empty(trim($feature));
            });
        }

        Package::create($validated);

        // Clear cached packages data after creating new package
        cache()->forget('admin_packages_list');
        cache()->forget('public_packages_list');

        return redirect()->route('packages.index')
            ->with('success', 'Package created successfully!');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Handle unchecked checkbox
        $validated['is_active'] = $request->has('is_active');

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($feature) {
                return !empty(trim($feature));
            });
        }

        $package->update($validated);

        // Clear cached packages data after updating package
        cache()->forget('admin_packages_list');
        cache()->forget('public_packages_list');

        return redirect()->route('packages.index')
            ->with('success', 'Package updated successfully!');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        // Clear cached packages data after deleting package
        cache()->forget('admin_packages_list');
        cache()->forget('public_packages_list');

        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully!');
    }

    public function toggleStatus(Package $package)
    {
        $package->update(['is_active' => !$package->is_active]);

        // Clear cached packages data after status change
        cache()->forget('admin_packages_list');
        cache()->forget('public_packages_list');

        return redirect()->route('packages.index')
            ->with('success', 'Package status updated!');
    }

    public function publicPackages()
    {
        // Cache public packages and photos data for 300 seconds (5 minutes)
        $data = cache()->remember('public_packages_data', 300, function () {
            $packages = Package::active()->ordered()->get();
            $eventTypes = ['Wedding', 'Corporate Event', 'Birthday Party', 'Graduation', 'Other'];
            $photosByEvent = [];
            foreach ($eventTypes as $type) {
                $photosByEvent[$type] = Photo::active()->byEventType($type)->ordered()->get();
            }
            
            // Load contact info stored by admin
            $contactInfoPath = storage_path('app/contact_info.json');
            $contactInfo = [];
            if (file_exists($contactInfoPath)) {
                $contactInfo = json_decode(@file_get_contents($contactInfoPath), true) ?? [];
            }
            
            return compact('packages', 'eventTypes', 'photosByEvent', 'contactInfo');
        });
        
        return view('welcome', $data);
    }
}
