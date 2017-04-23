<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserSignUpFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('username', TextType::class, array(
                'label' => 'email or username'
            ))
            ->add('gender', ChoiceType::class, array(
                'choices'  => array(
                    'n/a' => 'o',
                    'male'   => 'm', 
                    'female' => 'f'
                ),
            ))
            ->add('player_type', ChoiceType::class, array(
                'choices'  => array(
                    'other' => 0,
                    'recreational'   => 1, 
                    'high school' => 2,
                    'college' => 3,
                    'pro' => 4,
                ),
                'label' => 'current level of play'
            ))
            ->add('position', ChoiceType::class, array(
                'choices'  => array(
                    'other' => 0,
                    'point guard'   => 1, 
                    'shooting guard' => 2,
                    'small forward' => 3,
                    'power forward' => 4,
                    'center' => 5,
                ),
                'label' => 'preferred position'
            ))
            ->add('age', IntegerType::class)
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
              'data_class' => 'AppBundle\Entity\User',
        ]);
    }
}