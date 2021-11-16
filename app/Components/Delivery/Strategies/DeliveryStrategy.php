<?php

namespace App\Components\Delivery\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\Delivery\Contracts\DeliveryInterface;
use App\Components\Delivery\Exceptions\DeliveryException;

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
            $response = $this->client->request('', [
                'json' => '',
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
