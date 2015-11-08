<?php

namespace Ticket\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TicketController
 * @package Ticket\Controller
 */
class TicketController
{
    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->app['twig']->render('ticket/index.html.twig');
    }

    public function createAction(Request $request)
    {
        return $this->app['twig']->render('ticket/create.html.twig');
    }

    public function updateAction(Request $request)
    {
        return $this->app['twig']->render('ticket/update.html.twig');
    }

    public function destroyAction(Request $request)
    {
        return $this->app['twig']->render('ticket/index.html.twig');
    }
}