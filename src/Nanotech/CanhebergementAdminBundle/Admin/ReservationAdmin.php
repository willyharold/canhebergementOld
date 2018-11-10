<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReservationAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'reservation';
    protected $baseRouteName = 'canhebergement_reservation';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
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
          
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('internaute')
                  ->add('Piece')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('dateEnreg')
        ;
    }
}
