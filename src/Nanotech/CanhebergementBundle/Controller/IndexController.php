<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
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

    public function factureAction(){
        return $this->render('@NanotechCanhebergement/Default/facture.html.twig');

    }

    public function exportpdfAction(){
        $pageUrl = $this->generateUrl('nanotech_canhebergement_facture', array(), true); // use absolute path!

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutput($pageUrl),
            'file.pdf'
        );
    }
}
