<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));;
        $partenaires = $em->getRepository('NanotechCanhebergementBundle:Partenaire')->findBy(array(), array('dateEnreg' => 'DESC'), 5, 0);;
       
        $parametre = $em->getRepository('NanotechCanhebergementBundle:Parametre')->findOneById(2);
        
        
        return $this->render('NanotechCanhebergementBundle:Default:index.html.twig', array(
             'partenaires' => $partenaires,
          
             'banieres' => $banieres,
             'parametre' => $parametre,
           
                
                ));
    }
    
      public function hotelAction()
    {
        return $this->render('NanotechCanhebergementBundle:Default:hotel.html.twig');
    }
    
      public function reservationAction()
    {
        return $this->render('NanotechCanhebergementBundle:Default:reservation.html.twig');
    }
    
      public function rechercheAction()
    {
        return $this->render('NanotechCanhebergementBundle:Default:recherche.html.twig');
    }
    
      public function recherchemaisonAction()
    {
        return $this->render('NanotechCanhebergementBundle:Default:recherchemaison.html.twig');
    }
}
