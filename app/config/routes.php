<?php

$app->get('/', 'Ticket\Controller\WebController::indexAction')
    ->bind('homepage');

$app->get('/admin', 'Ticket\Controller\WebController::dashboardAction')
    ->bind('dashboard');

// Ticket
$app->get('/ticket', 'Ticket\Controller\TicketController::indexAction')
    ->bind('ticket_index');

$app->match('/ticket/create', 'Ticket\Controller\TicketController::createAction')
    ->bind('ticket_create')->method('GET|POST');

$app->match('/ticket/update/{id}', 'Ticket\Controller\TicketController::updateAction')
    ->bind('ticket_update')->method('GET|PUT');

$app->delete('/ticket/delete/{id}', 'Ticket\Controller\TicketController::deleteAction')
    ->bind('ticket_delete')->method('GET|PUT');

// Ticket Category
$app->get('/ticket/category', 'Ticket\Controller\TicketController::indexCategoryAction')
    ->bind('ticket_category_index');

$app->match('/ticket/category/create', 'Ticket\Controller\TicketController::createCategoryAction')
    ->bind('ticket_category_create')->method('GET|POST');

$app->match('/ticket/category/update/{id}', 'Ticket\Controller\TicketController::updateCategoryAction')
    ->bind('ticket_category_update')->method('GET|POST');

$app->delete('/ticket/category/delete/{id}', 'Ticket\Controller\TicketController::deleteCategoryAction')
    ->bind('ticket_category_delete')->method('GET|POST');

// Security
$app->post('/login_check', function() {})
    ->bind('login_check');

$app->match('/login', 'Ticket\Controller\AuthController::signInAction')
    ->bind('login');

$app->match('/logout', 'Ticket\Controller\AuthController::logoutAction')
    ->bind('logout');

// Register
$app->match('/register', 'Ticket\Controller\AuthController::registerAction')
    ->bind('register')->method('GET|POST');

// Error
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        echo "<pre>";
        print_r($e->getMessage());
        return;
    }
    return $app['twig']->render('404.html.twig');
});