<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\EnquiryService;
use App\Services\PackageService;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function dashboard(EnquiryService $enquiries)
    {
        $items = $enquiries->getAll();
        return view('admin.dashboard', [
            'total' => count($items),
            'himachal' => count(array_filter($items, fn ($i) => ($i['package_slug'] ?? '') === 'himachal')),
            'uttarakhand' => count(array_filter($items, fn ($i) => ($i['package_slug'] ?? '') === 'uttarakhand')),
            'manali' => count(array_filter($items, fn ($i) => ($i['package_slug'] ?? '') === 'manali')),
        ]);
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
