<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

class BuyerRoute extends Route
{
    public function mountController($app) {
        $buyerController = new MicroCollection();
        $buyerController->setHandler('BuyerController', true);
        $buyerController->setPrefix('/buyer');
        $buyerController->get('/v1/get', 'getAllBuyers');
        $buyerController->get('/v1/getByPid/{pid}/', 'getByPid');
        $app->mount($buyerController);
    }
}