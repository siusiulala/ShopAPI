<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

class RecordRoute extends Route
{
    public function mountController($app) {
        $recordController = new MicroCollection();
        $recordController->setHandler('RecordController', true);
        $recordController->setPrefix('/record');
        $recordController->get('/v1/get', 'getAllRecord');
        $recordController->get('/v1/getAfterTime/{time}', 'getAfterTime');
        $recordController->get('/v1/getConsumeByBuyer', 'getConsumeByBuyer');
        $recordController->post('/v1/new/{bid}/{sid}/{pid}/{count}/{time}', 'newRecord');
        $app->mount($recordController);
    }
}