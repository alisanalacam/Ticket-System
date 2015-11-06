<?php

namespace Ticket\Form;

class SignInForm extends \EasyBib_Form
{
    public function init()
    {
        $this->setMethod('post');
        $mail        = new \Zend_Form_Element_Text('email');
        $password    = new \Zend_Form_Element_Password('password');
        $submit      = new \Zend_Form_Element_Button('submit');

        $mail->setLabel('Eposta:')
            ->setAttrib('placeholder', 'eposta adresinizi giriniz!')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setDescription('')
            ->addValidator('emailAddress')
            ->setErrorMessages(array('emailAddress' => 'Geçerli bir eposta adresi giriniz!'));

        $password->setLabel('Parola:')
            ->setRequired(true)
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', '*****')
            ->setValidators(array(
                array('validator' => 'StringLength', 'options' => array(5, 30))
            ))
            ->setErrorMessages(array('StringLength' => 'En Az 5 karakter ve en fazla 30 karakter olabilir!'));

        $submit->setLabel('Giriş')
            ->setAttrib('class', 'btn btn-lg btn-primary btn-block')
            ->setAttrib('type', 'submit');

        // add elements
        $this->addElements(array(
            $mail, $password, $submit
        ));
        // add display group
        $this->addDisplayGroup(
            array('email', 'password', 'submit'),
            'users'
        );

        // set decorators
        \EasyBib_Form_Decorator::setFormDecorator($this, \EasyBib_Form_Decorator::BOOTSTRAP_MINIMAL, 'submit', 'cancel');
    }
}