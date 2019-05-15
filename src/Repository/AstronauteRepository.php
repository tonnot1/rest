<?php

namespace App\Repository;

use App\Entity\Astronaute;
use App\Repository\AstronauteRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Astronaute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astronaute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astronaute[]    findAll()
 * @method Astronaute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstronauteRepository extends ServiceEntityRepository implements AstronauteRepositoryInterface
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, RegistryInterface $registry)
    {
        parent::__construct($registry, Astronaute::class);
        $this->entityManager = $entityManager;
    }

    public function add($data): void
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function set(Astronaute $astronaute): void
    {
        $this->entityManager->flush($astronaute);
    }

    public function remove(Astronaute $astronaute): void
    {
        $this->entityManager->remove($astronaute);
        $this->entityManager->flush();
    }
}
