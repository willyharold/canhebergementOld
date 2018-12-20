<?php

namespace Nanotech\CanhebergementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username',TextType::class,array('attr'=>array('placeholder'=>'Entrez le nom d\'utilisateur')))
            ->add('password',PasswordType::class,array('attr'=>array('placeholder'=>'Entrez le mot de passe')))
            ->add('email',EmailType::class,array('attr'=>array('placeholder'=>'Entrez l\'adresse email')));

        $builder->add('partenaire', PartenaireType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nanotech\CanhebergementBundle\Entity\Utilisateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nanotech_canhebergementbundle_utilisateur';
    }


}
