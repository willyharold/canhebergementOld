<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReservationAdmin extends AbstractAdmin
{
     protected $baseRoutePattern = 'reservation';
    protected $baseRouteName = 'canhebergement_reservation';
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('piece')
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
          
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('internaute')
            ->add('Piece')

        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('piece')
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
                $query->expr()->eq($query->getRootAliases()[0] . '.piece.partenaire', ':id')
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
            $object->setPiece()->setPartenaire($this->getUser()->getPartenaire());
        }
    }
}
