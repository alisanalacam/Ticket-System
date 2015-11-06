<?php

namespace Ticket\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Ticket\Form\SignInForm;
use Ticket\Form\SignUpForm;

class AuthController
{
    /**
     * Kullanıcı giriş formu ve giriş post
     * @param Request $request
     * @param Application $app
     * @return view
     */
    public function signInAction(Request $request, Application $app)
    {
        $view = new \Zend_View();
        $form = new SignInForm();

        $form->setAttrib('class', 'form-signin');
        $form->setAction($app['url_generator']->generate('login'));
        $form->setView($view);

        if ($request->isMethod('POST')) {
            if ($form->isValid($request->request->all())) {

                var_dump('giriş');exit;
                $session = new Session();

                $user = $request->get('user');
                $password = $request->get('password');
                $em = $this->getDoctrine()->getManager();

                $repository = $em->getRepository('Ticket\Entity\Users');
                $username = $repository->findOneBy(array('username'=>$user,'password'=>$password));

                if (!$session->get('token') && $username) {
                    $token = $this->get('token_generator')->getToken();
                    $session->set('token', $token, 'user', $username);
                } else {
                    $session->set('alert', 'Invalid Username and/or Password!');
                    return $this->redirect($this->generateUrl('homepage'));
                }
                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $app['twig']->render('auth/login.html.twig', array('form' => $form));
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration');
    }

    /**
     * Üyelik kayıt formu ve kayıt etme işlemi yapar
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function registerAction(Request $request, Application $app)
    {

        $view = new \Zend_View();
        $form = new SignUpForm();

        $form->setAttrib('class', 'form-signin');
        $form->setAction($app['url_generator']->generate('register'));
        $form->setView($view);

        if ($request->isMethod('POST')) {
            if ($form->isValid($request->request->all())) {
                echo 'uyelik denemesi';exit;
            }
        }

        return $app['twig']->render('auth/register.html.twig', array('form' => $form));
    }
}