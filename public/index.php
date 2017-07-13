<?php
use Phalcon\Mvc\Micro;
use Phalcon\Events\Event as Event;
use Phalcon\Events\Manager as EventsManager;

error_reporting(E_ALL);

try {

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/loader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";

    date_default_timezone_set('Asia/Taipei');

    $eventManager = new EventsManager();
    $eventManager->attach('micro', function(Event $event, Micro $app) {
        if ($event->getType() == 'beforeExecuteRoute') {

        }
    });

    /**
     * Handle the request
     */
    $app = new Micro($di);

    $app->setEventsManager($eventManager);

    include "../app/app.php";
//    $app->get('/store', function() { echo 'Router Success';
//    });
    $app->handle();

} catch (\Exception $e) {
    echo $e->getMessage();
}
