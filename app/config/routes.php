<?php

$app->get('/', 'Ticket\Controller\WebController::indexAction')
    ->bind('homepage');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    return $app['twig']->render('404.html.twig');
});