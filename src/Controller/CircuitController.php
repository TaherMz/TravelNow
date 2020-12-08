<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\CircuitType;
use App\Repository\CircuitRepository;
use App\Repository\EtapeCircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/circuit")
 */
class CircuitController extends AbstractController
{
    private $rep_etape;

    public  function __construct(EtapeCircuitRepository $rep_etape_param)
    {
        $this->rep_etape=$rep_etape_param;
    }

    /**
     * @Route("/", name="circuit_index", methods={"GET"})
     * @param CircuitRepository $circuitRepository
     * @return Response
     */
    public function index(CircuitRepository $circuitRepository): Response
    {
        return $this->render('circuit/index.html.twig', [
            'circuits' => $circuitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="circuit_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $circuit = new Circuit();
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($circuit);
            $entityManager->flush();

            return $this->redirectToRoute('circuit_index');
        }

        return $this->render('circuit/new.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_show", methods={"GET"})
     * @param Circuit $circuit
     * @return Response
     */
    public function show(Circuit $circuit): Response

    {
        $etapes= $this->rep_etape->findByCircuit($circuit) ;

        return $this->render('circuit/show.html.twig', [
            'circuit' => $circuit,
            'etapes' => $etapes,]);
    }
    /**
     * @Route("/{id}/edit", name="circuit_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Circuit $circuit
     * @return Response
     */
    public function edit(Request $request, Circuit $circuit): Response
    {
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);
        $etapes= $this->rep_etape->findByCircuit($circuit) ;

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('circuit_index');
        }
        return $this->render('circuit/edit.html.twig', [
            'circuit' => $circuit,
            'etapes' => $etapes,

            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_delete", methods={"DELETE"})
     * @param Request $request
     * @param Circuit $circuit
     * @return Response
     */
    public function delete(Request $request, Circuit $circuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($circuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('circuit_index');
    }
}
