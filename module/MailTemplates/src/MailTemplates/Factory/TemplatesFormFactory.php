<?php
namespace MailTemplates\Factory;

use Zend\ServiceManager\{FactoryInterface, ServiceLocatorInterface};
use MailTemplates\Form\TemplateForm;

class TemplatesFormFactory implements FactoryInterface
{
  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $services = $serviceLocator->getServiceLocator();
    $entityManager  = $services->get('Doctrine\ORM\EntityManager');

    $form = new TemplateForm($entityManager);
    return $form;
  }
}
