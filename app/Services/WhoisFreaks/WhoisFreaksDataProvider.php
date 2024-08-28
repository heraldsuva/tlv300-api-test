<?php

namespace App\Services\WhoisFreaks;

use App\DataProviders\Whois\WhoisDataProvider;
use App\DataProviders\Whois\Whois;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WhoisFreaksDataProvider implements WhoisDataProvider
{
    public function lookup(string $domainName): Whois
    {
        try {
            $data = Http::get(config('services.whoisfreaks.uri'), [
                'apiKey' => config('services.whoisfreaks.token'),
                'whois' => 'live',
                'domainName' => $domainName
            ])
            ->json();

            return new Whois(
                domain_name: $data['domain_name'],
                registrar_name: $data['domain_registrar']['registrar_name'],
                registration_date: Carbon::parse($data['create_date'])->format('M d, Y'),
                exp_date: Carbon::parse($data['expiry_date'])->format('M d, Y'),
                est_domain_age: 0,
                hostnames: $data['registry_data']['name_servers'],
                registrant_name: $data['registrant_contact']['company'],
                tech_contact_name: $data['technical_contact']['company'],
                admin_contact_name: $data['administrative_contact']['company'],
                contact_email: $data['domain_registrar']['email_address']
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Collection::make();
        }
    }
}
