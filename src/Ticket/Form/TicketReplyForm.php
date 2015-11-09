<?php

namespace Ticket\Form;

class TicketReplyForm extends \EasyBib_Form
{
    public function init()
    {
        $this->setMethod('post');

        $content        = new \Zend_Form_Element_Textarea('content');
        $submit         = new \Zend_Form_Element_Button('submit');
        $cancel         = new \Zend_Form_Element_Button('cancel');
        //$hash           = new \Zend_Form_Element_Hash('csrf');

        $content->setLabel('Mesaj:')
            ->setAttrib('placeholder', 'Mesaj giriniz!')
            ->setAttrib('class', 'form-control')
            ->setAttrib('rows', '5')
            ->setRequired(true)
            ->setDescription('')
            ->setErrorMessages(array('required' => 'Bu alan gereklidir!'));

        $submit->setLabel('Yanıtla')
            ->setAttrib('class', 'btn btn-lg btn-primary btn-block')
            ->setAttrib('type', 'submit');

        $cancel->setLabel('İptal')
            ->setAttrib('class', 'btn btn-md btn-default btn-block')
            ->setAttrib('type', 'reset');

        //$hash->setIgnore(true);

        // add elements
        $this->addElements(array(
         /*$hash, */$content, $submit, $cancel
        ));

        // add display group
        $this->addDisplayGroup(
            array(/*'hash', */'content', 'submit', 'cancel'),
            'ticker_replies'
        );

        // set decorators
        \EasyBib_Form_Decorator::setFormDecorator($this, \EasyBib_Form_Decorator::BOOTSTRAP_MINIMAL, 'submit', 'cancel');
    }
}