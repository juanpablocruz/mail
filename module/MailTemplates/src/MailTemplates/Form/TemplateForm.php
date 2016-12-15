<?php
namespace MailTemplates\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class TemplateForm extends Form
{
  protected $entityManager;
  public $partialListData;

  public function __construct(EntityManager $entityManager)
  {
    parent::__construct("template");
    $this->entityManager = $entityManager;
    $this->partialListData = "aa";
  }
  public function init()
  {

    $this->add([
      'name' => 'id',
      'type' => 'hidden',
    ]);

    $this->add([
      'name' => 'partialList',
      'type' => 'hidden',
    ]);
    $this->add([
      'type' => 'submit',
      'name' => 'submit',
      'attributes' => [
        'value' => 'Create new template',
        'class' => 'btn btn-primary btn-sm rounded-s',
      ]
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
