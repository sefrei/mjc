<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, [
            'label' => 'Nom'
        ])
        // ->add('date')
        ->add('date', null, [
          'label' => 'Date',
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
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}
