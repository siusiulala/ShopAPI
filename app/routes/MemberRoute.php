<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

class MemberRoute extends Route
{
    public function mountController($app) {
        $memberController = new MicroCollection();
        $memberController->setHandler('MemberController', true);
        $memberController->setPrefix('/member');
        $memberController->get('/v1/get', 'getAllMembers');
        $memberController->get('/v1/getByPid/{pid}', 'getByPid');
        $app->mount($memberController);
    }
}