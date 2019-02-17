<?php

namespace Nanotech\CanhebergementBundle\Form;

use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Reservation2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDepart',DatePickerType::class)
                ->add('dateArrive',DatePickerType::class)
                ->add('quantite')
                ->add('internaute', Internaute2Type::class)
                ->add('piece')
                ->add('prix',null,['label' => 'Prix de la reservation']);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nanotech\CanhebergementBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nanotech_canhebergementbundle_reservation';
    }


}
