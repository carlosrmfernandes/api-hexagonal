<?php

namespace App\Components\GeoCode\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\GeoCode\Contracts\GeoCodeInterface;
use App\Components\GeoCode\Exceptions\GeoCodeException;

class GeoCodeStrategy implements GeoCodeInterface {

    /**
     * @var Client
     */
    protected $client;

    /**
     * GeoCodeStrategy constructor.
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @param array $data
     * @return Object
     * @throws Exception
     */
    public function geoCode(
        array $data
    ): Object {
        try {                     
            $resGeoCode = $this->client->request('GET',"?address=".$data['logradouro'].", ".$data['street_number']."&sensor=".$data['sensor']."&region=".$data['region']."&key=".$data['key']);                       
            return json_decode($resGeoCode->getBody()->getContents());            
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());            
            throw new GeoCodeException(
            $response->message, $exception->getCode());
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
