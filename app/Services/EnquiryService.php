<?php

namespace App\Services;

use Illuminate\Support\Str;

class EnquiryService
{
    public function __construct(private JsonDataService $json) {}

    public function getAll(): array { return $this->json->read('enquiries.json', []); }
    public function findById(string $id): ?array { return collect($this->getAll())->firstWhere('id', $id); }
    public function filterByPackage(?string $slug = null): array
    {
        $items = $this->getAll();
        return $slug ? array_values(array_filter($items, fn ($item) => ($item['package_slug'] ?? '') === $slug)) : $items;
    }

    public function create(array $data): array
    {
        $items = $this->getAll();
        $max = collect($items)->map(fn ($item) => (int) str_replace('ENQ-', '', $item['id'] ?? '0'))->max() ?? 0;
        $data['id'] = sprintf('ENQ-%06d', $max + 1);
        $data['created_at'] = now()->format('Y-m-d H:i:s');
        $items[] = $data;
        $this->json->write('enquiries.json', $items);
        return $data;
    }

    public function delete(string $id): bool
    {
        $items = $this->getAll();
        $filtered = array_values(array_filter($items, fn ($item) => ($item['id'] ?? '') !== $id));
        if (count($filtered) === count($items)) return false;
        $this->json->write('enquiries.json', $filtered);
        return true;
    }
}
