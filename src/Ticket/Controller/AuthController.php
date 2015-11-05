<?php

namespace Ticket\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Ticket\Form\SignInForm;

class AuthController
{
    public function signInAction(Request $request, Application $app)
    {

        $view = new \Zend_View();
        $form = new SignInForm();

        $form->setAttrib('class', 'form-horizontal');
        $form->setAction($app['url_generator']->generate('login'));
        $form->setView($view);

        if ($request->isMethod('POST')) {
            if ($form->isValid($request->request->all())) {
                echo 'giriş denemesi';exit;
            }
        }

        return $app['twig']->render('auth/login.html.twig', array('form' => $form));
    }
}