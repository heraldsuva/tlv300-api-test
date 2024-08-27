<?php

namespace App\DataProviders\Whois;

class Whois
{
    public function __construct(
        public readonly string $domain_name,
        public readonly string $registrar_name,
        public readonly string $registration_date,
        public readonly string $exp_date,
        public readonly int $est_domain_age,
        public readonly array $hostnames,
        public readonly string $registrant_name,
        public readonly string $tech_contact_name,
        public readonly string $admin_contact_name,
        public readonly string $contact_email
    ) { }
}
