<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Nanotech\CanhebergementBundle\Form\InternauteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = $usr->getInternaute();
        $form = $this->get('form.factory')->create(InternauteType::class, $internaute);
        if ($request->isMethod('POST')) {
             $form->handleRequest($request);
             if ($form->isValid()) {
                 $em = $this->getDoctrine()->getManager();
                 $em->persist($internaute);
                 $em->flush();
                 $url = $this->generateUrl('nanotech_canhebergement_client_profil');
                return $this->redirect($url);
            }
        }

        return $this->render('NanotechCanhebergementBundle:Client:modification_information.html.twig',["form"=>$form->createView()]);

    }

    public function modifierpassAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $ancien = $request->request->get('rsv-anc');
            $nouveau = $request->request->get('rsv-pwd');
            $nouveau2 = $request->request->get('rsv-pwd2');
            if($nouveau == $nouveau2){
                $usr= $this->get('security.token_storage')->getToken()->getUser();
                $encoder_service = $this->get('security.encoder_factory');
                $encoder = $encoder_service->getEncoder($usr);
                if($encoder ->isPasswordValid($usr->getPassword(),$ancien,$usr->getSalt())){
                    $usr->setPlainPassword($nouveau);
                    $em->merge($usr);
                    $em->flush();
                    $url = $this->generateUrl('nanotech_canhebergement_client_profil');
                    return $this->redirect($url);
                }

            }

        }

        return $this->render('NanotechCanhebergementBundle:Client:modification_password.html.twig');

    }

    public function factureAction($id){

        $em = $this->getDoctrine()->getManager();
        $reservationconfirmer = $em->getRepository('NanotechCanhebergementBundle:ReservationConfirme')->findOneById($id);

        return $this->render('@NanotechCanhebergement/Default/facture.html.twig',["reservationconfirmer"=>$reservationconfirmer]);

    }

    public function exportpdfAction(){
        $pageUrl = $this->generateUrl('nanotech_canhebergement_facture', array(), true); // use absolute path!

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutput($pageUrl),
            'file.pdf'
        );
    }

    public function nbrreserAction(){
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = $usr->getInternaute();
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('NanotechCanhebergementBundle:Reservation')->findBy(["internaute"=>$internaute,"confirme"=>false ],["dateEnreg"=>"DESC"]);
        return new Response(count($reservation));

    }

    public function nbrreserconfirmerAction(){

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

        return new Response(count($tmpconfirmer));
    }

    public function supprimerresaAction($id){
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = $usr->getInternaute();
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('NanotechCanhebergementBundle:Reservation')->findOneBy(["id"=>$id,"internaute"=>$internaute]);
        if($reservation){
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nanotech_canhebergement_client_index'));
    }

    public function confirmerpaiementAction($id){
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = $usr->getInternaute();
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('NanotechCanhebergementBundle:Reservation')->findOneBy(["id"=>$id]);
        $paiements = $em->getRepository('NanotechCanhebergementBundle:MoyenPaiement')->findByEnable(true);

        return $this->render('NanotechCanhebergementBundle:Client:payerreservation.html.twig',["reser"=>$reservation,"paiments"=>$paiements]);
    }
}
