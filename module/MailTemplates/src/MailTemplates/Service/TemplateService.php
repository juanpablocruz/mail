<?php
namespace MailTemplates\Service;

use MailTemplates\Mapper\MailTemplateMapperInterface;
use MailTemplates\Model\MailTemplateInterface;

class TemplateService implements TemplateServiceInterface
{
  protected $templateMapper;

  public function __construct(MailTemplateMapperInterface $templateMapper)
  {
    $this->templateMapper = $templateMapper;
  }

  public function findAllTemplates()
  {
    
    return $this->templateMapper->findAll();
  }

  public function findTemplate(int $id)
  {
    return $this->templateMapper->find($id);
  }

  public function saveTemplate(MailTemplateInterface $template)
  {
    return $this->templateMapper->save($template);
  }
  public function deleteTemplate(MailTemplateInterface $template)
  {
    return $this->templateMapper->delete($template);
  }
}
