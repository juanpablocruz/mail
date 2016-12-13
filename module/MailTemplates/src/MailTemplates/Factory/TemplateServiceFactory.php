<?php
namespace MailTemplates\Factory;

use MailTemplates\Service\TemplateService;
use Zend\ServiceManager\{FactoryInterface, ServiceLocatorInterface};

class TemplateServiceFactory implements FactoryInterface
{
  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    
    return new TemplateService(
        $serviceLocator->get('MailTemplates\Mapper\MailTemplateMapperInterface')
      );
  }
}
