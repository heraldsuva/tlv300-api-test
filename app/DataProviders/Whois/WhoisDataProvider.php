<?php

namespace App\DataProviders\Whois;

use Illuminate\Support\Collection;

interface WhoisDataProvider
{
    public function lookup(string $domainName): Whois;
}
