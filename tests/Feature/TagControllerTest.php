<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
   /**
     * @test
     */
    public function tags(): void
    {
        $response = $this->get('/api/tags');

        $response->assertStatus(200);
    }
}
