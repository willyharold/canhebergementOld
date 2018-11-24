<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GalleryAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'gallery';
    protected $baseRouteName = 'canhebergement_gallery';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('context')
            ->add('defaultFormat')
            ->add('enabled')
            ->add('updatedAt')
            ->add('createdAt')
            ->add('id')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('context')
            ->add('defaultFormat')
            ->add('enabled')
            ->add('updatedAt')
            ->add('createdAt')
            ->add('id')
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
            ->add('name')
            ->add('context')
            ->add('defaultFormat')
            ->add('enabled')
            ->add('updatedAt')
            ->add('createdAt')
            ->add('id')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('context')
            ->add('defaultFormat')
            ->add('enabled')
            ->add('updatedAt')
            ->add('createdAt')
            ->add('id')
        ;
    }
}
