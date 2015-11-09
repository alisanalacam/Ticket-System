<?php

namespace Ticket\Form;

class TicketForm extends \EasyBib_Form
{
    public function init()
    {
        $this->setMethod('post');

        $subject        = new \Zend_Form_Element_Text('subject');
        $content        = new \Zend_Form_Element_Textarea('content');
        $priorityId     = new \Zend_Form_Element_Select('priorityId');
        $categories     = new \Zend_Form_Element_Select('categories', array('multiple' => true));
        $submit         = new \Zend_Form_Element_Button('submit');
        $cancel         = new \Zend_Form_Element_Button('cancel');
        //$hash           = new \Zend_Form_Element_Hash('csrf');

        $subject->setLabel('Konu:')
            ->setAttrib('placeholder', 'Konu giriniz!')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setDescription('')
            ->setErrorMessages(array('required' => 'Bu alan gereklidir!'));

        $content->setLabel('Mesaj:')
            ->setAttrib('placeholder', 'Mesaj giriniz!')
            ->setAttrib('class', 'form-control')
            ->setAttrib('rows', '5')
            ->setRequired(true)
            ->setDescription('')
            ->setErrorMessages(array('required' => 'Bu alan gereklidir!'));

        $priorityId->setLabel('Öncelik:')
            ->setAttrib('placeholder', 'Öncelik seçiniz!')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setDescription('')
            ->setErrorMessages(array('required' => 'Bu alan gereklidir!'));

        $categories->setLabel('Kategori:')
            ->setAttrib('placeholder', 'Kategori seçiniz!')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setDescription('')
            ->setValidators(array('StringLength'))
            ->setErrorMessages(array('StringLength' => 'En az bir tane seçmelisiniz!', 'reuqired' => 'Bu alan gereklidir'));

        $submit->setLabel('Kaydet')
            ->setAttrib('class', 'btn btn-lg btn-primary btn-block')
            ->setAttrib('type', 'submit');

        $cancel->setLabel('İptal')
            ->setAttrib('class', 'btn btn-md btn-default btn-block')
            ->setAttrib('type', 'reset');

        //$hash->setIgnore(true);

        // add elements
        $this->addElements(array(
         /*$hash, */$subject, $content, $priorityId, $categories, $submit, $cancel
        ));

        // add display group
        $this->addDisplayGroup(
            array(/*'hash', */'subject', 'content', 'priorityId', 'categories', 'submit', 'cancel'),
            'users'
        );

        // set decorators
        \EasyBib_Form_Decorator::setFormDecorator($this, \EasyBib_Form_Decorator::BOOTSTRAP_MINIMAL, 'submit', 'cancel');
    }
}