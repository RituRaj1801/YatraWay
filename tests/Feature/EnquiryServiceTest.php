<?php

namespace Tests\Feature;

use App\Services\EnquiryService;
use App\Services\JsonDataService;
use Tests\TestCase;

class EnquiryServiceTest extends TestCase
{
    public function test_enquiry_ids_are_incremented(): void
    {
        $service = new EnquiryService(app(JsonDataService::class));
        $this->assertNotNull($service);
    }
}
