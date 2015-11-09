<?php

namespace Ticket\Form;

class TicketCategoryForm extends \EasyBib_Form
{
    public function init()
    {
        $this->setMethod('post');

        $categoryName   = new \Zend_Form_Element_Text('category_name');
        $submit         = new \Zend_Form_Element_Button('submit');
        $cancel         = new \Zend_Form_Element_Button('cancel');

        $categoryName->setLabel('Kategori Adı:')
            ->setAttrib('placeholder', 'Kategori adı giriniz!')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setDescription('')
            ->setErrorMessages(array('required' => 'Kategori adı gereklidir gereklidir!'));


        $submit->setLabel('Kaydet')
            ->setAttrib('class', 'btn btn-lg btn-primary btn-block')
            ->setAttrib('type', 'submit');

        $cancel->setLabel('İptal')
            ->setAttrib('class', 'btn btn-md btn-default btn-block')
            ->setAttrib('type', 'reset');

        //$hash->setIgnore(true);

        $elementsArray = array(
            /*$hash, */$categoryName, $submit, $cancel
        );

        // add elements
        $this->addElements($elementsArray);

        // add display group
        $this->addDisplayGroup(
            array(/*'hash', */'categoryName', 'submit', 'cancel'),
            'users'
        );

        // set decorators
        \EasyBib_Form_Decorator::setFormDecorator($this, \EasyBib_Form_Decorator::BOOTSTRAP_MINIMAL, 'submit', 'cancel');
    }
}