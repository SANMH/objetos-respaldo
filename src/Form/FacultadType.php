<?php

namespace App\Form;

use App\Entity\Facultad;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FacultadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('tipo', EntityType::class,[
                'class' => Tipo::class,
                'choice_label' => 'name',
                'placeholder' => 'Seleccione uno......'

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facultad::class,
        ]);
    }
}
