<?php

namespace App\Components\MercadoPagoIntegration\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\MercadoPagoIntegration\Contracts\MercadoPagoInterface;
use App\Components\MercadoPagoIntegration\Exceptions\MercadoPagoException;

class MercadoPagoStrategy implements MercadoPagoInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * MercadoPagoStrategy constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $id
     * @return Object
     * @throws Exception
     */
    public function generateWeather(
    int $id
    ): Object
    {
        try {

            $response = $this->client->request('GET', '?woeid='.$id , [
                'json' => '',
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
