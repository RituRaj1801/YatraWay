<?php

namespace App\Http\Controllers;

use App\Services\EnquiryService;
use App\Services\PackageService;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function create(Request $request, PackageService $packages, SettingsService $settings)
    {
        $slug = $request->query('package');
        $selected = $slug ? $packages->findBySlug($slug) : null;
        return view('contact', ['packages' => $packages->getAll(), 'selected' => $selected, 'settings' => $settings->get()]);
    }

    public function store(Request $request, PackageService $packages, EnquiryService $enquiries)
    {
        $package = $packages->findBySlug((string) $request->input('selected_package'));
        if (! $package) return back()->withInput()->withErrors(['selected_package' => 'Please select a valid package.']);

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+()\-\s]{7,20}$/'],
            'email' => ['nullable', 'email', 'max:150'],
            'selected_package' => ['required', 'string', Rule::in(array_column($packages->getAll(), 'slug'))],
            'travellers' => ['required', 'integer', 'min:1', 'max:50'],
            'travel_date' => ['nullable', 'date', 'after_or_equal:today'],
            'message' => ['nullable', 'string', 'max:1000'],
        ], [
            'full_name.required' => 'Please enter your full name.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'selected_package.required' => 'Please select a package.',
        ]);

        $validated['selected_package'] = $package['name'];
        $validated['package_slug'] = $package['slug'];
        $enquiries->create($validated);

        return redirect()->route('contact', ['package' => $package['slug']])->with('success', 'Thank you! Your enquiry has been received. Our travel team will contact you shortly.');
    }
}
