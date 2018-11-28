<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class InternauteAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'internaute';
    protected $baseRouteName = 'canhebergement_internaute';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('cni')
            ->add('passeport')
            ->add('dateNai')
            ->add('lieuNai')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('cni')
            ->add('passeport')
            ->add('dateNai')
            ->add('lieuNai')
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
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('cni')
            ->add('passeport')
            ->add('dateNai',null,  ['label' => 'Date de Naissance'])
            ->add('lieuNai',null,  ['label' => 'Lieu de Naissance'])
        
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('cni')
            ->add('passeport')
            ->add('dateNai')
            ->add('lieuNai')
            ->add('dateEnreg')
        ;
    }
}
