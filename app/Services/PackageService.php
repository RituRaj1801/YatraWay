<?php

namespace App\Services;

class PackageService
{
    public function __construct(private JsonDataService $json) {}

    public function getAll(): array { return $this->json->read('packages.json', []); }
    public function findById(int $id): ?array { return collect($this->getAll())->firstWhere('id', $id); }
    public function findBySlug(string $slug): ?array { return collect($this->getAll())->firstWhere('slug', $slug); }
}
