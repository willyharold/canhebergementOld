<?php

namespace Nanotech\CanhebergementBundle\Controller;

use Nanotech\CanhebergementBundle\Entity\Partenaire;
use Nanotech\CanhebergementBundle\Entity\Utilisateur;
use Nanotech\CanhebergementBundle\Form\PartenaireType;
use Nanotech\CanhebergementBundle\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;

class InscriptionController extends Controller
{
    public function inscriptionAction(Request $request)

    {
        $partenaire = new Partenaire();
        $utilisateur = new Utilisateur();
        //$partenaire->addUtilisateur($utilisateur);
        $utilisateur->setPartenaire($partenaire);
        $form = $this->get('form.factory')->create(UtilisateurType::class, $utilisateur);
        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);
            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $utilisateur->setPlainPassword($utilisateur->getPassword());
                $utilisateur->setRoles(["ROLE_PARTENAIRE"]);
                $utilisateur->setConfirmationToken($tokenGenerator->generateToken());
                $em->persist($utilisateur);
                $em->flush();
                $formFactory = $this->get('fos_user.registration.form.factory');
                $form = $formFactory->createForm();
                $form->setData($utilisateur); // created user object
                $event = new FormEvent($form, $request); // request of the Controller
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $request->getSession()->getFlashBag()->add('notice', 'Partenaire bien enregistré.');
                return $this->redirect('login');
            }
            else{
                return $this->render('NanotechCanhebergementBundle:Default:login-inscription.html.twig', array(
                    'form' => $form->createView(),
                ));
            }
        }


        return $this->render('NanotechCanhebergementBundle:Default:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
