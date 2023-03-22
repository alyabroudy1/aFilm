<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Service\ApiClient\OmdbApiClient;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\ClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {
        $client = new OmdbApiClient($this->entityManager);
      //$movies = $client->getTestMovies();
      $movies = $this->entityManager->getRepository(Movie::class)->findAll();
      dd($movies);
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }
}
