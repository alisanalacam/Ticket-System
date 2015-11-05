<?php

$app->get('/', 'Ticket\Controller\WebController::indexAction')
    ->bind('homepage');

$app->match('/login', 'Ticket\Controller\AuthController::signInAction')
    ->bind('login');

$app->match('/logout', 'Ticket\Controller\AuthController::logoutAction')
    ->bind('logout');

$app->match('/login_check', 'Ticket\Controller\AuthController::checkAction')
    ->bind('login_check');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        echo "<pre>";
        print_r($e->getMessage());
        return;
    }
    //return $app['twig']->render('404.html.twig');
});