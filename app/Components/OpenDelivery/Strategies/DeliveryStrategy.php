<?php

namespace App\Components\OpenDelivery\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\OpenDelivery\Contracts\DeliveryInterface;
use App\Components\OpenDelivery\Exceptions\DeliveryException;

class DeliveryStrategy implements DeliveryInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * DeliveryStrategy constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $data
     * @return Object
     * @throws Exception
     */
    public function delivery(
    array $data
    ): Object
    {        
        try {            
            $response = $this->client->request('POST','/api/integracao/abrirEntrega', [
                'headers' => [
                    'api-key' => config('taximachine')['api-key'],
                    'Authorization' => 'Basic ' . base64_encode(config('taximachine')['email'] . ":" . config('taximachine')['password']),
                    'Content-Type' => 'application/json'
                ],
                'json' => $data,
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new DeliveryException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
