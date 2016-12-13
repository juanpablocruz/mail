<?php
namespace MailTemplates\Model;

interface MailTemplateInterface
{
  public function getId():int;
  public function getName():string;
}
