<?php

namespace App\Form\EventListener;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
class AddTipoFieldListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }
    private function addTipoForm($form, $tipo = null)
    {
        $formOptions = array(
            'class' => Tipo::class,
            'placeholder' => 'Selecciona...',
            'mapped' => false,
            'choice_label' => 'name'
        );
        if ($tipo) {
            $formOptions['data'] = $tipo;
        }
        $form->add('tipo', EntityType::class, $formOptions);
    }
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        if (null === $data) {
            return;
        }
        $accessor = PropertyAccess::createPropertyAccessor();
        $facultad = $accessor->getValue($data, 'facultad');
        $tipo = ($facultad) ? $facultad->getTipo() : null;
        $this->addTipoForm($form, $tipo);
    }
    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $this->addTipoForm($form);
    }
}
