<?php

namespace Ticket\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Ticket\Entity\User;
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
        $form->setAction($app['url_generator']->generate('login_check'));
        $form->setView($view);

        return $app['twig']->render('auth/login.html.twig', array('form' => $form));
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

        if ($request->getMethod() == 'POST') {
            if ($form->isValid($request->request->all())) {

                $data = $form->getValues();

                // Eposta sistemde mevcut mu?
                $existEmail = $app['orm.em']->getRepository('Ticket\Entity\User')->findOneBy(array(
                    'deleted' => 0,
                    'email' => $data['email']
                ));

                // eposta sistemde mevcut ise
                if ($existEmail !== null) {

                    $form->getElement('email')->setErrors(array('Bu eposta adresi sistemde mevcut!'));

                    return $app['twig']->render('auth/register.html.twig', array('form' => $form));
                }

                $user = new User();

                $user->setName($data['name']);
                $user->setSurname($data['surname']);
                $user->setPassword($app['security.encoder.digest']->encodePassword($data['password'], $user->getSalt()));
                $user->setRole('ROLE_USER');
                $user->setEmail($data['email']);
                $user->setEnabled(true);
                $user->setCreatedAt(new \DateTime());
                $user->setDeleted(0);

                $app['orm.em']->persist($user);
                $app['orm.em']->flush();

                $message = 'Hesabınız başarıyla oluşturuldu sisteme giriş yapabilirsiniz.';
                $app['session']->getFlashBag()->add('success', $message);

                $redirect = $app['url_generator']->generate('login');
                return $app->redirect($redirect);
            }
        }

        return $app['twig']->render('auth/register.html.twig', array('form' => $form));
    }

    /**
     * Kontrol esnasında firewall yapılandırma hatası olursa
     */
    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }

    /**
     * Çıkış esnasında firewall yapılandırma hatası olursa
     */
    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration');
    }
}