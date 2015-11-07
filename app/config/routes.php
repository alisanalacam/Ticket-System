<?php

$app->get('/', 'Ticket\Controller\WebController::indexAction')
    ->bind('homepage');

$app->get('/admin', 'Ticket\Controller\WebController::dashboardAction')
    ->bind('dashboard');

$app->post('/login_check', function() {var_dump('asd');exit;})
    ->bind('login_check');

$app->match('/login', 'Ticket\Controller\AuthController::signInAction')
    ->bind('login');

$app->match('/logout', 'Ticket\Controller\AuthController::logoutAction')
    ->bind('logout');

$app->match('/register', 'Ticket\Controller\AuthController::registerAction')
    ->bind('register');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        echo "<pre>";
        print_r($e->getMessage());
        return;
    }
    //return $app['twig']->render('404.html.twig');
});