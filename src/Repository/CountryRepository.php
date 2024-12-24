<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Country>
 */
class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    /**
     * Get all countries
     *
     * @return array
     */
    public function findAllCountries(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.code', 'c.name')
            ->getQuery()
            ->getResult();
    }
}
