<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Nanotech\CanhebergementBundle\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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
                            'tabpiece'=>$tab_piece
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
                            $tmp = ["partenaire"=> $partenaire->getId(),"prix" => $piece->getPrix()];
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
                            $tmp = ["partenaire"=> $partenaire->getId(),"prix" => $piece->getPrix()];
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
