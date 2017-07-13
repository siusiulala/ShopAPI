<?php

//$itemController = new StoreController();
//$app->get('/store/get', [$itemController, 'getAllPhones']);
//$app->get('/store', function() { echo ' Success'; });

$app->get('/', function () use ($app) {
//    echo 'root page';
    echo $app['view']->render('index');
});
//
(new StoreRoute)->mountController($app);
(new MemberRoute)->mountController($app);
(new BuyerRoute)->mountController($app);
(new ProductRoute)->mountController($app);
(new RecordRoute)->mountController($app);
//(new VideoRoute)->mountController($app);
//(new PlaylistRoute)->mountController($app);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
//    echo $app['url'];
//    echo $app['view']->render('404');
});

