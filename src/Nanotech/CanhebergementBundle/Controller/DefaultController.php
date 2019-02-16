<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Nanotech\CanhebergementBundle\Entity\Internaute;
use Nanotech\CanhebergementBundle\Entity\Piece;
use Nanotech\CanhebergementBundle\Entity\Reservation;
use Nanotech\CanhebergementBundle\Entity\ReservationConfirme;
use Nanotech\CanhebergementBundle\Entity\Transaction;
use Nanotech\CanhebergementBundle\Entity\Utilisateur;
use Nanotech\CanhebergementBundle\Form\InternauteType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nanotech\CanhebergementBundle\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;
use GuzzleHttp\Client;

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
    
      public function reservationAction(Request $request)

    {

        $error = false;
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $internaute = null;
        if(is_object($usr)){
            $internaute = $usr->getInternaute();
        }
        $connected = false;
        if($internaute){
            $connected = true;
            $form = $this->get('form.factory')->create(InternauteType::class, $internaute);

        }
        else{
            $internaute = new Internaute();
            $form = $this->get('form.factory')->create(InternauteType::class, $internaute);
        }

        $posconnected = $request->request->get('rsv-connected');
        if ($request->isMethod('POST') && isset ($posconnected) ) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                if( ! $posconnected){

                    $resulttes = $em->getRepository('NanotechCanhebergementBundle:Internaute')->findOneByEmail($internaute->getEmail());
                    if(!$resulttes){
                        $resulttes = $em->getRepository('NanotechCanhebergementBundle:Utilisateur')->findOneByEmail($internaute->getEmail());
                    }
                    if(!$resulttes){
                        $em->persist($internaute);
                        $em->flush();
                        $this->createUser($internaute);
                        $piece = $em->getRepository('NanotechCanhebergementBundle:Piece')->findOneById($request->request->get('rsv-idp'));
                        $reservation = $this->createReservation($internaute,$request->request->get('rsv-arriver'),$request->request->get('rsv-depart'),$request->request->get('rsv-quantite'),$piece,$request->request->get('rsv-nbrnuit'));
                        $moyenpaimentid = $request->request->get('rsv-mny');
                        if($moyenpaimentid){
                            $moyenpaiment = $em->getRepository('NanotechCanhebergementBundle:MoyenPaiement')->findOneById($moyenpaimentid);
                            if($moyenpaiment->getNom()=="SafiMoney"){
                                return $this->paiementSafirmoney($reservation);
                            }

                        }
                        else{
                            return $this->render('NanotechCanhebergementBundle:Default:paiementterminer.html.twig',["reser"=> true, "user"=> true ,"payer"=> false ]);
                        }

                    }
                    else{
                        $error = true;
                    }
                }
                else{
                    $piece = $em->getRepository('NanotechCanhebergementBundle:Piece')->findOneById($request->request->get('rsv-idp'));
                    $reservation = $this->createReservation($internaute,$request->request->get('rsv-arriver'),$request->request->get('rsv-depart'),$request->request->get('rsv-quantite'),$piece,$request->request->get('rsv-nbrnuit'));
                    $moyenpaimentid = $request->request->get('rsv-mny');
                    if($moyenpaimentid){
                        $moyenpaiment = $em->getRepository('NanotechCanhebergementBundle:MoyenPaiement')->findOneById($moyenpaimentid);
                        if($moyenpaiment->getNom()=="SafiMoney"){
                            return $this->paiementSafirmoney($reservation);
                        }

                    }
                    else{
                        return $this->render('NanotechCanhebergementBundle:Default:paiementterminer.html.twig',["reser"=> true,"payer"=> false ]);
                    }

                }
            }

        }
        $id = $request->request->get('piece');
        $arrive = $request->request->get('arriver');
        $depart = $request->request->get('depart');
        $quantite = $request->request->get('quantity');
        if(!$id){
            $id = $request->request->get('rsv-idp');
        }
        if(!$quantite){
            $quantite = $request->request->get('rsv-quantite');
        }
        if(!$quantite){
            $quantite = 1;
        }
        if($arrive || !$arrive == ""){
            $arrive = $request->request->get('rsv-arriver');
        }
        if($depart || !$depart == ""){
            $depart = $request->request->get('rsv-depart');
        }

        if($arrive || !$arrive == ""){
            $date1int = date_parse($arrive);
            $date1 = new \DateTime($date1int["year"]."-".$date1int["month"]."-".$date1int["day"]);
        }
        else{
            $date1 = new \DateTime();
        }

        if($depart || !$depart == ""){
            $date2int = date_parse($depart);
            $date2 = new \DateTime($date2int["year"]."-".$date2int["month"]."-".$date2int["day"]);

        }
        else{
            $date2 = new \DateTime();
        }


        if(!$id || $id == "" ){
            throw new BadRequestHttpException();
        }
        $em = $this->getDoctrine()->getManager();

        $piece = $em->getRepository('NanotechCanhebergementBundle:Piece')->findOneById($id);
        $moyenpaiment = $em->getRepository('NanotechCanhebergementBundle:MoyenPaiement')->findByEnable(true);

        $nbrnuit = $this->date( $date1->format('Y-m-d H:i:s'),$date2->format('Y-m-d H:i:s'));
        if($nbrnuit == 0){
            $nbrnuit = 1;
        }


        return $this->render('NanotechCanhebergementBundle:Default:reservation.html.twig', array(
                             'piece' => $piece,
                             'nbrnuit' => $nbrnuit,
                             'date1' =>$date1,
                             'date2' =>$date2,
                             'quantite'=> $quantite,
            'paiments'=>$moyenpaiment,
            'form' => $form->createView(),
            'error'=> $error,
            'connected'=>$connected
                ));
    }
    public function terminersafimoneyAction(Request $request){
        $uuid = $request->query->get("uuid");
        if(!$uuid){
            throw new NotFoundHttpException();
        }
        $em = $this->getDoctrine()->getManager();
        $transaction = $em->getRepository('NanotechCanhebergementBundle:Transaction')->findOneByUuid($uuid);
        if(!$transaction){
            throw new NotFoundHttpException();
        }
        if($transaction->getReservation()->getConfirme() ){
            throw new NotFoundHttpException();
        }

        $client = new Client();
        $res = $client->request('POST', 'https://api.safimoney.com/v1/extern/transaction-status',
            ['form_params' => [ 'api_user'=> '5c23b1e291e22',
                'api_key'=>'dQhVmyLHUfzS8a0QMWRqA4fvLqHwnJApmdlLZTL2',
                'uuid'=>$uuid,
                'sandbox'=>'1'
            ]
            ]);

        $response = $res->getBody();


        $data = json_decode($response->getContents());

        $status = $data->data->status;
        $montant = $data->data->to_amount;
        $email = $data->data->user_from->email;
        $uuid = $data->data->uuid;

        $internaute = $em->getRepository('NanotechCanhebergementBundle:Internaute')->findOneByEmail($email);
        if($internaute){
            $reservation = $transaction->getReservation();
            if($reservation){
                $reservationconfirmer = new ReservationConfirme();
                $reservationconfirmer->setPrix($montant);
                $reservationconfirmer->setType("AUTOMATIQUE");
                $reservationconfirmer->setTransaction($uuid);
                $reservation->setConfirme(true);
                $reservationconfirmer->setReservation($reservation);
                $reservationconfirmer->setMoyenPaiement($transaction->getMoyenPaiement());
                $transaction->setStatus($status);
                $em->merge($transaction);
                $em->persist($reservationconfirmer);
                $em->flush();

                $message = (new \Swift_Message('Paiement réussi'))
                    ->setFrom('wtakoutsing@gmail.com')
                    ->setTo($internaute->getEmail())
                    ->setBody(
                        $this->renderView(
                            'Emails/confirme.html.twig',
                            array('internaute' => $internaute,'confirmer'=>$reservationconfirmer)
                        ),
                        'text/html'
                    )

                ;

                $this->get('mailer')->send($message);

            }
        }
        return $this->render('@NanotechCanhebergement/Default/paiementterminer.html.twig',['payer' => true ]);
    }
    public function createUser(Internaute $internaute){
        $utilisateur = new Utilisateur();
        $utilisateur->setUsername($internaute->getNom().$internaute->getId());
        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
        $password = substr($tokenGenerator->generateToken(), 0, 8); // 8 chars
        $utilisateur->setPlainPassword($password);
        $utilisateur->setInternaute($internaute);
        $utilisateur->setEnabled(true);
        $utilisateur->setRoles(["ROLE_CLIENT"]);
        $utilisateur->setEmail($internaute->getEmail());
        $em = $this->getDoctrine()->getManager();

        $em->persist($utilisateur);
        $em->flush();
        $message = (new \Swift_Message('Inscription réussi'))
            ->setFrom('wtakoutsing@gmail.com')
            ->setTo($internaute->getEmail())
            ->setBody(
                $this->renderView(
                    'Emails/inscription.html.twig',
                    array('internaute' => $internaute,'username'=>$utilisateur->getUsername(),'password'=>$password)
                ),
                'text/html'
            )    ;

        $this->get('mailer')->send($message);
        //cree le compte puis on envois les informations par mail;

    }

    public function createReservation($internaute,$arrive,$depart,$quantite,$piece,$nbrnuit){
        $date1 = new \DateTime($arrive);
        $date2 = new \DateTime($depart);
        $reservation = new Reservation();
        $reservation->setPrix($nbrnuit * $quantite * $piece->getPrix());
        $reservation->setInternaute($internaute);
        $reservation->setConfirme(false);
        $reservation->setDateArrive($date1);
        $reservation->setDateDepart($date2);
        $reservation->setPiece($piece);
        $reservation->setQuantite($quantite);
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();

        //envoyer le mail
        $message = (new \Swift_Message('Reservation réussi'))
            ->setFrom('wtakoutsing@gmail.com')
            ->setTo($internaute->getEmail())
            ->setBody(
                $this->renderView(
                    'Emails/reservation.html.twig',
                    array('internaute' => $internaute,'reservation'=>$reservation)
                ),
                'text/html'
            )

        ;

        $this->get('mailer')->send($message);

        return $reservation;

    }


    public function paiementSafirmoney(Reservation $reservation){

        $client = new Client();
        $res = $client->request('POST', 'https://api.safimoney.com/v1/extern/send-request',
            ['form_params' => [ 'api_user'=> '5c23b1e291e22',
                                'api_key'=>'dQhVmyLHUfzS8a0QMWRqA4fvLqHwnJApmdlLZTL2',
                                'email'=>$reservation->getInternaute()->getEmail(),
                                'phone'=>$reservation->getInternaute()->getTelephone(),
                                'email_true'=>'1',
                                'phone_true'=>'1',
                                'amount'=>$reservation->getPrix(),
                                'purpose'=>'payement home',
                                'return_url'=>'http%3A%2F%2Flocalhost%2Fcanhebergement%2Fweb%2Fapp_dev.php%2Fsafimoney',
                                'sandbox'=>'1'
                            ]
            ]);

        $response = $res->getBody();


        $data = json_decode($response->getContents());

        $url = $data->data->redirect_url."&return_url=".$data->data->return_url;
        $em = $this->getDoctrine()->getManager();
        $safi = $em->getRepository('NanotechCanhebergementBundle:MoyenPaiement')->findOneByCode("SAFIMONEY");
        $transaction = new Transaction();
        $transaction->setMoyenPaiement($safi);
        $transaction->setReservation($reservation);
        $transaction->setStatus( "prepared");
        $transaction->setUuid( $data->data->uuid);
        $em->persist($transaction);
        $em->flush();
        return $this->redirect($url);
    }

      public function rechercheAction()
    {
          $em = $this->getDoctrine()->getManager();
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));
        $categorie = $em->getRepository('NanotechCanhebergementBundle:Categorie')->findAll();
        return $this->render('NanotechCanhebergementBundle:Default:recherche.html.twig', array(
                             'banieres' => $banieres,
                            'categories'=>$categorie,
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

    public function loginreservationAction(){
        return $this->render('NanotechCanhebergementBundle:Default:loginReservation.html.twig', array());
    }


    public function menuAction($id=0){
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('NanotechCanhebergementBundle:Categorie')->findAll();
        return $this->render('NanotechCanhebergementBundle:Default:menu.html.twig', array('id'=>$id,'categories'=>$categories));
    }

    public function recherchepieceAction(Request $request){
        $arrive = $request->query->get('arriver');
        $depart = $request->query->get('depart');
        if($arrive || !$arrive == ""){
            $date1int = date_parse($arrive);
            $date1 = new \DateTime($date1int["year"]."-".$date1int["month"]."-".$date1int["day"]);
        }
        else{
            $date1 = new \DateTime();
        }

        if($depart || !$depart == ""){
            $date2int = date_parse($depart);
            $date2 = new \DateTime($date2int["year"]."-".$date2int["month"]."-".$date2int["day"]);

        }
        else{
            $date2 = new \DateTime();
        }

        $partenaire = $request->query->get('partenaire');
        if(!$partenaire){
            throw new BadRequestHttpException();
        }
        $em = $this->getDoctrine()->getManager();
        $partenaires = $em->getRepository('NanotechCanhebergementBundle:Partenaire')->findBy(["id"=> $partenaire,"enable"=> true]);
        foreach ($partenaires as $element){
            $pieces = $element->getPiece();
        }
        $tmppiece=[];
        foreach ($pieces as $piece){
           $result= $this->findpiece($piece,$date1->getTimestamp(),$date2->getTimestamp());
           if($result){
               array_push($tmppiece,$result);
           }
        }
        $nbrnuit = $this->date( $date1->format('Y-m-d H:i:s'),$date2->format('Y-m-d H:i:s'));
        if($nbrnuit == 0){
            $nbrnuit = 1;
        }
        return $this->render('NanotechCanhebergementBundle:Default:recherchepiece.html.twig',
            ["pieces" => $tmppiece,
            "nbrnuit" => $nbrnuit,
            "arriver" => $date1,
                "depart" =>$date2,
                ]);
    }

    public function findpiece(Piece $pi,$ar,$de){
        $em = $this->getDoctrine()->getManager();
        $resas = $em->getRepository('NanotechCanhebergementBundle:Reservation')->findByPiece($pi);

        $tmpresas = [];
        //recherche toutes les reservations confirmer avec cette piece //
        if($resas){
            foreach ($resas as $resa){
                $resaconfirme = $em->getRepository('NanotechCanhebergementBundle:ReservationConfirme')->findByReservation($resa);
                if($resaconfirme){
                    array_push($tmpresas,$resa);
                }
            }
        }
        else{
            return $pi;
        }


        $tmpnbr = 0;
        $tmpresas1 = [];

        // je verifie si les dates concorde
        foreach ($tmpresas as $tmpresa){
            $tmpar = $tmpresa->getDateArrive()->getTimestamp();
            $tmpdep = $tmpresa->getDateDepart()->getTimestamp();
            if( (($ar >= $tmpar)&&($ar <= $tmpdep)) || (($de >= $tmpar)&&($de <= $tmpdep)) || (($ar <= $tmpar)&&($de >= $tmpdep)) ){

            }
            else{
                array_push($tmpresas1,$tmpresa);
                $tmpnbr = $tmpnbr + $tmpresa->getQuantite();
            }

        }

        $pi->setQuantite($pi->getQuantite() - $tmpnbr);
        if($pi->getQuantite() <= 0) {
            return null;
        }

        return $pi;

    }
      public function recherchemaisonAction(Request $request)
    {
        $latitude = $request->query->get('latitude');
        $longitude= $request->query->get('longitude');
        $categorie = $request->query->get('categorie');
        $etoile = $request->query->get('etoile');
        $tab_piece = [];
        $nbrenuit = 1;
        $arrive = $request->query->get('arriver');
        $depart = $request->query->get('depart');

        $min = $request->query->get('min');
        $max = $request->query->get('max');

        $em = $this->getDoctrine()->getManager();
        $partenaires = $em->getRepository('NanotechCanhebergementBundle:Partenaire')->findByEnable(true);

        if($categorie || !$categorie==""){
            $partenaires = $this->categorie($partenaires,$categorie);
        }
        if($etoile || !$etoile==""){
            $partenaires = $this->etoile($partenaires,$etoile);
        }

        if($arrive || !$arrive=="" || $depart || !$depart ==""){
            $nbrenuit = $this->date($arrive,$depart);
            if($nbrenuit == 0){
                $nbrenuit = 1;
            }
        }

        if($min || !$min=="" || $max || !$max ==""){
            $partenaires = $this->prix($partenaires,$min,$max);
        }

        $tab_piece = $this->piece_min($partenaires,$min,$max);
        $i = 0;
        foreach ($tab_piece as $piece){

            $piece["prix"] = $piece["prix"] *$nbrenuit;
            $tab_piece[$i]["prix"] = $piece["prix"];
            $i++;
        }
        if($latitude || !$latitude=="" || $longitude || !$longitude ==""){
            $partenaires = $this->destination($partenaires,$latitude,$longitude);
        }

       return $this->render('NanotechCanhebergementBundle:Default:recherchemaison.html.twig', array(
                             'partenaires' => $partenaires,
                            'taille'=>count($partenaires),
                            'nbrnuit'=>$nbrenuit,
                            'tabpiece'=>$tab_piece,
                           'depart' => $depart,
                           'arriver' => $arrive
                ));
    }
    
    public function piece_min($partenaires, $min,$max){

        $tab_piece = [];
        $tmp = [];

        if($min || !$min=="" || $max || !$max ==""){
            foreach ($partenaires as $partenaire){
                $i = 0;
                foreach ($partenaire->getPiece() as $piece){
                    if($piece->getPrix() >= $min && $piece->getPrix() <= $max){

                        if($i == 0){
                            $tmp = ["partenaire"=> $partenaire->getId(),"prix" => $piece->getPrix(),"idpiece" => $piece->getId()];
                        }
                        if( $piece->getPrix() < $tmp["prix"] ){
                            $tmp["prix"] = $piece->getPrix();
                        }
                        $i = $i + 1;
                    }
                }
                array_push($tab_piece,$tmp);
            }
        }
        else{
            foreach ($partenaires as $partenaire){
                $i = 0;
                foreach ($partenaire->getPiece() as $piece){
                        if($i == 0){
                            $tmp = ["partenaire"=> $partenaire->getId(),"prix" => $piece->getPrix(),"idpiece" => $piece->getId()];
                        }
                        if( $piece->getPrix() < $tmp["prix"] ){
                                $tmp["prix"] = $piece->getPrix();
                        }
                        $i = $i + 1;

                }
                array_push($tab_piece,$tmp);
            }
        }
        return $tab_piece;
    }

    public function destination($partenaires,$latitude,$longitude){
        $distance_max = 10;
        $tmp = [];
        foreach ($partenaires as $partenaire){
            $dist = round($this->get_distance_m($latitude,$longitude,$partenaire->getCoordx(),$partenaire->getCoordy())/1000,3);
            if($dist < $distance_max){
                array_push($tmp,$partenaire);
            }
        }
        return $tmp;
    }
    function get_distance_m($lat1, $lng1, $lat2, $lng2) {
        $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
        $rlo1 = deg2rad($lng1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo
                ));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return ($earth_radius * $d);
    }

    public function categorie($partenaires,$categorie){
        $tmp = [];
        foreach ($partenaires as $partenaire){
            if($partenaire->getCategorie()->getId() == $categorie){
                array_push($tmp,$partenaire);
            }
        }
        return $tmp;
    }

    public function etoile($partenaires,$etoile){

        $tmp = [];
        foreach ($partenaires as $partenaire){
            if($partenaire->getNbrEtoile() == $etoile){
                array_push($tmp,$partenaire);
            }
        }
        return $tmp;
    }

    public function date($arrive,$depart){
        $tmp = [];
        $date1int = date_parse($arrive);
        $date2int = date_parse($depart);

        $date1 = new \DateTime($date1int["year"]."-".$date1int["month"]."-".$date1int["day"]);
        $date2 = new \DateTime($date2int["year"]."-".$date2int["month"]."-".$date2int["day"]);

        $diff = $date2->diff($date1)->format("%a");

        return $diff;
    }

    public function prix($partenaires,$min,$max){
        $tmp = [];
        foreach ($partenaires as $partenaire){
            foreach ($partenaire->getPiece() as $piece){
                if($piece->getPrix() >= $min && $piece->getPrix() <= $max){
                    array_push($tmp,$partenaire);
                    break;
                }
            }
        }
        return $tmp;
    }
    public function equipement($partenaires,$tab_equip){
        return $partenaires;
    }
    public function proximite($partenaires,$tab_prox){
        return $partenaires;
    }

    public function service($partenaires,$tab_serv){
        return $partenaires;
    }
}
