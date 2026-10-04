<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\EnquiryService;
use App\Services\PackageService;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnquiryController extends Controller
{
    public function dashboard(EnquiryService $enquiries, PackageService $packages)
    {
        $items = $enquiries->getAll();
        $recent = array_slice(array_reverse($items), 0, 5);

        return view('admin.dashboard', [
            'total' => count($items),
            'himachal' => count(array_filter($items, fn ($i) => ($i['package_slug'] ?? '') === 'himachal')),
            'uttarakhand' => count(array_filter($items, fn ($i) => ($i['package_slug'] ?? '') === 'uttarakhand')),
            'manali' => count(array_filter($items, fn ($i) => ($i['package_slug'] ?? '') === 'manali')),
            'packages' => $packages->getAll(),
            'recent' => $recent,
        ]);
    }

    public function store(Request $request, PackageService $packages, EnquiryService $enquiries)
    {
        $package = $packages->findBySlug((string) $request->input('selected_package'));
        if (! $package) {
            return back()->withInput()->withErrors(['selected_package' => 'Please select a valid package.']);
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+()\-\s]{7,20}$/'],
            'email' => ['nullable', 'email', 'max:150'],
            'selected_package' => ['required', 'string', Rule::in(array_column($packages->getAll(), 'slug'))],
            'travellers' => ['required', 'integer', 'min:1', 'max:50'],
            'travel_date' => ['nullable', 'date', 'after_or_equal:today'],
            'message' => ['nullable', 'string', 'max:1000'],
        ], [
            'full_name.required' => 'Please enter the full name.',
            'phone.required' => 'Please enter a phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'selected_package.required' => 'Please select a package.',
        ]);

        $validated['selected_package'] = $package['name'];
        $validated['package_slug'] = $package['slug'];
        $enquiries->create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Enquiry saved to JSON successfully.');
    }

    public function index(Request $request, EnquiryService $enquiries)
    {
        $filter = $request->query('package');
        return view('admin.enquiries.index', ['enquiries' => $enquiries->filterByPackage($filter), 'filter' => $filter]);
    }

    public function show(string $id, EnquiryService $enquiries, SettingsService $settings)
    {
        $enquiry = $enquiries->findById($id);
        abort_if(! $enquiry, 404, 'Enquiry not found.');
        return view('admin.enquiries.show', ['enquiry' => $enquiry, 'settings' => $settings->get()]);
    }

    public function destroy(string $id, EnquiryService $enquiries)
    {
        abort_if(! $enquiries->delete($id), 404, 'Enquiry not found.');
        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted successfully.');
    }
}
