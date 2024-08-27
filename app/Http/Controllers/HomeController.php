<?php

namespace App\Http\Controllers;

use App\DataProviders\Whois\WhoisDataProvider;
use App\Http\Requests\WhoisRequest;
use App\Http\Resources\WhoisResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param WhoisDataProvider $whois
     *
     */
    public function __construct(protected WhoisDataProvider $whois) {}

    /**
     * Search information on a speicifed domain name
     *
     * @param WhoisRequest $request
     * @return JsonResponse
     */
    public function index(WhoisRequest $request): JsonResponse
    {
        $whois = $this->whois->lookup($request->input('domain_name'));

        return response()->json($whois);
        // return WhoisResource::make($whois);
    }
}
