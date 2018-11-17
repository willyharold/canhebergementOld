<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PieceAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'piece';
    protected $baseRouteName = 'canhebergement_piece';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nomFr')
            ->add('nomEn')
            ->add('type')
            ->add('prix')
            ->add('quantite')
            ->add('nbrPersonne')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nomFr')
            ->add('nomEn')
            ->add('type')
            ->add('prix')
            ->add('quantite')
            ->add('nbrPersonne')
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
            ->add('nomFr')
            ->add('nomEn')
            ->add('type')
            ->add('prix')
            ->add('quantite')
            ->add('nbrPersonne')
            ->add('partenaire')
            ->add('image', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.image',
                   'context' => 'image_partenaire',
                   'required' => false,
                   'label' => "image",
               ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nomFr')
            ->add('nomEn')
            ->add('type')
            ->add('prix')
            ->add('quantite')
            ->add('nbrPersonne')
            ->add('dateEnreg')
        ;
    }
}
