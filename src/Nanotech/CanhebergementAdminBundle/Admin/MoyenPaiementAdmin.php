<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MoyenPaiementAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'MoyenPaiement';
    protected $baseRouteName = 'canhebergement_MoyenPaiement';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nom')               
            ->add('lien')
            ->add('secretid')  
            ->add('clientid')
            ->add('national')
            ->add('dateEnreg')

                
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nom')               
            ->add('lien')
            ->add('secretid')  
            ->add('clientid')
            ->add('national')
            ->add('dateEnreg')
            ->add('logo')
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
            ->add('lien')
            ->add('secretid')  
            ->add('clientid')
            ->add('national')
            ->add('logo', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.image',
                   'context' => 'image_logo',
                   'required' => true,
                   'label' => "logo du moyen de paiement",
               ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nom')               
            ->add('lien')
            ->add('secretid')  
            ->add('clientid')
            ->add('national')
            ->add('logo')

            ->add('dateEnreg')
                
        ;
    }
}
