<?php

namespace App\Controller;

use App\Entity\Subasta;
use App\Form\SubastaType;
use App\Repository\SubastaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



/**
 * @Route("/subasta")
 */
class SubastaController extends AbstractController
{
    /**
     * @Route("/", name="subasta_index", methods={"GET"})

     */
    public function index(SubastaRepository $subastaRepository): Response
    {
        return $this->render('subasta/index.html.twig', [
            'subastas' => $subastaRepository->findAll(),
        ]);
    }

  


    /**
     * @Route("/nuevo", name="subasta_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $subastum = new Subasta();
        $form = $this->createForm(SubastaType::class, $subastum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fechaIngreso = new \DateTime('@'.strtotime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $subastum->setFechaIngreso($fechaIngreso);
            $entityManager->persist($subastum);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'se creo correctamente'
            );

            return $this->redirectToRoute('subasta_index');
        }

        return $this->render('subasta/new.html.twig', [
            'subastum' => $subastum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/", name="subasta_show", methods={"GET"})
     */
    public function show(Subasta $subastum): Response
    {
        return $this->render('subasta/show.html.twig', [
            'subastum' => $subastum,
        ]);
    }

    /**
     * @Route("/{id}/editar", name="subasta_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Subasta $subastum): Response
    {
        $form = $this->createForm(SubastaType::class, $subastum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            // hacer algún tipo de procesamiento
    
            $this->addFlash(
                'notice',
                'Tus cambios se han guardado!'
            );
        
            return $this->redirectToRoute('subasta_index');
        }
        

        return $this->render('subasta/edit.html.twig', [
            'subastum' => $subastum,
            'form' => $form->createView(),
        ]);

        
            }

    /**
     * @Route("/{id}", name="subasta_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Subasta $subastum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subastum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subastum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subasta_index');
    }
}
