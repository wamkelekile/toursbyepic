<?php

namespace App\Controller;

use App\Repository\AmenityRepository;
use App\Repository\DestinationRepository;
use App\Repository\ArticleRepository;
use App\Repository\TourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DestinationRepository  $destinationRepository, TourRepository $tourRepository, AmenityRepository $amenityRepository, ArticleRepository $articleRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'destinations' => $destinationRepository->findAll(),
            'tours' => $tourRepository->findAll(),
            'amenities' => $amenityRepository->findAll(),
            ]);
    }
}
