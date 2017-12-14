<?php

namespace AppBundle\Form;

use AppBundle\Entity\MoveOut;
use AppBundle\Entity\Object;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')->add('moveOut', EntityType::class, [
        'class' => MoveOut::class,
        'expanded' => false,
        'multiple' => false,
        'choice_label' => 'email',
        'required' => 'false',
    ])->add('objects', EntityType::class, [
            'class' => Object::class,
            'expanded' => true,
            'multiple' => true,
            'choice_label' => 'name',
            'required' => 'false',
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Room'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_room';
    }


}
