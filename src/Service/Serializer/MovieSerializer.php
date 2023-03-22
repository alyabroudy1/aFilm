<?php

namespace App\Service\Serializer;

use App\Entity\Movie;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class MovieSerializer
{
    private $serializer;

    public function __construct()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $this->serializer = new Serializer([$normalizer], [$encoder]);
    }

    public function deserializeMovie(array $movieData): Movie
    {
        $movie = new Movie();
        $context = [AbstractNormalizer::OBJECT_TO_POPULATE => $movie];
        // Convert string to DateTimeInterface
        if (isset($movieData['DVD'])) {
            $dvd = \DateTimeImmutable::createFromFormat('d M Y', $movieData['DVD']);
            $movieData['DVD'] = $dvd;
        }

        if (isset($movieData['Released'])) {
            $released = \DateTimeImmutable::createFromFormat('d M Y', $movieData['Released']);
            $movieData['Released'] = $released;
        }

        if (isset($movieData['imdbVotes'])) {
            $vote = (int) $movieData['imdbVotes'];
            $movieData['imdbVotes'] = $vote;
        }

        $movie = $this->serializer->denormalize($movieData, Movie::class, null, $context);


        return $movie;
    }

}