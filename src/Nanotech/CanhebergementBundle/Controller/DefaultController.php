<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NanotechCanhebergementBundle:Default:index.html.twig');
    }
    
      public function hotelAction()
    {
        return $this->render('NanotechCanhebergementBundle:Default:hotel.html.twig');
    }
}
