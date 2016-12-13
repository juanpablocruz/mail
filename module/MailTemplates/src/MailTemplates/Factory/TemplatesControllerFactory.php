<?php
namespace MailTemplates\Factory;

use MailTemplates\Controller\MailTemplatescontroller;
use Zend\ServiceManager\{ServiceLocatorInterface, FactoryInterface};

class TemplatesControllerFactory implements FactoryInterface
{
  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $realServiceLocator = $serviceLocator->getServiceLocator();
    // $templateService = $realServiceLocator->get('MailTemplates\Service\MailTemplateServiceInterface');
    $templateService = $realServiceLocator->get('doctrine.entitymanager.orm_default');
    return new MailTemplatescontroller(
      $templateService
    );
  }
}
