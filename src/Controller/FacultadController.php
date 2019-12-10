<?php

namespace App\Controller;

use App\Entity\Facultad;
use App\Entity\Tipo;
use App\Form\FacultadType;
use App\Form\TipoType;
use App\Repository\FacultadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/facultad")
 */
class FacultadController extends AbstractController
{
    /**
     * @Route("/", name="facultad_index", methods={"GET"})
     */
    public function index(FacultadRepository $facultadRepository): Response
    {
        return $this->render('facultad/index.html.twig', [
            'facultads' => $facultadRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nuevo", name="facultad_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $facultad = new Facultad();
        $form = $this->createForm(FacultadType::class, $facultad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facultad);
            $entityManager->flush();

            return $this->redirectToRoute('facultad_index');
        }

        return $this->render('facultad/new.html.twig', [
            'facultad' => $facultad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="facultad_show", methods={"GET"})
     */
    public function show(Facultad $facultad): Response
    {
        return $this->render('facultad/show.html.twig', [
            'facultad' => $facultad,
        ]);
    }

    /**
     * @Route("/{id}/editar", name="facultad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Facultad $facultad): Response
    {
        $form = $this->createForm(FacultadType::class, $facultad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('facultad_index');
        }

        return $this->render('facultad/edit.html.twig', [
            'facultad' => $facultad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="facultad_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Facultad $facultad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facultad->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($facultad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('facultad_index');
    }
}
