<?php

namespace App\Service;

use App\Entity\Astronaute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\Exception;

class ListService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function listAstronaute() {

        try {
            $astronautes = $this->entityManager->getRepository(Astronaute::class)
                            ->findAll();

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $astronautes;
    }
}
