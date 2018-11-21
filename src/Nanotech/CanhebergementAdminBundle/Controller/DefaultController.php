<?php

namespace Nanotech\CanhebergementAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NanotechCanhebergementAdminBundle:Default:index.html.twig');
    }
    
   
      
}
