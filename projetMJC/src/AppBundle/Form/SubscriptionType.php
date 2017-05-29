<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
          'format' => 'HH:mm',
          'years' => range(date('Y'), date('Y') + 2),
          'months' => range(date('m'), date('m') + 12),
          'days' => range(date('d'), date('d') + 31),
          'hours' => range(date('H'), date('H') + 24),
        //->add('startAt', DateTimeType::class, [
        //  'widget' => 'choice',
        //  'label' => '1er cours, date et heure',
        //  'format' => 'dd-MM-yyyy HH:mm',
        //  'years' => range(date('Y'), date('Y') - 0),
        //  'placeholder' => [
            //  'day'=> 'Jour', 'month'=>'Mois', 'year'=>'Année', 'hour'=>'heure', 'minute'=>'Minute'
        //  ]
        ])
        ->add('finishAt', null, [
          'label' => 'fin du premier cours',
          'format' => 'HH:mm',
          'years' => range(date('Y'), date('Y') + 2),
          'months' => range(date('m'), date('m') + 12),
          'days' => range(date('d'), date('d') + 31),
          'hours' => range(date('H'), date('H') + 24),
          // 'placeholder' => [
          //     'day'=> 'Jour', 'month'=>'Mois', 'year'=>'Année', 'hour'=>'heure', 'minute'=>'Minute'
          // ],
          // 'html5' => true,
        ])
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
