<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

class StoreRoute extends Route
{
    public function mountController($app) {
        $storeController = new MicroCollection();
        $storeController->setHandler('StoreController', true);
        $storeController->setPrefix('/store');
        $storeController->get('/v1/get', 'getAllStores');
        $storeController->get('/v1/get/{sTime}/{eTime}', 'getStoresByTime');
        $app->mount($storeController);
    }
}