<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ServiceAdmin extends AbstractAdmin
{
    
    protected $baseRoutePattern = 'service';
    protected $baseRouteName = 'canhebergement_service';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('dateEnreg')
            ->add('nomFr')
             ->add('nomEn')
            ->add('code')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('dateEnreg')
             ->add('nomFr')
             ->add('nomEn')
            ->add('code')
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
            ->add('dateEnreg')
            ->add('nomFr')
             ->add('nomEn')
            ->add('code')
        ;
    }
}
