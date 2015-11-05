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
                echo 'giris denemesi';exit;
            }
        }

        return $app['twig']->render('auth/login.html.twig', array('form' => $form));
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration');
    }
}