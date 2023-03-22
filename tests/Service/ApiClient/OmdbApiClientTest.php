<?php

namespace App\Tests\Service\ApiClient;

use App\Service\ApiClient\OmdbApiClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OmdbApiClientTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();
        $client = new OmdbApiClient($container->get(EntityManagerInterface::class));
        $movieId= 'tt0111161';
        dd($client->writeTestMoviesToDB());
        $movie = $client->getMovieById($movieId);

        $this->assertContains('imdbID', array_keys($movie));
       // $this->assertSame('tt0111161', $movie);
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
