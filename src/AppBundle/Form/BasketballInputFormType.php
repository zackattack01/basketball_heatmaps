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
            ->add('makes1', IntegerType::class, [ 'label' => '1' ])
            ->add('attempts1', IntegerType::class, ['label' => false ])
            ->add('makes2', IntegerType::class, [ 'label' => '2' ])
            ->add('attempts2', IntegerType::class, ['label' => false ])
            ->add('makes3', IntegerType::class, [ 'label' => '3' ])
            ->add('attempts3', IntegerType::class, ['label' => false ])
            ->add('makes4', IntegerType::class, [ 'label' => '4' ])
            ->add('attempts4', IntegerType::class, ['label' => false ])
            ->add('makes5', IntegerType::class, [ 'label' => '5' ])
            ->add('attempts5', IntegerType::class, ['label' => false ])
            ->add('makes6', IntegerType::class, [ 'label' => '6' ])
            ->add('attempts6', IntegerType::class, ['label' => false ])
            ->add('makes7', IntegerType::class, [ 'label' => '7' ])
            ->add('attempts7', IntegerType::class, ['label' => false ])
            ->add('makes8', IntegerType::class, [ 'label' => '8' ])
            ->add('attempts8', IntegerType::class, ['label' => false ])
            ->add('makes9', IntegerType::class, [ 'label' => '9' ])
            ->add('attempts9', IntegerType::class, ['label' => false ])
            ->add('makes10', IntegerType::class, [ 'label' => '10' ])
            ->add('attempts10', IntegerType::class, ['label' => false ])
            ->add('makes11', IntegerType::class, [ 'label' => '11' ])
            ->add('attempts11', IntegerType::class, ['label' => false ])
            ->add('makes12', IntegerType::class, [ 'label' => '12' ])
            ->add('attempts12', IntegerType::class, ['label' => false ])
            ->add('makes13', IntegerType::class, [ 'label' => '13' ])
            ->add('attempts13', IntegerType::class, ['label' => false ])
            ->add('makes14', IntegerType::class, [ 'label' => '14' ])
            ->add('attempts14', IntegerType::class, ['label' => false ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }
}