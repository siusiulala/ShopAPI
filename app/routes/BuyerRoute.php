<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

class BuyerRoute extends Route
{
    public function mountController($app) {
        $buyerController = new MicroCollection();
        $buyerController->setHandler('BuyerController', true);
        $buyerController->setPrefix('/buyer');
        $buyerController->put('/v1/editInfo/{bid}/{name}/{addr}', 'editInfo');
        $app->mount($buyerController);
    }
}