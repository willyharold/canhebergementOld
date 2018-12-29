<?php

namespace Nanotech\CanhebergementAdminBundle\Controller;

use Nanotech\CanhebergementBundle\Entity\Reservation;
use Nanotech\CanhebergementBundle\Entity\ReservationConfirme;
use Nanotech\CanhebergementBundle\Form\ReservationConfirmeType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


class ReservationAdminController extends CRUDController
{
    public function confirmerAction(Request $request)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $object->id));
        }

        //$this->addFlash('sonata_flash_success', 'Confirmation reussi');
        $reservationconfirme = new ReservationConfirme();
        $reservation = new Reservation();
        $reservationconfirme->setReservation($object);
        $form = $this->get('form.factory')->create(ReservationConfirmeType::class, $reservationconfirme);

        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);
            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();

                $reservationconfirme->setType("MANUEL");
                $reservationconfirme->getReservation()->setConfirme(true);
                $em->persist($reservationconfirme);
                $em->flush();

                $this->addFlash('sonata_flash_success', 'Confirmation reussi');
                return new RedirectResponse($this->admin->generateUrl('list'));
            }

        }

        return $this->render('NanotechCanhebergementBundle:CRUD:confirmer.html.twig', array('form' => $form->createView()));
    }
}
