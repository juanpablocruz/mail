<?php
namespace MailTemplates\Service;

use MailTemplates\Model\MailTemplateInterface;

interface TemplateServiceInterface
{
  public function findAllTemplates();
  public function findTemplate(int $id);
  public function saveTemplate(MailTemplateInterface $template);
  public function deleteTemplate(MailTemplateInterface $template);
}
?>
