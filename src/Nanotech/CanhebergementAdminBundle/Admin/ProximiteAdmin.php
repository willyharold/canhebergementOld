<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProximiteAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'proximite';
    protected $baseRouteName = 'canhebergement_proximite';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
           ->add('nomFr')
            ->add('nomEn')
            ->add('code')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
          ->add('nomFr')
            ->add('nomEn')
            ->add('code')
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
            ->add('nomFr',null,  ['label' => 'Nom Français'])
            ->add('nomEn',null,  ['label' => 'Nom Anglais'])
            ->add('code')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
          ->add('nomFr')
            ->add('nomEn')
            ->add('code')
            ->add('dateEnreg')
        ;
    }
}
