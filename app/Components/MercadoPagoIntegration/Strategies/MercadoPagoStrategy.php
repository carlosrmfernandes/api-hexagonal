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
     * @param  $request
     * @return Object
     * @throws Exception
     */
    public function generatePayment(
        $request
    ): Object
    {
        $body = null;
        $config = config('mercadopago');

        try {

            if (is_object($request)) {
                $body = $request->all();
            }

            $response = $this->client->request('POST', '/payments' , [
                'body' => $body,
                'headers' => [
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
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

    /**
     * @return Object
     * @throws Exception
     */
    public function getIdentificationType(
    ): Object
    {
        $config = config('mercadopago');

        try {
            $response = $this->client->request('GET', '/v1/identification_types' , [
                'headers' => [
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
            ]);
            return (object) json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param  $request
     * @return Object
     * @throws Exception
     */
    public function createsCustomer(
        $request
    ): Object
    {
        $body = null;
        $config = config('mercadopago');

        try {

            if (is_object($request)) {
                $body = $request->all();
                $body["address"]["street_number"] = intval($body["address"]["street_number"]);
            }
            $response = $this->client->request('POST', '/v1/customers' , [
                'json' => $body,
                'headers' => [
                    "Accept" => "application/json",
                    "Content-Type" => "application/json",
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
            ]);
            return (object) json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());
            dd($response);
            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return Object
     * @throws Exception
     */
    public function getCustomer(
        $id
    ): Object
    {
        $config = config('mercadopago');

        try {
            $response = $this->client->request('GET', '/v1/customers/' . $id , [
                'headers' => [
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
            ]);
            return (object) json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param  $request
     * @return Object
     * @throws Exception
     */
    public function createsCard(
        $request, $customerID
    ): Object
    {
        $body = null;
        $config = config('mercadopago');

        try {

            if (is_object($request)) {
                $body = $request->all();
            }

            $response = $this->client->request('POST', '/v1/customers/'. $customerID . '/cards'  , [
                'json' => $body,
                'headers' => [
                    "Accept" => "application/json",
                    "Content-Type" => "application/json",
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
            ]);
            return (object) json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());
            dd($response);
            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return Object
     * @throws Exception
     */
    public function getCards(
        $customerID
    ): Object
    {
        $config = config('mercadopago');

        try {
            $response = $this->client->request('GET', '/v1/customers/' . $customerID . '/cards' , [
                'headers' => [
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
            ]);
            return (object) json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return Object
     * @throws Exception
     */
    public function deleteCard(
        $customerID, $id
    ): Object
    {
        $config = config('mercadopago');

        try {
            $response = $this->client->request('DELETE', '/v1/customers/' . $customerID . '/cards' . '/' . $id , [
                'headers' => [
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
            ]);
            return (object) json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param  $request
     * @return Object
     * @throws Exception
     */
    public function createsPayment(
        $request
    ): Object
    {
        $body = null;
        $config = config('mercadopago');

        try {

            if (is_object($request)) {
                $body = $request->all();
                $body["transaction_amount"] = floatval($body["transaction_amount"]);
                $body["order"]["id"] = intval($body["order"]["id"]);
                $body["installments"] = intval($body["installments"]);
            }

            $response = $this->client->request('POST', '/v1/payments', [
                'json' => $body,
                'headers' => [
                    "Accept" => "application/json",
                    "Content-Type" => "application/json",
                    'Authorization' => 'Bearer ' . $config['mp_access_token']
                ]
            ]);
            return (object) json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());
            dd($response);
            throw new MercadoPagoException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}