<?php

namespace MailTemplates\Controller;

use MailTemplates\Service\TemplateServiceInterface;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;

class MailTemplatesController extends AbstractActionController
{
    protected $mailTemplateService;

    public function __construct( $mailTemplateService)
    {
      $this->mailTemplateService = $mailTemplateService;
    }

    public function indexAction()
    {

        return ['templates' => $this->mailTemplateService->
                                getRepository('MailTemplates\Model\Template')->findAll()
              ];
    }

    public function detailAction()
    {
      $id = (int) $this->params()->fromRoute('id',0);
      if(!$id)
      {
        return $this->redirect()->toRoute('admin/mail/templates',['action'=>'index']);
      }

      return ['template' => $this->mailTemplateService->find('MailTemplates\Model\Template',$id)];
    }

    public function deleteAction()
    {
      $id = (int) $this->params()->fromRoute('id',0);
      if(!$id)
      {
        return $this->redirect()->toRoute('mail/templates');
      }

      $template = $this->mailTemplateService->find('MailTemplates\Model\Template',$id);
      if(!$template) {
        return $this->redirect()->toRoute('mail/templates');
      }

      $this->mailTemplateService->remove($template);
      $this->mailTemplateService->flush();
      return $this->redirect()->toRoute('mail/templates');
    }
}
