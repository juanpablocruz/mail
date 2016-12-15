<?php
namespace MailPartials\Controller;

use MailPartials\Entity\Partial;
use MailPartials\Form\PartialForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class MailPartialsController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $partials = $objectManager
            ->getRepository('\MailPartials\Entity\Partial')
            ->findBy(array(), array('id' => 'ASC'));

        $partials_array = [];
        foreach ($partials as $partial) {
            $partials_array[] = $partial->getArrayCopy();
        }

        return [
            'partials' => $partials_array,
            'total' => count($partials_array)
        ];
    }

    public function addAction()
    {
        $form = new PartialForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

                $partial = new Partial();
                $partialData = array_merge($form->getData(), ['tags' => json_encode($this->getContentVars($request->getPost()->get('content')))]);
                $partial->exchangeArray($partialData);

                $objectManager->persist($partial);
                $objectManager->flush();
            }
        } else {
            return ['form' => $form];
        }
        return $this->redirect()->toRoute('partials');
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('partials');
        }

        $form = new PartialForm();
        $form->get('submit')->setValue('Save');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $partial = $objectManager
                ->getRepository('\MailPartials\Entity\Partial')
                ->findOneBy(array('id' => $id));
            if (!$partial) {
                $this->flashMessenger()->addErrorMessage(sprintf('Partial with id %s doesn\'t exists', $id));
                return $this->redirect()->toRoute('partials');
            }
            // Fill form data.
            $form->bind($partial);
            return array('form' => $form, 'id' => $id, 'partial' => $partial);
        } else {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $data = $form->getData();
                $id = $data['id'];
                try {
                    $partial = $objectManager->find('\MailPartials\Entity\Partial', $id);
                } catch (\Exception $ex) {
                    return $this->redirect()->toRoute('partials');
                }
                try {
                    $partialData = array_merge($form->getData(), ['tags' => json_encode($this->getContentVars($request->getPost()->get('content')))]);
                    $partial->exchangeArray($partialData);

                    $objectManager->persist($partial);
                    $objectManager->flush();

                    $message = 'Partial succesfully saved!';
                    $this->flashMessenger()->addSuccessMessage($message);
                } Catch (\Exception $ex) {
                    $message = $ex
                        ->getMessage();
                    $this->flashMessenger()->addErrorMessage($message);
                }
                return $this->redirect()->toRoute('partials');
            } else {
                $message = 'Error while saving the partial';
                $this->flashMessenger()->addErrorMessage($message);
                return $this->redirect()->toRoute('partials');
            }
        }
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Partial id doesn\'t set');
            return $this->redirect()->toRoute('partials');
        }

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $request = $this->getRequest();
        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Partial id doesn\'t set');
            return $this->redirect()->toRoute('partials');
        }
        try {
            $partial = $objectManager->find('\MailPartials\Entity\Partial', $id);
            $objectManager->remove($partial);
            $objectManager->flush();
        } catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage('Error while deleting data');
            return $this->redirect()->toRoute('partials');
        }

        $this->flashMessenger()->addMessage(sprintf('Partial %d was succesfully deleted', $id));

        return $this->redirect()->toRoute('partials');
    }

    private function getContentVars($content)
    {
        preg_match_all('/##(\w*)##/i', $content, $match);
        return (isset($match[0])) ? $match[0] : null;
    }
}