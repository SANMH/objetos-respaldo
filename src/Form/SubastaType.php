<?php

namespace App\Form;
use App\Entity\Objetos;
use App\Entity\Subasta;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SubastaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('valor')
            ->add('oferta')
            ->add('objetos', EntityType::class,[
                'class'=> Objetos::class,
                'choice_label'=>'name'])
            ->add('estado')
                ;        
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subasta::class,
        ]);
    }
}
