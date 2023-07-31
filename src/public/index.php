<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Config;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use App\Listeners\NotificationListeners;

$config = new Config([]);

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . "/controllers/",
        APP_PATH . "/models/",
    ]
);

$loader->register();

$container = new FactoryDefault();

$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$eventsManager = new EventsManager();
$eventsManager->attach(
    'notifications',
    new NotificationListeners()
);

// $eventsManager->attach(
//     'do:afterQuery',
//     function (Event $event, $connection) use ($logger) {
//         $logger->error($connection->getSQLStatement());
//     }
// );

$eventsManager->attach(
    'application:beforeHandleRequest',
    new NotificationListeners()
);

$container->set(
    'EventsManager',
    $eventsManager
);

$application = new Application($container);

$container->set(
    'db',
    function () {
        return new Mysql(
            [
                'host'     => 'event_i_phalcon-mysql-server-1',
                'username' => 'root',
                'password' => 'secret',
                'dbname'   => 'dbphalcon',
                ]
            );
        }
);

// $container->set(
//     'mongo',
//     function () {
//         $mongo = new MongoClient();

//         return $mongo->selectDB('phalt');
//     },
//     true
// );

try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
