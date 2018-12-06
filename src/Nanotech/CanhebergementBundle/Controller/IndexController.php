<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('NanotechCanhebergementBundle:Categorie')->findAll();
        $comclient = $em->getRepository('NanotechCanhebergementBundle:CommentaireClient')->findBy(array(), array('dateEnreg' => 'DESC'), 4, 0);
        $parametre = $em->getRepository('NanotechCanhebergementBundle:Parametre')->findOneById(1);


        return $this->render('NanotechCanhebergementBundle:Default:index.html.twig', array(
            'categories' => $categorie,
            'comclients' => $comclient,
            'parametre' => $parametre,


        ));
    }
}
