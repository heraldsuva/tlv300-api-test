<?php

namespace App\Services\WhoisXML;

use App\DataProviders\Whois\WhoisDataProvider;
use App\DataProviders\Whois\Whois;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WhoisXMLDataProvider implements WhoisDataProvider
{
    public function lookup(string $domainName): Whois
    {
        try {
            $response = Http::get(config('services.whoisxml.uri'), [
                'apiKey' => config('services.whoisxml.token'),
                'outputFormat' => 'json',
                'domainName' => $domainName
            ])
            ->json();

            $data = $response['WhoisRecord'];

            return new Whois(
                domain_name: $data['domainName'],
                registrar_name: $data['registrarName'],
                registration_date: Carbon::parse($data['createdDate'])->format('M d, Y'),
                exp_date: Carbon::parse($data['expiresDateNormalized'])->format('M d, Y'),
                est_domain_age: $data['estimatedDomainAge'],
                hostnames: $data['nameServers']['hostNames'],
                registrant_name: $data['registrant']['organization'],
                tech_contact_name: $data['technicalContact']['organization'],
                admin_contact_name: $data['administrativeContact']['organization'],
                contact_email: $data['contactEmail'],

            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Collection::make();
        }
    }
}
