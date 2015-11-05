<?php

$app->get('/', 'Ticket\Controller\WebController::indexAction')
    ->bind('homepage');

$app->get('/login', 'Ticket\Controller\AuthController::signInAction')
    ->bind('login');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        echo "<pre>";
        print_r($e->getMessage());
        return;
    }
    //return $app['twig']->render('404.html.twig');
});