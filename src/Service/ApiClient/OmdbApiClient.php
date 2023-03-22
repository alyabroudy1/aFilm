<?php

namespace App\Service\ApiClient;


use App\Entity\Movie;
use App\Service\Serializer\MovieSerializer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class OmdbApiClient
{
    private $client;
    private $apiKey;
    private EntityManagerInterface $entityManager;
    private $testMovieList = [
        'tt0111161',
        'tt0116629',
        'tt0068646',
        'tt0133093',
        'tt0110912',
        'tt0468569',
        'tt0108052',
        'tt0120737',
        'tt0137523',
        'tt0060196',
        'tt1375666',
        'tt0109830',
        'tt0114369'
        ];

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->client = new Client();
    }

    public function getMovieById(string $movieId): array
    {
        $response = $this->client->request('GET', $this->getBaseUri(), [
            'query' => [
                'apikey' => $this->getApiKey(),
                'i' => $movieId,
            ],
        ]);
        $body = $response->getBody();
        return json_decode($body, true);
    }

    public function writeTestMoviesToDB()
    {
        $serializer = new MovieSerializer();
        foreach ($this->testMovieList as $movieId){
            $movie = $this->getMovieById($movieId);
            $isExist = $this->entityManager->find(Movie::class, $movieId);
            if (!$isExist && $movie){
                $serilaizedMovie = $serializer->deserializeMovie($movie);
                $this->entityManager->persist($serilaizedMovie);
                $this->entityManager->flush($serilaizedMovie);

            }
        }
    }

    public function getTestMovies()
    {
        $serializer = new MovieSerializer();
        $movieList = [];
        foreach ($this->testMovieList as $movieId){
            $movie = $this->getMovieById($movieId);
            $isExist = $this->entityManager->find(Movie::class, $movieId);
            if (!$isExist && $movie){
                $serilaizedMovie = $serializer->deserializeMovie($movie);
                $movieList[] = $serilaizedMovie;
//                $this->entityManager->persist($serilaizedMovie);
//                $this->entityManager->flush($serilaizedMovie);
            }
        }
        return $movieList;
    }

    public function getBaseUri(): string
    {
        //TODO: get it from .env
        return 'http://www.omdbapi.com';
    }
    public function getApiKey(): string
    {
        //TODO: get it from .env
        return '7c0b1b32';
    }


}