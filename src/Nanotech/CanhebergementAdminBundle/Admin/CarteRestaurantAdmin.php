<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CarteRestaurantAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'carterestaurant';
    protected $baseRouteName = 'canhebergement_carterestaurant';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nomFr')
            ->add('nomEn')
            ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('prix')
            ->add('famille')
            ->add('type')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nomFr')
            ->add('nomEn')
            ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('prix')
            ->add('famille')
            ->add('type')
            ->add('partenaire')
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
            ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('prix')
            ->add('famille')
            ->add('type')
        ;
        if(!$this->getUser()->getPartenaire()) {
            $formMapper->add('partenaire');
        }

        $formMapper->add('image', 'sonata_media_type', array(
            'provider' => 'sonata.media.provider.image',
            'context' => 'image_partenaire',
            'required' => true,
            'label' => "image de la carte",
        ));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nomFr')
            ->add('nomEn')
            ->add('descriptionFr')
            ->add('descriptionEn')
            ->add('prix')
            ->add('famille')
            ->add('type')
            ->add('partenaire')
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
