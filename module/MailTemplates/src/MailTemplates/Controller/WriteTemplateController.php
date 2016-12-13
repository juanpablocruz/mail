<?php
namespace MailTemplates\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use MailTemplates\Model\Template;
use MailPartials\Entity\Partials;

class WriteTemplateController extends AbstractActionController
{
  protected $mailTemplateService;
  protected $templateForm;

  public function __construct(
              EntityManager $mailTemplateService,
              FormInterface $_templateForm)
  {
    $this->mailTemplateService = $mailTemplateService;
    $this->templateForm = $_templateForm;
  }

  public function addAction()
  {
    $request = $this->getRequest();

    if($request->isPost())
    {

      $template = new Template();

      $this->templateForm->setData($request->getPost());
      $this->templateForm->setInputFilter($template->getInputFilter());
      // $this->templateForm->setObject(new Template());
      $data = $request->getPost();

      if($this->templateForm->isValid())
      {
        try {
          $id = $data->toArray()["partial"];
          $p = $this->mailTemplateService->find('MailPartials\Entity\Partial',$id);
          $data = $this->templateForm->getData();
          $data["partial"] = $p;
          $template->exchangeArray($data);
          $this->mailTemplateService->persist($template);
          $this->mailTemplateService->flush();

          return $this->redirect()->toRoute('mail/templates');
        } catch (\Exception $e)
        {
          echo "Caught exception: " . get_class($e) . "\n";
          echo "Message: " . $e->getMessage() . "\n";
        }
      }
    }
    return ['form'=> $this->templateForm];
  }

  public function editAction()
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

      $this->templateForm->bind($template);

      $request = $this->getRequest();
      if($request->isPost())
      {
        $this->templateForm->setData($request->getPost());
        $this->templateForm->setInputFilter($template->getInputFilter());

        if($this->templateForm->isValid())
        {
          $data = $request->getPost();
          $i = $data->toArray()["partial"];
          $p = $this->mailTemplateService->find('MailTemplates\Model\Partial',$i);
          $template->setPartials([$p]);
          // \Zend\Debug\Debug::dump($template->getPartials());die();

          $this->mailTemplateService->flush();
          return $this->redirect()->toRoute('mail/templates');
        }
      }
      return ["id"=>$id, "form"=>$this->templateForm];
  }

}
