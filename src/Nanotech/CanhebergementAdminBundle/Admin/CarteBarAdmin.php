<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CarteBarAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'cartebar';
    protected $baseRouteName = 'canhebergement_cartebar';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('prix')
            ->add('famille')
            ->add('dateEnreg')
            ->add('nomEn')
            ->add('descriptionEn')
            ->add('nomFr')
            ->add('descriptionFr')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('prix')
            ->add('famille')
            ->add('dateEnreg')
            ->add('nomEn')
            ->add('descriptionEn')
            ->add('nomFr')
            ->add('descriptionFr')
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
            ->add('nomFr')
            ->add('nomEn')   
            ->add('descriptionEn')
            ->add('descriptionFr')
            ->add('prix')
            ->add('famille')
            ->add('partenaire')
            ->add('image', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.image',
                   'context' => 'logo_moyen_paiement',
                   'required' => false,
                   'label' => "logo de la bannière",
               ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('prix')
            ->add('famille')
            ->add('dateEnreg')
            ->add('nomEn')
            ->add('descriptionEn')
            ->add('nomFr')
            ->add('descriptionFr')
        ;
    }
}
