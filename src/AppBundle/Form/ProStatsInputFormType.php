<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProStatsInputFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('gender', ChoiceType::class, array(
                'choices'  => array(
                    'n/a' => 'o',
                    'male'   => 'm', 
                    'female' => 'f'
                ),
            ))
            ->add('team', ChoiceType::class, array(
                'choices'  => array(
                    "Atlanta Hawks" => 0,
                    "Boston Celtics" => 2, 
                    "Brooklyn Nets" => 3,
                    "Charlotte Bobcats" => 4, 
                    "Chicago Bulls" => 5, 
                    "Cleveland Cavaliers" => 6, 
                    "Dallas Mavericks" => 7, 
                    "Denver Nuggets" => 8, 
                    "Detroit Pistons" => 9, 
                    "Golden State Warriors" => 10, 
                    "Houston Rockets" => 11, 
                    "Indiana Pacers" => 12, 
                    "LA Clippers" => 13, 
                    "LA Lakers" => 14, 
                    "Memphis Grizzlies" => 15, 
                    "Miami Heat" => 16, 
                    "Milwaukee Bucks" => 17, 
                    "Minnesota Timberwolves" => 18, 
                    "New Orleans Hornets" => 19, 
                    "New York Knicks" => 20, 
                    "Oklahoma City Thunder" => 21, 
                    "Orlando Magic" => 22, 
                    "Philadelphia Sixers" => 23, 
                    "Phoenix Suns" => 24, 
                    "Portland Trail Blazers" => 25, 
                    "Sacramento Kings" => 26, 
                    "San Antonio Spurs" => 27, 
                    "Toronto Raptors" => 28, 
                    "Utah Jazz" => 29, 
                    "Washington Wizards" => 30
                )
            ))
            ->add('player_type', ChoiceType::class, array(
                'choices'  => array(
                    'other' => 0,
                    'college' => 3,
                    'pro' => 4,
                ),
                'label' => 'level of play'
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
            ->add('csv_stats_upload', FileType::class, array(
                'label' => 'Stats (CSV file with all lowercase headers as follows: position,makes,attempts)'
            ))
            ->add('date', DateType::class, array(
                'data' => date_create(),
                'label' => 'stats were gathered: ',
                'widget' => 'single_text'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}