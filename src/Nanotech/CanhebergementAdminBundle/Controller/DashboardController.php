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
    
      
}
