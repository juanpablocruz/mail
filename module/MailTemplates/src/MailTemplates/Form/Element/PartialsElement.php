<?php
namespace MailTemplates\Form\Element;

use Zend\Form\Element;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class PartialsElement extends Element implements ViewHelperProviderInterface
{
  /**
   * Seed attributes
   *
   * @var array
   */
  protected $attributes = [
    'type' => 'PartialList',
  ];

  public function getViewHelperConfig()
  {
    return ['type' => 'MailTemplates\Form\View\Helper\PartialsElement'];
  }


}
