<?php

namespace App\Components\MercadoPagoIntegration\Contracts;

interface MercadoPagoInterface
{

    /**
     * @param $request
     * @return Object
     */
    public function generatePayment(
        $request
    ): Object;

    /**
     * @return Object
     */
    public function getIdentificationType(): Object;

    /**
     * @param $request
     * @return Object
     */
    public function createsCustomer(
        $request
    ): Object;

    /**
     * @return Object
     */
    public function getCustomer(
        $id
    ): Object;


    /**
     * @param $request
     * @return Object
     */
    public function createsCard(
        $request, $customerID
    ): Object;

    /**
     * @return Object
     */
    public function getCards(
        $customerID
    ): Object;

    /**
     * @param $request
     * @return Object
     */
    public function deleteCard(
        $customerID, $id
    ): Object;
}
