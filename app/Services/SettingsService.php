<?php

namespace App\Services;

class SettingsService
{
    public function __construct(private JsonDataService $json) {}
    public function get(): array { return $this->json->read('settings.json', []); }
}
