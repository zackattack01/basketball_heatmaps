<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BasketballInputFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position1', IntegerType::class)
            ->add('position2', IntegerType::class)
            ->add('position3', IntegerType::class)
            ->add('position4', IntegerType::class)
            ->add('position5', IntegerType::class)
            ->add('position6', IntegerType::class)
            ->add('position7', IntegerType::class)
            ->add('position8', IntegerType::class)
            ->add('position9', IntegerType::class)
            ->add('position10', IntegerType::class)
            ->add('position11', IntegerType::class)
            ->add('position12', IntegerType::class)
            ->add('position13', IntegerType::class)
            ->add('position14', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }
}