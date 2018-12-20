<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReservationConfirmeAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'reservationconfirme';
    protected $baseRouteName = 'canhebergement_reservationconfirme';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('prix')
            ->add('type')
            ->add('reservation')
            ->add('moyenPaiement')    
            ->add('dateEnreg')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Client')
                ->with('Client')
                ->end()
            ->end()    
            ->tab('Réservation')
                ->with('Réservation')
                ->add('reservation', \Nanotech\CanhebergementBundle\Form\ReservationType::class)
                ->end()
            ->end()
            
            ->tab('Confirmation')
                ->with('Confirmation')
                ->add('moyenPaiement')    
            ->add('prix')
            ->add('type')
                ->end()
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('prix')
            ->add('type')
            ->add('reservation')
            ->add('moyenPaiement')
            ->add('dateEnreg')
        ;
    }
}
