<?php

namespace App\Controller;

use App\Entity\Amenity;
use App\Form\AmenityType;
use App\Repository\AmenityRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/amenities")
 */
class AmenityController extends AbstractController
{
    /**
     * @Route("/", name="amenity_index", methods={"GET"})
     */
    public function index(AmenityRepository $amenityRepository, ArticleRepository $articleRepository): Response
    {
        return $this->render('amenity/index.html.twig', [
            'amenities' => $amenityRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="amenity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $amenity = new Amenity();
        $form = $this->createForm(AmenityType::class, $amenity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($amenity);
            $entityManager->flush();

            return $this->redirectToRoute('amenity_index');
        }

        return $this->render('amenity/new.html.twig', [
            'amenity' => $amenity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="amenity_show", methods={"GET"})
     */
    public function show(Amenity $amenity): Response
    {
        return $this->render('amenity/show.html.twig', [
            'amenity' => $amenity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="amenity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Amenity $amenity): Response
    {
        $form = $this->createForm(AmenityType::class, $amenity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('amenity_index');
        }

        return $this->render('amenity/edit.html.twig', [
            'amenity' => $amenity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="amenity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Amenity $amenity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amenity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($amenity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('amenity_index');
    }
}
