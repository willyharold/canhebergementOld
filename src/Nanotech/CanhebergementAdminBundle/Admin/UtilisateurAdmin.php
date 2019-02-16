<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateurAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'utilisateur';
    protected $baseRouteName = 'canhebergement_utilisateur';
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper 
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('email')
            ->add('sexe')
            ->add('dateNaissance')
            ->add('telephone')
            ->add('roles')
            ->add('partenaire')
            ->add('dateEnreg')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('email')
            ->add('sexe')
            ->add('dateNaissance')
            ->add('telephone')
            ->add('roles')
            ->add('partenaire')
            ->add('enabled')
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
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('sexe', 'choice', [
                    'choices' => [
                        'masculin' => 'MASCULIN',
                        'feminin' => 'FEMININ',  
                    ],
                ])
            ->add('dateNaissance',DatePickerType::class,  ['label' => 'Date de Naissance'])
            ->add('telephone');
        if(!$this->getUser()->getPartenaire()) {
            $formMapper->add('partenaire');
        }

        if($this->getUser()->getPartenaire()) {
            $formMapper->add('roles', 'choice', [
                'choices' => [
                    'ROLE_RECEPTION' => 'Reception',
                    'ROLE_SERVICE' => 'Chef service',
                ],
                'multiple'=> true,
                'expanded'=> false,
            ]);
        }
        else{
            $formMapper->add('roles', 'choice', [
                'choices' => [
                    'ROLE_RECEPTION' => 'Reception',
                    'ROLE_SERVICE' => 'Chef service',
                    'ROLE_PARTENAIRE' => 'Partenaire',
                    'ROLE_SUPER_ADMIN' => 'Administrateur',
                ],
                'multiple'=> true,
                'expanded'=> false,
            ]);
        }
        $formMapper->add('enabled')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('email')
            ->add('password')
            ->add('sexe')
            ->add('dateNaissance')
            ->add('telephone')
            ->add('roles')
            ->add('partenaire')
            ->add('enabled')
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
        if($user->getPartenaire()){
            $query->andWhere(
                $query->expr()->eq($query->getRootAliases()[0] . '.partenaire', ':id')
            );
            $query->setParameter('id', $user->getPartenaire());
        }
        return $query;
    }

    public function updateUser(\Nanotech\CanhebergementBundle\Entity\Utilisateur $u) {
        if ($u->getPassword()) {
            $u->setPlainPassword($u->getPassword());
        }

        $um = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
        $um->updateUser($u, false);
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
