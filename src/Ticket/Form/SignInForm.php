<?php

namespace Ticket\Form;

class SignInForm extends \EasyBib_Form
{
    public function init()
    {
        $this->setMethod('post');
        $mail        = new \Zend_Form_Element_Text('email');
        $password    = new \Zend_Form_Element_Text('password');
        $submit      = new \Zend_Form_Element_Button('submit');
        $cancel      = new \Zend_Form_Element_Button('cancel');


        $mail->setLabel('Eposta:')
            ->setAttrib('placeholder', 'eposta adresinizi giriniz!')
            ->setRequired(true)
            ->setDescription('')
            ->addValidator('emailAddress');

        $password->setLabel('Parola:')
            ->setRequired(true);

        $submit->setLabel('Save')
            ->setAttrib('type', 'submit');
        $cancel->setLabel('Cancel');


        /*$this->addElement('text', 'email', array(
            'label' => 'Eposta adresiniz',
            'class' => 'form-control',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                'EmailAdress',
            )
        ));

        $this->addElement('password', 'password', array(
            'label' => 'Şifreniz',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(5, 30))
            )
        ));

        $this->add(
            array('email', 'password'),
            'login',
            array(
                'class' => 'form-control'
            )
        );

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Giriş Yap'
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));*/
        // add elements
        $this->addElements(array(
            $mail, $password, $submit, $cancel
        ));
        // add display group
        $this->addDisplayGroup(
            array('email', 'password', 'submit', 'cancel'),
            'users'
        );

        // set decorators
        \EasyBib_Form_Decorator::setFormDecorator($this, \EasyBib_Form_Decorator::BOOTSTRAP_MINIMAL, 'submit', 'cancel');
    }
}