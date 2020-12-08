<?php

namespace App\Controller;

use App\Entity\EtapeCircuit;
use App\Form\EtapeCircuitType;
use App\Repository\EtapeCircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etape/circuit")
 */
class EtapeCircuitController extends AbstractController
{
    /**
     * @Route("/", name="etape_circuit_index", methods={"GET"})
     */
    public function index(EtapeCircuitRepository $etapeCircuitRepository): Response
    {
        return $this->render('etape_circuit/index.html.twig', [
            'etape_circuits' => $etapeCircuitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etape_circuit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etapeCircuit = new EtapeCircuit();
        $form = $this->createForm(EtapeCircuitType::class, $etapeCircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etapeCircuit);
            $entityManager->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('etape_circuit/new.html.twig', [
            'etape_circuit' => $etapeCircuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etape_circuit_show", methods={"GET"})
     */
    public function show(EtapeCircuit $etapeCircuit): Response
    {
        return $this->render('etape_circuit/show.html.twig', [
            'etape_circuit' => $etapeCircuit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etape_circuit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EtapeCircuit $etapeCircuit): Response
    {
        $form = $this->createForm(EtapeCircuitType::class, $etapeCircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('etape_circuit/edit.html.twig', [
            'etape_circuit' => $etapeCircuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etape_circuit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EtapeCircuit $etapeCircuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etapeCircuit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etapeCircuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('circuit_index');
    }
}
