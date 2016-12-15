<?php
namespace MailTemplates\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;

class PartialsElement extends AbstractHelper;
{
  protected $script = 'mail-templates/form-element/partialList';

  public function __invoke(ElementInterface $element)
  {

      return $this->getView()->render($this->script, ['element'=>$element]);
  }
}
