<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Nanotech\CanhebergementBundle\Repository\PieceRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Route\RouteCollection;

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
            ->add('confirme')    
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
            ->add('prix')
            ->add('dateEnreg')
            ->add('confirme')

            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                    
                ],
            ])
            ->addIdentifier('', 'actions', [
                'actions' => [
                    'confirmer' => ['template' => 'NanotechCanhebergementBundle:CRUD:list__action_confirmer.html.twig']
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
            ->add('prix')
            ->add('internaute');

        if($this->getUser()->getPartenaire()){
            $partenaire = $this->getUser()->getPartenaire();
            $formMapper->add('piece',EntityType::class,[
                'query_builder'=> function(PieceRepository $repository) use($partenaire){
                    return $repository->getLikeQueryBuilder($partenaire);
                },
                'class'=>'NanotechCanhebergementBundle:Piece',
            ])

            ;
        }
        else{
            $formMapper->add('piece');
        }

    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('quantite')
            ->add('piece')
            ->add('prix')
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
            $query->join('NanotechCanhebergementBundle:Piece', 'pi', 'WITH', 'pi.id ='.$query->getRootAliases()[0].'.piece');
            $query->andWhere('pi.partenaire = :id');
            $query->setParameter('id', $user->getPartenaire());
        }
        return $query;
    }

    public function prePersist($object) {
        parent::prePersist($object);

    }

    public function preUpdate($object) {
        parent::preUpdate($object);

    }
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('confirmer', $this->getRouterIdParameter().'/confirmer');
    }
}
