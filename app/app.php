<?php


$app->get('/', function () use ($app) {
//    $url = "../index.html";
    header("Location:https://www.google.com.tw");

//    echo 'root page';
//    echo $app['view']->render('index');
});

//
(new StoreRoute)->mountController($app);
(new MemberRoute)->mountController($app);
(new BuyerRoute)->mountController($app);
(new ProductRoute)->mountController($app);
(new RecordRoute)->mountController($app);

(new CommonRoute)->mountController($app);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
//    echo $app['url'];
//    echo $app['view']->render('404');
});

