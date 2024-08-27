<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WhoisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'domain_name' => $this->domain_name,
            'registrar_name' => $this->registrar_name,
            'registration_date' => $this->registration_date,
            'exp_date' => $this->exp_date,
            'est_domain_age' => $this->est_domain_age,
            'hostnames' => $this->hostnames ? collect($this->hostnames)->implode(',') : '',
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
            'registrant_name' => $this->registrant_name,
            'tech_contact_name' => $this->tech_contact_name,
            'admin_contact_name' => $this->admin_contact_name,
            'contact_email' => $this->contact_email
        ];
    }
}
