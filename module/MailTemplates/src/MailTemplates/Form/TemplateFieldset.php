<?php
namespace MailTemplates\Form;

use MailTemplates\Model\Template;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class TemplateFieldset extends Fieldset
{
  public function __construct($name = null, $options = array())
  {
    parent::__construct($name, $options);

    $this->setHydrator(new ClassMethods(false));
    $this->setObject(new Template());

    $this->add([
      'type' => 'hidden',
      'name' => 'id',
    ]);

    $this->add([
      'type' => 'text',
      'name' => 'name',
      'options' => [
        'label' => 'Nombre'
      ]
    ]);


  }
}
