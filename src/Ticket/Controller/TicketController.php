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
    /**
     * @param Request $request
     * @param Application $app
     * @return Response
     */
    public function indexAction(Request $request, Application $app)
    {
        return new Response('ControllerAnasayfa');
    }
}