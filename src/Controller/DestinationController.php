<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Form\DestinationType;
use App\Repository\DestinationRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/destination")
 */
class DestinationController extends AbstractController
{
    private $rep_ville;

    public  function __construct(VilleRepository $rep_ville_param)
    {
        $this->rep_ville=$rep_ville_param;
    }


    /**
     * @Route("/", name="destination_index", methods={"GET"})
     * @param DestinationRepository $destinationRepository
     * @return Response
     */
    public function index(DestinationRepository $destinationRepository): Response
    {
        return $this->render('destination/index.html.twig', [
            'destinations' => $destinationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="destination_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $destination = new Destination();
        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('destination_index');
        }

        return $this->render('destination/new.html.twig', [
            'destination' => $destination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="destination_show", methods={"GET"})
     * @param Destination $destination
     * @return Response
     */
    public function show(Destination $destination): Response
    {
        $villes=$this->rep_ville->findByDestination($destination);

        return $this->render('destination/show.html.twig', [
            'destination' => $destination,
            'villes' => $villes
        ]);
    }


    /**
     * @Route("/{id}/edit", name="destination_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Destination $destination
     * @return Response
     */
    public function edit(Request $request, Destination $destination): Response
    {
        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);

        $villes=$this->rep_ville->findByDestination($destination);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('destination_index');
        }

        return $this->render('destination/edit.html.twig',
            [
                'destination' => $destination,
                'villes' => $villes,
                'form'=> $form -> createView(),
            ]);
    }

    /**
     * @Route("/{id}", name="destination_delete", methods={"DELETE"})
     * @param Request $request
     * @param Destination $destination
     * @return Response
     */
    public function delete(Request $request, Destination $destination): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destination->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($destination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('destination_index');
    }
}
