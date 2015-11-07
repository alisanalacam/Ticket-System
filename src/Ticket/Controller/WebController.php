<?php

namespace Ticket\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebController
{
    /**
     * Web anasayfa
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Request $request, Application $app)
    {
        return $app['twig']->render('index.html.twig');
    }

    public function dashboardAction(Request $request, Application $app)
    {
        var_dump('admin');exit;
    }
}