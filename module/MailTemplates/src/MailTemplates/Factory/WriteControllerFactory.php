<?php
namespace MailTemplates\Factory;

use MailTemplates\Controller\WriteTemplatecontroller;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

class WriteControllerFactory implements FactoryInterface
{
  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $realServiceLocator = $serviceLocator->getServiceLocator();
    $templateService = $realServiceLocator->get('doctrine.entitymanager.orm_default');
    $templateForm = $realServiceLocator->get('FormElementManager')
                                        ->get('MailTemplates\Form\TemplateForm');

    return new WriteTemplateController(
      $templateService,
      $templateForm
    );
  }
}
