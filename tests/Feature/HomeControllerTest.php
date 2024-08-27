<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class HomeControllerTest extends TestCase
{
    public function test_home_page_success(): void
    {
        $body = file_get_contents(base_path('tests/Fixtures/whoisxml.json'));

        Http::fake([
            config('services.whoisxml.uri') => Http::response($body, 200),
        ]);

        $this->json('GET', '/api/home', ['domain_name' => 'amazon.com'])
            ->assertOk()
            ->assertJson([
                'domain_name' => 'amazon.com',
                'registrar_name' => 'MarkMonitor, Inc.',
                'registration_date' => '1994-11-01T05:00:00+0000',
                'exp_date' => '2024-10-30 07:00:00 UTC',
                'est_domain_age' => 10892,
                //   'hostnames' => [
                //     0 => 'ns2.amzndns.co.uk',
                //     1 => 'ns2.amzndns.com',
                //     2 => 'ns1.amzndns.net',
                //     3 => 'ns1.amzndns.org',
                //     4 => 'ns2.amzndns.net',
                //     5 => 'ns1.amzndns.com',
                //     6 => 'ns1.amzndns.co.uk',
                //     7 => 'ns2.amzndns.org',
                //   ],
                'registrant_name' => 'Amazon Technologies, Inc.',
                'tech_contact_name' => 'Amazon Technologies, Inc.',
                'admin_contact_name' => 'Amazon Technologies, Inc.',
                'contact_email' => 'hostmaster@amazon.com',
            ]);
    }

    public function test_home_page_fail_without_query_parameter()
    {
        Http::fake();

        $response = $this->json('GET', '/api/home');

        $response->assertStatus(422);
    }
}
