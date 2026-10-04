<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\JsonDataService;
use Illuminate\Http\Request;

class JsonFileController extends Controller
{
    public function index(JsonDataService $json)
    {
        $files = [];
        foreach ($json->allowedFiles() as $filename => $description) {
            $files[] = [
                'filename' => $filename,
                'description' => $description,
                'preview' => $json->read($filename, []),
            ];
        }

        return view('admin.json.index', compact('files'));
    }

    public function edit(string $filename, JsonDataService $json)
    {
        $allowed = $json->allowedFiles();
        abort_unless(array_key_exists($filename, $allowed), 404, 'JSON file not found.');

        return view('admin.json.edit', [
            'filename' => $filename,
            'description' => $allowed[$filename],
            'content' => old('content', $json->readRaw($filename)),
        ]);
    }

    public function update(string $filename, Request $request, JsonDataService $json)
    {
        $allowed = $json->allowedFiles();
        abort_unless(array_key_exists($filename, $allowed), 404, 'JSON file not found.');

        $validated = $request->validate([
            'content' => ['required', 'string'],
        ], [
            'content.required' => 'JSON content is required.',
        ]);

        try {
            $json->writeRaw($filename, $validated['content']);
        } catch (\InvalidArgumentException $e) {
            return back()->withInput()->withErrors(['content' => $e->getMessage()]);
        }

        return redirect()
            ->route('admin.json.edit', $filename)
            ->with('success', $filename.' saved successfully.');
    }
}
