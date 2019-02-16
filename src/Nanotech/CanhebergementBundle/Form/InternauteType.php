<?php

namespace Nanotech\CanhebergementBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternauteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom',null,["required"=> true])
                ->add('prenom')
                ->add('email',EmailType::class,["required"=> true])
                ->add('pays',CountryType::class,["required"=> true])
                ->add('telephone',null,["required"=> true,"attr"=>["placeholder"=>"Ex :00237XXXXXXXXX"]])
                ->add('typedocument',ChoiceType::class,['choices'=>["carte national"=>"Carte national d'identité","Passeport"=>"Passeport"],"required"=> true ])
                ->add('numdocument',null,["required"=> true])
                ->add('nationalite',null,["required"=> true])
                ->add('adresse',null,["required"=> true]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nanotech\CanhebergementBundle\Entity\Internaute'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nanotech_canhebergementbundle_internaute';
    }


}
