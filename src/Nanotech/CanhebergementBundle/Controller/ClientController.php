<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class ClientController extends Controller
{

    private $tokenManager;

    public function __construct(CsrfTokenManagerInterface $tokenManager = null)
    {
        $this->tokenManager = $tokenManager;
    }

    public function indexAction(Request $request)

    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = $usr->getInternaute();
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('NanotechCanhebergementBundle:Reservation')->findBy(["internaute"=>$internaute,"confirme"=>false ],["dateEnreg"=>"DESC"]);
        return $this->render('@NanotechCanhebergement/Client/index.html.twig',["reservation"=>$reservation]);

    }

    public function confirmerAction(Request $request)
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = $usr->getInternaute();
        $em = $this->getDoctrine()->getManager();
        $confirmer = $em->getRepository('NanotechCanhebergementBundle:ReservationConfirme')->findBy([],["dateEnreg"=>"DESC"]);
        $tmpconfirmer = [];
        foreach ($confirmer as $item){
            if($item->getReservation()->getInternaute() == $internaute){
                array_push($tmpconfirmer,$item);
            }
        }


        return $this->render('NanotechCanhebergementBundle:Client:confirme.html.twig',["confirme"=>$tmpconfirmer]);
    }

    public function profilAction(Request $request)

    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = $usr->getInternaute();
        return $this->render('NanotechCanhebergementBundle:Client:profil.html.twig',["internaute"=> $internaute,"username"=>$usr->getUsername()]);

    }

    public function modifierinfoAction(Request $request)
    {
        return $this->render('NanotechCanhebergementBundle:Client:modification_information.html.twig');

    }

    public function modifierpassAction(Request $request)
    {
        return $this->render('NanotechCanhebergementBundle:Client:modification_password.html.twig');

    }

    public function factureAction($id){


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
