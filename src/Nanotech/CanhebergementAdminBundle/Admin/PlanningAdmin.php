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
            ->add('partenaire')
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
            ->add('dateDebut')
            ->add('dateFin')
            ->add('fichier', 'sonata_media_type', array(
                   'provider' => 'sonata.media.provider.file',
                   'context' => 'pdf_planning',
                   'required' => true,
                   'label' => "pdf du planning",
               ))
                
                ->add('service', 'choice', [
                    'choices' => [
                        1 => 'Bar',
                        2 => 'Restaurant',
                        3 => 'Ressource Humaine',  ] ])

        ;
        if(!$this->getUser()->getPartenaire()) {
            $formMapper->add('partenaire');
        }
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

    public function getUser()
    {
        // get container
        $container = $this->getConfigurationPool()
            ->getContainer();

        // get current user
        $user = $container->get('security.token_storage')
            ->getToken()
            ->getUser();

        return $user;
    }
    public function createQuery($context = 'list')
    {
        $user = $this->getUser();
        $query = parent::createQuery($context);
        if($user->getPartenaire()) {
            $query->andWhere(
                $query->expr()->eq($query->getRootAliases()[0] . '.partenaire', ':id')
            );
            $query->setParameter('id', $user->getPartenaire());
        }
        return $query;
    }

    public function prePersist($object) {
        parent::prePersist($object);
        if($this->getUser()->getPartenaire()) {
            $object->setPartenaire($this->getUser()->getPartenaire());
        }
    }

    public function preUpdate($object) {
        parent::preUpdate($object);
        if($this->getUser()->getPartenaire()) {
            $object->setPartenaire($this->getUser()->getPartenaire());
        }
    }


}
