<?php
namespace MailTemplates\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;


class TemplateForm extends Form
{
  protected $entityManager;
  public function __construct(EntityManager $entityManager)
  {
    parent::__construct("template");
    $this->entityManager = $entityManager;

  }
  public function init()
  {

    $this->add([
      'name' => 'id',
      'type' => 'hidden',
    ]);

    $this->add([
      'type' => 'text',
      'name' => 'name',
      'options' => [
        'label' => 'Nombre'
      ]
    ]);

    $this->add([
      'name' => 'partial',
      'type' => 'DoctrineModule\Form\Element\ObjectSelect',
      'options' => [
        'object_manager'    => $this->entityManager,
        'target_class'      => 'MailPartials\Entity\Partial',
        'property'          => 'name',

      ],
    ]);

    $this->add([
      'type' => 'submit',
      'name' => 'submit',
      'attributes' => [
        'value' => 'Create new template'
      ]
    ]);
  }


}
