<?php

namespace App\Components\EstimateDelivery\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\EstimateDelivery\Contracts\DeliveryInterface;
use App\Components\EstimateDelivery\Exceptions\DeliveryException;
use App\Models\User;
use App\Components\AddressByZipCode\Client as ClientAuthorizationAddressByZipCode;
use App\Components\GeoCode\Client as ClientAuthorizationGeoCode;
class DeliveryStrategy implements DeliveryInterface {

    /**
     * @var Client
     */
    protected $client;

    /**
     * DeliveryStrategy constructor.
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
    public function delivery(
    array $data
    ): Object {
        try {
            $seller = User::with('address')->where('id', $data['seller_id'])->first();
            
            $addressByZipCode = app(ClientAuthorizationAddressByZipCode::class)->addressByZipCode($seller->address->cep);
                        
            if(!$addressByZipCode){
                return (object) "error looking up address via zip code";
            }   
            
            $geoCode = [
              'logradouro' => $addressByZipCode->logradouro,
              'street_number' => $seller->address->street_number,
              'sensor' => false,
              'region' => $addressByZipCode->uf,
              'key' => config('geocode')['key']
                
            ];
                        
            $addressGeoCode = app(ClientAuthorizationGeoCode::class)->geoCode($geoCode);
                                    
            if(!$addressGeoCode){
                return (object) "error looking up lat and long via zip code";
            }  

            $response = $this->client->request('GET', '/api/integracao/estimarEntrega?'
                    . 'endereco_partida=' . $seller->address->street . ', ' . $seller->address->street_number
                    . '&bairro_partida=' . $addressByZipCode->bairro
                    . '&estado_partida=' . $seller->address->state
                    . '&lat_partida=' . $addressGeoCode->results[0]->geometry->location->lat
                    . '&lng_partida=' . $addressGeoCode->results[0]->geometry->location->lng
                    . '&endereco_desejado=' . $data['endereco_desejado']
                    . '&bairro_desejado=' . $data['bairro_desejado']
                    . '&cidade_desejado=' . $data['cidade_desejado'],[
                'headers' => [
                    'api-key' => config('taximachine')['api-key'],
                    'Authorization' => 'Basic ' . base64_encode(config('taximachine')['email'] . ":" . config('taximachine')['password'])
                ]
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
