<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\OpenDelivery\Client;
use App\Components\OpenDelivery\Strategies\DeliveryStrategy;

class OpenDeliveryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $config = config('taximachine');            
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);
             
            return new Client(new DeliveryStrategy($client));
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
