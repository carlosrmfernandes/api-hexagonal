<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\MercadoPagoIntegration\Client;
use App\Components\MercadoPagoIntegration\Strategies\MercadoPagoStrategy;

class MercadoPagoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $config = config('mercadopago');
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);

            return new Client(new MercadoPagoStrategy($client));
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
