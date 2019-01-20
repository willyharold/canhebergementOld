<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Nanotech\CanhebergementBundle\Entity\Commentaire;
use Nanotech\CanhebergementBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class PartenaireController extends Controller
{
    public function indexAction($slug,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $partenaire = $em->getRepository('NanotechCanhebergementBundle:Partenaire')->findOneBySlug($slug);
        if(!$partenaire){
            throw new NotFoundHttpException("erreur");
        }
        $banieres = $em->getRepository('NanotechCanhebergementBundle:Banniere')->findBy(array(), array('position' => 'DESC'));
        $commentaire_entity = new Commentaire();

        $form = $this->get('form.factory')->create(CommentaireType::class, $commentaire_entity);

        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $commentaire_entity->setPartenaire($partenaire);
                $em->persist($commentaire_entity);
                $em->flush();
                $commentaire_entity = new Commentaire();
                $form = $this->get('form.factory')->create(CommentaireType::class, $commentaire_entity);
            }
        }
        $commentaire = $em->getRepository('NanotechCanhebergementBundle:Commentaire')->findByPartenaire($partenaire, array('dateEnreg' => 'DESC'), 4, 0);

        $carteRestaurant = $partenaire->getCarteRestaurant();
        $carteBar = $partenaire->getCarteBar();

        $tmpcarteRest = [];
        $tmpcarteBar = [];

        $carteRest = [];
        $carteB = [];

        foreach ($carteRestaurant as $carte){
            array_push($carteRest, $carte);
        }
        foreach ($carteRest as $carte){
            $cartmp = [];
            $famille = $carte->getFamille();
            foreach ($carteRest as $item){
                if($item->getFamille() == $famille){
                    array_push($cartmp,$item);
                    $carteRest = $this->compare_func_rest($carteRest,$item);
                }
            }
            array_push($tmpcarteRest,$cartmp);
        }

        foreach ($carteBar as $carte){
            array_push($carteB, $carte);
        }
        foreach ($carteB as $carte){
            $cartmp = [];
            $famille = $carte->getFamille();
            foreach ($carteB as $item){
                if($item->getFamille() == $famille){
                    array_push($cartmp,$item);
                    $carteB = $this->compare_func_rest($carteB,$item);
                }
            }
            array_push($tmpcarteBar,$cartmp);
        }

        return $this->render('NanotechCanhebergementBundle:Default:hotel.html.twig', array(
            'banieres' => $banieres,
            'partenaire' => $partenaire,
            'commentaire' => $commentaire,
            'cartes' => $tmpcarteRest,
            'cartesB' =>$tmpcarteBar,
            'form'=> $form->createView()
        ));
    }
    public function compare_func_rest($tab, $item)
    {
        $tmp = [];
        foreach ($tab as $element){
            if($element->getId() != $item->getId()){
                array_push($tmp,$element);
            }
        }
         return $tmp;
    }

    public function commmentaireAction($slug,$nombre){
        $em = $this->getDoctrine()->getManager();
        $partenaire = $em->getRepository('NanotechCanhebergementBundle:Partenaire')->findOneBySlug($slug);
        if(!$partenaire){
            throw new NotFoundHttpException("erreur");
        }
        $commentaire = $em->getRepository('NanotechCanhebergementBundle:Commentaire')->findByPartenaire($partenaire, array('dateEnreg' => 'DESC'), $nombre, 0);

        return  $this->render('NanotechCanhebergementBundle:Default:commentaire.html.twig', array(
            'commentaire' => $commentaire,
        ));
    }
    public function commentairecreateAction(request $request)
    {
        $commentaire = new Commentaire();
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);
    }
}
