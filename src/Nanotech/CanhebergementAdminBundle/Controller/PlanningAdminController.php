<?php

namespace Nanotech\CanhebergementAdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PlanningAdminController extends CRUDController
{

    public function downloadAction()
    {
        $object = $this->admin->getSubject();



        $this->addFlash('sonata_flash_success', 'Cloned successfully');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}
