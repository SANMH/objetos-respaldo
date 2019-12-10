<?php

namespace App\Controller;

use App\Entity\Objetos;
use App\Form\ObjetosType;
use App\Repository\ObjetosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objetos")
 */
class ObjetosController extends AbstractController
{
    /**
     * @Route("/", name="objetos_index", methods={"GET"})
     */
    public function index(ObjetosRepository $objetosRepository): Response
    {
        return $this->render('objetos/index.html.twig', [
            'objetos' => $objetosRepository->findAll(),
        ]);
    }




    /**
     * @Route("/new", name="objetos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objeto = new Objetos();
        $form = $this->createForm(ObjetosType::class, $objeto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fecha = new \DateTime('@'.strtotime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $objeto->setUser($this->getUser());
            $objeto->setFecha($fecha);
            $entityManager->persist($objeto);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'se creo correctamente'
            );

            return $this->redirectToRoute('objetos_index');
        }

        return $this->render('objetos/new.html.twig', [
            'objeto' => $objeto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objetos_show", methods={"GET"})
     */
    public function show(Objetos $objeto): Response
    {
        return $this->render('objetos/show.html.twig', [
            'objeto' => $objeto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objetos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objetos $objeto): Response
    {
        $form = $this->createForm(ObjetosType::class, $objeto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Tus cambios se han guardado!'
            );

            return $this->redirectToRoute('objetos_index');
        }

        return $this->render('objetos/edit.html.twig', [
            'objeto' => $objeto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objetos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objetos $objeto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objeto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objeto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objetos_index');
    }
}
