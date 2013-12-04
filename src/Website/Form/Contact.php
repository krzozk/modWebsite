<?php
namespace Website\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Config\Reader\Ini;
use Zend\InputFilter;
/**
 * Class with the elements of the Contact form.
 * @author
 *
 */
class Contact extends Form
{
    /**
     * Constructor where the form elements are created and assigned to the form.
     */

    public function __construct($translator, $sm)
    {
        $reader = new Ini();
        $data   = $reader->fromFile(
            __DIR__.'/../../../../../config/config.ini'
        );

        parent::__construct('createcontact');
        $this->setAttribute('action', '/contact/create');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        $courseFilter = new \Website\Form\ContactFilter($translator);
        $this->setInputFilter($courseFilter);

        $name = new Element('name');
        $name->setAttributes(array('type' => 'text', 'id' => 'name', 'required' => 'required',
            'class' => 'form-control'));
        $this->add($name);

        $email = new Element('email');
        $email->setAttributes(array('type' => 'text', 'id' => 'email', 'required' => 'required',
            'class' => 'form-control'));
        $this->add($email);

        $comment = new Element('comment');
        $comment->setAttributes(array('type' => 'textarea', 'id' => 'comment', 'required' => 'required',
            'class' => 'form-control'));
        $this->add($comment);

        $create = new Element\Button('create');
        $create->setLabel($translator->translate("Create Contact"));
        $create->setAttributes(
            array('class' => 'btn btn-primary', 'data-ng-click'=>"createContact()")
        );
        $this->add($create);
        $this->addInputFilter();
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $this->setInputFilter($inputFilter);
    }

}
