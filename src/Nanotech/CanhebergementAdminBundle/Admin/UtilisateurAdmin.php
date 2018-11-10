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
                        'ROLE_ABONE' => 'Abonne',
                        'ROLE_PRESSE' => 'presse', 
                         'ROLE_ADMIN' => 'administrateur', 
                         'ROLE_SUPER_ADMIN' => 'super administrateur', 
                    ],
                   'multiple'=> true,
                   'expanded'=> true,
                ])
                
            
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('avatar')
            ->add('nom')
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
