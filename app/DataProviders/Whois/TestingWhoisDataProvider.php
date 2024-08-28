<?php

namespace App\DataProviders\Whois;

use Illuminate\Support\Collection;
use Carbon\Carbon;

class TestingWhoisDataProvider implements WhoisDataProvider
{
    public function lookup(string $domainName): Whois
    {
        $letter = strtoupper(fake()->randomLetter);

        $hostnames = collect(range(1,4))->map(function (int $num) use($letter, $domainName) {
                return "{$letter}{$num}.{$domainName}";
            })
            ->toArray();

        return new Whois(
            domain_name: $domainName,
            registrar_name: fake()->company,
            registration_date: Carbon::parse(fake()->iso8601)->format('M d, Y'),
            exp_date: Carbon::parse(fake()->iso8601)->format('M d, Y'),
            est_domain_age: fake()->randomNumber(5),
            hostnames: $hostnames,
            registrant_name: fake()->company,
            tech_contact_name: fake()->company,
            admin_contact_name: fake()->company,
            contact_email: fake()->email
        );
    }
}
