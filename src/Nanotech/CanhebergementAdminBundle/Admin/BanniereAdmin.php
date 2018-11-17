<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BanniereAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'banniere';
    protected $baseRouteName = 'canhebergement_banniere';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('position')
            ->add('dateEnreg')

        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('position')
            ->add('image')
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
            ->add('position')
            ->add('image', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.image',
                   'context' => 'image_banniere',
                   'required' => true,
                   'label' => "logo de la bannière",
               ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('position')
            ->add('dateEnreg')
            ->add('image')
         
        ;
    }
}
