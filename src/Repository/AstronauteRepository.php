<?php

namespace App\Repository;

use App\Entity\Astronaute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Astronaute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astronaute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astronaute[]    findAll()
 * @method Astronaute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstronauteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Astronaute::class);
    }

    // /**
    //  * @return Astronaute[] Returns an array of Astronaute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Astronaute
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
