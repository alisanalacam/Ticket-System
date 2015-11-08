<?php

namespace Ticket\Form;

class SignUpForm extends \EasyBib_Form
{
    public function init()
    {
        $this->setMethod('post');

        $name           = new \Zend_Form_Element_Text('name');
        $surname        = new \Zend_Form_Element_Text('surname');
        $mail           = new \Zend_Form_Element_Text('email');
        $password       = new \Zend_Form_Element_Password('password');
        $verifypassword = new \Zend_Form_Element_Password('verifypassword');
        $submit         = new \Zend_Form_Element_Button('submit');
        $cancel         = new \Zend_Form_Element_Button('cancel');
        //$hash           = new \Zend_Form_Element_Hash('csrf');

        $name->setLabel('İsim:')
            ->setAttrib('placeholder', 'isim giriniz!')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setDescription('')
            ->setErrorMessages(array('required' => 'Bu alan gereklidir!'));

        $surname->setLabel('Soyisim:')
            ->setAttrib('placeholder', 'Soyisim giriniz!')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setDescription('')
            ->setErrorMessages(array('required' => 'Bu alan gereklidir!'));

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

        $verifypassword->setLabel('Parola Onay:')
            ->setRequired(true)
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', '*****')
            ->addValidator('Identical', false, array('token' => 'password'))
            ->setErrorMessages(array('Identical' => 'Girilen parolalar aynı olmalıdır!'));

        $submit->setLabel('Üye Ol')
            ->setAttrib('class', 'btn btn-lg btn-primary btn-block')
            ->setAttrib('type', 'submit');

        $cancel->setLabel('İptal')
            ->setAttrib('class', 'btn btn-md btn-default btn-block')
            ->setAttrib('type', 'reset');

        //$hash->setIgnore(true);

        // add elements
        $this->addElements(array(
         /*$hash, */$name, $surname, $mail, $password, $verifypassword, $submit, $cancel
        ));

        // add display group
        $this->addDisplayGroup(
            array(/*'hash', */'name', 'surname', 'email', 'password', 'verifypassword', 'submit', 'cancel'),
            'users'
        );

        // set decorators
        \EasyBib_Form_Decorator::setFormDecorator($this, \EasyBib_Form_Decorator::BOOTSTRAP_MINIMAL, 'submit', 'cancel');
    }
}