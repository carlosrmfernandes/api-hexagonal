<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\AddressByZipCode\Client;
use App\Components\AddressByZipCode\Strategies\AddressByZipCodeStrategy;

class AddressByZipCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $config = config('viacep');            
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);
             
            return new Client(new AddressByZipCodeStrategy($client));
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
