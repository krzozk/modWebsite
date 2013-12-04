<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Website\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

use Website\Dao\ContactDao;

use Zend\Mvc\MvcEvent;


class WebsiteController extends AbstractActionController
{
    public function indexAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/index/index.twig');
        return $viewmodel;
    }

    public function authoringAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/authoring/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }

    public function hostingAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/hosting/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }

    public function coursesAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/courses/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }

    public function pricingAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/pricing/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }

    public function aboutUsAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/about/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }

/*
    public function contactUsAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/contact/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }
*/
    public function termsOfServiceAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/termsOfService/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }

    public function privacyPolicyAction()
    {
        $viewmodel = new ViewModel(array());
        $viewmodel->setTemplate('website/privacyPolicy/index.twig');
        return $viewmodel;
        //return $this->redirect()->toRoute('login');
    }

    public function contactUsAction()
    {
        /*
        $sessioncontainer = new Container('userlogged');
        $user = $this->getServiceLocator()
            ->get('Application\Dao\UserDao')
            ->getOneBy(
                array('email'=>$sessioncontainer->username)
            );
        if ($user==null){
            return $this->redirect()->toRoute('login');
        }*/
        $viewmodel = new ViewModel();
        //$viewmodel->setVariable('user', $user);

        $form = $this->getServiceLocator()->get('Website\Form\Contact');

        $viewmodel->setVariable('form', $form);
        $viewmodel->setTemplate(
            'website/contact/createcontact.twig'
        );
        return $viewmodel;
    }

    public function createContactAction()
    {
        /*
       $sessioncontainer = new Container('userlogged');
       $user = $this->getServiceLocator()
           ->get('Application\Dao\UserDao')
           ->getOneBy(
               array('email'=>$sessioncontainer->username)
           );
       if ($user==null){
           return $this->redirect()->toRoute('login');
       }*/
        $content = $this->getRequest()->getContent();

        $viewmodel = new ViewModel();
        //$viewmodel->setVariable('user', $user);
        $form = $this->getServiceLocator()->get('Website\Form\Contact');
        $data = json_decode($content,true);
        $form->setData($data);

        if ($form->isValid()) {
            $contact = new \Website\Entity\Contact();
            $contact->setName($form->getInputFilter()->getValue('name'));
            $contact->setEmail($form->getInputFilter()->getValue('email'));
            $contact->setComment($form->getInputFilter()->getValue('comment'));
            $contact->setCreatedAt(new \DateTime('now'));

            $courseId = $this->getServiceLocator()
                ->get('Website\Dao\ContactDao')
                ->save($contact);
        }
        //$viewmodel->setVariable('form', $form);
        //$viewmodel->setTemplate(
        //    'website/contact/createcontact.twig'
        //);
        //return $viewmodel;
        return "Exito";
    }
}
