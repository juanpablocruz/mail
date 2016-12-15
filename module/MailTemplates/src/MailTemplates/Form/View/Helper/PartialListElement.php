<?php
namespace MailTemplates\Form\View\Helper;

use MailTemplates\Form\Element\PartialsElement;
use Zend\Form\View\Helper\FormElement as BaseFormElement;
use Zend\Form\ElementInterface;

class PartialListElement extends BaseFormElement
{
  public function render(ElementInterface $element)
  {
    $renderer = $this->getView();
    if (!method_exists($renderer, 'plugin')) {
        // Bail early if renderer is not pluggable
        return '';
    }

    if ($element instanceof Element\Foo) {
        $helper = $renderer->plugin('form_foo');
        return $helper($element);
    }
    return parent::render($element);
  }
}
