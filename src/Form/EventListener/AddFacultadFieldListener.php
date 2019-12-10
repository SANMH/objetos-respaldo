<?php

namespace App\Form\EventListener;
use App\Entity\Facultad;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
class AddFacultadFieldListener implements EventSubscriberInterface {
    public static function getSubscribedEvents(){
        return array(
            FormEvents::PRE_SET_DATA  => 'preSetData',
            FormEvents::PRE_SUBMIT    => 'preSubmit'
        );
    }
    private function addFacultadForm($form, $tipo_id){
        $formOptions = array(
            'class'         => Facultad::class,
            'query_builder' => function (EntityRepository $repository) use ($tipo_id) {
                return $repository->createQueryBuilder('facultad')
                    ->innerJoin('facultad.tipo', 'tipo')
                    ->where('tipo.id = :tipo')
                    ->setParameter('tipo', $tipo_id)
                    ;
            },
            'placeholder' => 'Debe seleccionar un tipo primero',
            'choice_label' => 'name'
        );
        $form->add('facultad', EntityType::class, $formOptions);
    }
    public function preSetData(FormEvent $event){
        $data = $event->getData();
        $form = $event->getForm();
        if (null === $data) {
            return;
        }
        $accessor    = PropertyAccess::createPropertyAccessor();
        $facultad        = $accessor->getValue($data, 'facultad');
        $tipo_id = ($facultad) ? $facultad->getTipo()->getId() : null;
        $this->addFacultadForm($form, $tipo_id);
    }
    public function preSubmit(FormEvent $event){
        $data = $event->getData();
        $form = $event->getForm();
        $tipo_id = array_key_exists('tipo', $data) ? $data['tipo'] : null;
        $this->addFacultadForm($form, $tipo_id);
    }
}