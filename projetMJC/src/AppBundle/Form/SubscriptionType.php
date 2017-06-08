<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use AppBundle\Entity\User;

class SubscriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('startAt', null, [
          'label' => 'début du premier cours',
          'format' => 'dd-MM-yyyy HH:mm',
          'years' => range(date('Y'), date('Y') + 2),
        //   'months' => range(date('m'), date('m') + 12),
        //   'days' => range(1,31),
        //   'hours' => range(1, 24),
          'placeholder' => [
              'day'=> 'Jour', 'month'=>'Mois', 'year'=>'Année', 'hour'=>'heure', 'minute'=>'Minute'
          ],
          // 'html5' => true,
        ])

        ->add('duration',  ChoiceType::class, [
          'label' => 'durée',
          'choices'  => array(
          '30 min' => 1800,
          '45 min' => 2700,
          '1h' => 3600,
          '1h30' => 6400,
          '2h' => 7200,
        )
        ])
        // ->add('finishAt', null, [
        //   'label' => 'fin du premier cours',
        //   'format' => 'dd-MM-yyyy HH:mm',
        //   'years' => range(date('Y'), date('Y') + 2),
        //   'placeholder' => [
        //       'day'=> 'Jour', 'month'=>'Mois', 'year'=>'Année', 'hour'=>'heure', 'minute'=>'Minute'
        //   ],
        //
        // ])
        ->add('teacher', null, [
          'label' => 'Professeur',
        ])
        ->add('student', null, [
          'label' => 'élève',
        ])
        ->add('specialties', null, [
          'label' => 'spécialité',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Subscription',
            'attr' => ['novalidate' => 'novalidate'],

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_subscription';
    }


}
