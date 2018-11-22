<?php

namespace Nanotech\CanhebergementAdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class UtilisateurAdminController extends CRUDController
{
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }
        $datagrid = $this->admin->getDatagrid();
        //$datagrid->getQuery()->;
        $formView = $datagrid->getForm()->createView();
        $actionForm = $this->get('form.factory')->createNamedBuilder('', 'form')
            ->add('testedAt', 'sonata_type_date_picker', array('label' => 'zum'))
            ->getForm();
         //set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('list'), array(
            'action'     => 'list',
            'form'       => $formView,
            'actionForm' => $actionForm->createView(),
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ));
    }


}

