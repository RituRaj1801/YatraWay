<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use RuntimeException;

class JsonDataService
{
    private string $directory;

    public function __construct()
    {
        $this->directory = storage_path('app/data');
        if (! is_dir($this->directory) && ! mkdir($this->directory, 0755, true) && ! is_dir($this->directory)) {
            throw new RuntimeException('Unable to create application data directory.');
        }
    }

    public function read(string $filename, mixed $default = []): mixed
    {
        $path = $this->path($filename);
        if (! file_exists($path)) {
            $this->write($filename, $default);
            return $default;
        }

        $json = file_get_contents($path);
        if ($json === false || trim($json) === '') return $default;

        try {
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            Log::error('Invalid JSON data file.', ['file' => $filename, 'error' => $e->getMessage()]);
            throw new RuntimeException('Application data is temporarily unavailable.');
        }
    }

    public function write(string $filename, mixed $data): void
    {
        $path = $this->path($filename);
        $handle = fopen($path, 'c+');
        if ($handle === false) throw new RuntimeException('Unable to open application data file.');

        try {
            if (! flock($handle, LOCK_EX)) throw new RuntimeException('Unable to lock application data file.');
            $encoded = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
            ftruncate($handle, 0);
            rewind($handle);
            if (fwrite($handle, $encoded) === false) throw new RuntimeException('Unable to write application data file.');
            fflush($handle);
            flock($handle, LOCK_UN);
        } catch (\Throwable $e) {
            Log::error('JSON write failed.', ['file' => $filename, 'error' => $e->getMessage()]);
            throw new RuntimeException('Unable to save application data.');
        } finally {
            fclose($handle);
        }
    }

    public function readRaw(string $filename): string
    {
        $data = $this->read($filename, []);
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function writeRaw(string $filename, string $json): void
    {
        try {
            $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \InvalidArgumentException('Invalid JSON: '.$e->getMessage());
        }

        $this->write($filename, $decoded);
    }

    public function allowedFiles(): array
    {
        return [
            'settings.json' => 'Site settings, hero slides, services and contact info',
            'packages.json' => 'Tour packages shown on the public website',
            'enquiries.json' => 'All submitted enquiry leads',
        ];
    }

    private function path(string $filename): string
    {
        if (! preg_match('/^[A-Za-z0-9._-]+\.json$/', $filename)) throw new \InvalidArgumentException('Invalid data filename.');
        return $this->directory.DIRECTORY_SEPARATOR.$filename;
    }
}
