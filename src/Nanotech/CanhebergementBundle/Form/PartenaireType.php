<?php

namespace Nanotech\CanhebergementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PartenaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbrEtoile',null,array('attr'=>array('placeholder'=>'Choisissez  le nombre d\'étoile')))
            ->add('nom',null,array('attr'=>array('placeholder'=>'Entrez le nom de l\'hébergement')))
            ->add('categorie');


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nanotech\CanhebergementBundle\Entity\Partenaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nanotech_canhebergementbundle_partenaire';
    }


}
