<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\EstimateDelivery\Client;
use App\Components\EstimateDelivery\Strategies\DeliveryStrategy;

class EstimateDeliverySeviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       $this->app->singleton(Client::class, function () {
            $config = config('taximachine');            
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);
             
            return new Client(new DeliveryStrategy($client));
        });
    }
}
