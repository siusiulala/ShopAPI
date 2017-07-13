<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

class ProductRoute extends Route
{
    public function mountController($app) {
        $productController = new MicroCollection();
        $productController->setHandler('ProductController', true);
        $productController->setPrefix('/product');

        $productController->get('/v1/get', 'getAllSProduct');
        $productController->get('/v1/getPS/{p}/{s}', 'getByPriceStock');

        $productController->post('/v1/new/{name}/{stock}/{classify}/{price}', 'newProduct');

        $productController->delete('/v1/del/{pid}', 'deleteProduct');

        $app->mount($productController);
    }
}