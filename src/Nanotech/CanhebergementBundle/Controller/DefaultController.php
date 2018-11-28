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
        $comclient = $em->getRepository('NanotechCanhebergementBundle:CommentaireClient')->findBy(array(), array('dateEnreg' => 'DESC'), 4, 0);;
        $parametre = $em->getRepository('NanotechCanhebergementBundle:Parametre')->findOneById(1);
        
        
        return $this->render('NanotechCanhebergementBundle:Default:index.html.twig', array(
             'partenaires' => $partenaires,
             'comclients' => $comclient,
             'banieres' => $banieres,
             'parametre' => $parametre,
           
                
                ));
    }
    
      public function hotelAction()
    {
        $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));
        
        return $this->render('NanotechCanhebergementBundle:Default:hotel.html.twig', array(
                             'banieres' => $banieres,
                ));
    }
    
      public function reservationAction()
    {
          $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));
        return $this->render('NanotechCanhebergementBundle:Default:reservation.html.twig', array(
                             'banieres' => $banieres,
                ));
    }
    
      public function rechercheAction()
    {
          $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));
        return $this->render('NanotechCanhebergementBundle:Default:recherche.html.twig', array(
                             'banieres' => $banieres,
                ));
    }
    
      public function recherchemaisonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));
        return $this->render('NanotechCanhebergementBundle:Default:recherchemaison.html.twig', array(
                             'banieres' => $banieres,
                ));
    }
    
     public function inscriptionAction()
    {
         $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));
        return $this->render('NanotechCanhebergementBundle:Default:inscription.html.twig', array(
                             'banieres' => $banieres,
                ));
    }

    public function banniereAction(){
        $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'ASC'));
        return $this->render('NanotechCanhebergementBundle:Default:banniere.html.twig', array(
            'banieres' => $banieres,
        ));
    }

    public function footerAction(){
        return $this->render('NanotechCanhebergementBundle:Default:footer.html.twig', array());
    }

    public function menuAction($id=0){
        return $this->render('NanotechCanhebergementBundle:Default:menu.html.twig', array('id'=>$id));
    }
}
