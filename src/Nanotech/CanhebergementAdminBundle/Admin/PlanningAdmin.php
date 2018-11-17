<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class PlanningAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'planning';
    protected $baseRouteName = 'canhebergement_planning';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('dateEnreg')
            ->add('fichier') 
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
         ->add('partenaire')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('fichier', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.file',
                   'context' => 'pdf_planning',
                   'required' => true,
                   'label' => "pdf du planning",
               ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('fichier')
            ->add('dateEnreg')
        ;
    }
}
