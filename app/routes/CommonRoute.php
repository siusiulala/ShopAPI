<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

class CommonRoute extends Route
{
    public function mountController($app) {
        $commonController = new MicroCollection();
        $commonController->setHandler('CommonController', true);
        $commonController->setPrefix('/common');
        $commonController->get('/v1/getTotalCount', 'getTotalCount');
        $commonController->post('/v1/uploadImage','uploadImg');

        $commonController->post('/v1/pushIphone','pushIphone');

        $app->mount($commonController);
    }
}