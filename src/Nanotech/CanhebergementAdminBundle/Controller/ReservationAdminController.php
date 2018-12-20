<?php

namespace Nanotech\CanhebergementAdminBundle\Controller;

use Nanotech\CanhebergementBundle\Entity\Reservation;
use Nanotech\CanhebergementBundle\Entity\ReservationConfirme;
use Nanotech\CanhebergementBundle\Form\ReservationConfirmeType;
use Sonata\AdminBundle\Controller\CRUDController;


class ReservationAdminController extends CRUDController
{
    public function confirmerAction()
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


        return $this->render('NanotechCanhebergementBundle:CRUD:confirmer.html.twig', array('form' => $form->createView()));
    }
}
