<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use App\DataProviders\Whois\TestingWhoisDataProvider;
use App\DataProviders\Whois\WhoisDataProvider;
use App\Services\WhoisXML\WhoisXMLDataProvider;
use App\Services\WhoisFreaks\WhoisFreaksDataProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WhoisDataProvider::class, function () {
            return match (config('services.whois_provider')) {
                'whoisfreaks' => new WhoisFreaksDataProvider(),
                'whoisxml' => new WhoisXMLDataProvider(),
                'testing' => new TestingWhoisDataProvider(),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
