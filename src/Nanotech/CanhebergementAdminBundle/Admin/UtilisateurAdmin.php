<?php

namespace Nanotech\CanhebergementAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
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
            ->add('dateNaissance')
            ->add('telephone')
               ->add('roles', 'choice', [
                    'choices' => [
                        'ROLE_INTERNAUTE' => 'Internaute',
                        'ROLE_RECEPTION' => 'Reception',
                        'ROLE_SERVICE' => 'Chef service',
                        'ROLE_PARTENAIRE' => 'Partenaire',
                        'ROLE_ADMIN' => 'Administrateur',
                        'ROLE_SUPER_ADMIN' => 'super administrateur',
                    ],
                   'multiple'=> true,
                   'expanded'=> false,
                ])
                
            
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
            ->add('dateEnreg')
        ;
    }
}
