<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ParametreAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'parametre';
    protected $baseRouteName = 'canhebergement_parametre';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('devise')
           ->add('titre_fr')
                 ->add('titre_en')
            ->add('dateEnreg')

        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('devise')
              ->add('titre_fr')
                 ->add('titre_en')
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
            ->add('devise')          
             ->add('titre_fr')
                 ->add('titre_en')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('devise')
             ->add('titre_fr')
                 ->add('titre_en')
            ->add('dateEnreg')
         
        ;
    }
}
