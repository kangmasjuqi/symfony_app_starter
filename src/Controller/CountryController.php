<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CountryController extends AbstractController
{
    private CountryRepository $countryRepository;
    private CacheInterface $cache;

    public function __construct(CountryRepository $countryRepository, CacheInterface $cache)
    {
        $this->countryRepository = $countryRepository;
        $this->cache = $cache;
    }

    #[Route('/countries', name: 'countries_list', methods: ['GET'])]
    public function index(): JsonResponse
    {
        // Try to fetch the countries data from cache
        $countries = $this->cache->get('countries_list', function (ItemInterface $item) {
            // Set cache lifetime to 1 week (7 days)
            $item->expiresAfter(7 * 24 * 60 * 60); // 1 week in seconds

            // Fetch the data from the database if not cached
            return $this->countryRepository->findAllCountries();
        });

        // Return the countries list as JSON response
        return $this->json($countries);
    }
}
