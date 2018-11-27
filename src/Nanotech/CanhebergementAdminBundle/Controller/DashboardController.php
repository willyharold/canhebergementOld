<?php

namespace Nanotech\CanhebergementAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    //tu ecris les fonctions qui permettent de compter et tu utilise response. puis tu vas dans ressource core et tu vois commment j'appelle le controlleur si
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('NanotechCanhebergementBundle:Utilisateur')->findAll();
        if (empty($entity)) {
            return new Response(0);
        }

        return new Response(count($entity));
    }
    
     public function index1Action()
    {

        $em = $this->getDoctrine()->getManager();
        $partenaire = $em->getRepository('NanotechCanhebergementBundle:Partenaire')->findAll();
        if (empty($partenaire)) {
            return new Response(0);
        }

        return new Response(count($partenaire));
    }
    
    public function index2Action()
    {

        $em = $this->getDoctrine()->getManager();
        $cartebar = $em->getRepository('NanotechCanhebergementBundle:CarteBar')->findAll();
        if (empty($cartebar)) {
            return new Response(0);
        }

        return new Response(count($cartebar));
    }
    
     public function index3Action()
    {

        $em = $this->getDoctrine()->getManager();
         $carterestaurant = $em->getRepository('NanotechCanhebergementBundle:CarteRestaurant')->findAll();
        if (empty($carterestaurant)) {
            return new Response(0);
        }

        return new Response(count($carterestaurant));
    }
    
     public function index4Action()
    {

        $em = $this->getDoctrine()->getManager();
       $piece = $em->getRepository('NanotechCanhebergementBundle:Piece')->findAll();
        if (empty($piece)) {
            return new Response(0);
        }

        return new Response(count($piece));
    }
    
       public function index5Action()
    {

        $em = $this->getDoctrine()->getManager();
     $planning = $em->getRepository('NanotechCanhebergementBundle:Planning')->findAll();
        if (empty($planning)) {
            return new Response(0);
        }

        return new Response(count($planning));
    }
    
      public function index6Action()
    {

        $em = $this->getDoctrine()->getManager();
      $commandebar = $em->getRepository('NanotechCanhebergementBundle:CommandeBar')->findAll();
        if (empty($commandebar)) {
            return new Response(0);
        }

        return new Response(count($commandebar));
    }
    
     public function index7Action()
    {

        $em = $this->getDoctrine()->getManager();
      $commanderestaurant = $em->getRepository('NanotechCanhebergementBundle:CommandeRestaurant')->findAll();
        if (empty($commanderestaurant)) {
            return new Response(0);
        }

        return new Response(count($commanderestaurant));
    }
    
     public function index8Action()
    {

        $em = $this->getDoctrine()->getManager();
     $reservation = $em->getRepository('NanotechCanhebergementBundle:Reservation')->findAll();
        if (empty($reservation)) {
            return new Response(0);
        }

        return new Response(count($reservation));
    }
    
     public function index9Action()
    {

        $em = $this->getDoctrine()->getManager();
    $commentaire = $em->getRepository('NanotechCanhebergementBundle:Commentaire')->findAll();
        if (empty($commentaire)) {
            return new Response(0);
        }

        return new Response(count($commentaire));
    }
    
     public function index10Action()
    {

        $em = $this->getDoctrine()->getManager();
   $reservationconf = $em->getRepository('NanotechCanhebergementBundle:ReservationConfirme')->findAll();
        if (empty($reservationconf)) {
            return new Response(0);
        }

        return new Response(count($reservationconf));
    }
    
      public function index11Action()
    {

        $em = $this->getDoctrine()->getManager();
    $payer = $em->getRepository('NanotechCanhebergementBundle:Payer')->findAll();
        if (empty($payer)) {
            return new Response(0);
        }

        return new Response(count($payer));
    }
    
      
}
