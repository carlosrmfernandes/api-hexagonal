<?php

namespace App\Components\AddressByZipCode\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\AddressByZipCode\Contracts\AddressByZipCodeInterface;
use App\Components\AddressByZipCode\Exceptions\AddressByZipCodeException;

class AddressByZipCodeStrategy implements AddressByZipCodeInterface {

    /**
     * @var Client
     */
    protected $client;

    /**
     * AddressByZipCodeStrategy constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @param string $cep
     * @return Object
     * @throws Exception
     */
    public function addressByZipCode(
    string $cep
    ): Object {
        try {
            
            $addressByZipCodeStrategy = $this->client->request('GET', "/ws/".$cep.'/json');           
            
            return json_decode($addressByZipCodeStrategy->getBody()->getContents());            
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());
            dd($exception);
            throw new AddressByZipCodeException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
