<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\GeoCode\Client;
use App\Components\GeoCode\Strategies\GeoCodeStrategy;

class GeoCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $config = config('geocode');            
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);
             
            return new Client(new GeoCodeStrategy($client));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
