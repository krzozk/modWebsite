<?php
namespace Website\Form;

use Zend\InputFilter\InputFilter;
use Zend\Config\Reader\Ini;

/**
 * Class that handles the validations of the Contact form.
 * @author
 *
 */
class ContactFilter extends InputFilter
{

    /**
     * Constructor the field validators are assigned.
     */
    public function __construct($translator)
    {
        $reader = new Ini();
        $data   = $reader->fromFile(__DIR__.'/../../../../../config/config.ini');

        /*$this->add(array(
                'name' => 'price',
                'required'=> true,
                'validators' => array(
                        array(
                            'name' => 'Digits',
                            'options' => array(
                                'messages' => array(
                                    \Zend\Validator\Digits::NOT_DIGITS =>
                                    'Price is not valid'
                                )
                            ),
                            'break_chain_on_failure' => true

                        )
                ),
                'filters' => array(
                        array(
                            'name' => 'StringTrim'
                        )
                )
        ));*/
/*
        $this->add(array(
            'name' => 'comment',
            'required'=> true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::STRING =>
                                $translator->translate('Comments is not valid')
                        )
                    ),
                    'break_chain_on_failure' => true

                )
            ),
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                )
            )
        ));
*/
    }
}