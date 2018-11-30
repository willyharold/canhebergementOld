<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CommentaireClientAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'commentaireclient';
    protected $baseRouteName = 'canhebergement_commentaireclient';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')          
            ->add('nom')
            ->add('fonction')
          ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nom')
            ->add('fonction')
        ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('dateEnreg')
            ->add('image')
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
            ->add('fonction')
            ->add('descriptionFr',null,  ['label' => 'Description Française'])
            ->add('descriptionEn',null,  ['label' => 'Description Anglaise'])
            ->add('image', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.image',
                   'context' => 'image_partenaire',
                   'required' => false,
                   'label' => "logo de la bannière",
               ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nom')
            ->add('fonction')
        ->add('descriptionFr')
            ->add('descriptionEn')         
            ->add('dateEnreg')
            ->add('image')
        ;
    }
}
