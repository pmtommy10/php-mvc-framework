<?php

use App\Core\Controller;

$router = new AltoRouter();

$router->addRoutes([
    [ 'GET' , '/translate', 'App\Core\Translate::getAll'],
    [ 'GET' , '/', 'PageController::index' ],
]);

$match = $router->match();

// print_r($match); die();

if ($match && !is_callable($match['target'])) {
    if (strpos($match['target'], 'Translate::') === false) {
        $match['target'] = 'App\Controllers\\'.$match['target'];
    }
}

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    Controller::notFound();
}
