<?php
namespace MailPartials\Form;

use Zend\Form\Form;

class PartialForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('partial');
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new PartialInputFilter());
//        $this->add(array(
//            'name' => 'security',
//            'type' => 'Zend\Form\Element\Csrf',
//        ));
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'min' => 2,
                'max' => 25,
                'label' => 'Name',
            ),
        ));
        $this->add(array(
            'name' => 'content',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Content',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Save',
                'id' => 'submitbutton',
            ),
        ));
    }
}
