<?php
// src/AppBundle/Form/RegistrationType.php

namespace App\Form;
use App\Entity\Facultad;
use App\Entity\Tipo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\EventListener\AddFacultadFieldListener;
use App\Form\EventListener\AddTipoFieldListener;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->addEventSubscriber(new AddTipoFieldListener())
            ->addEventSubscriber(new AddFacultadFieldListener());
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
