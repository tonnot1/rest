<?php

namespace App\Service;

use App\Entity\Astronaute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\Exception;
use Symfony\Component\HttpFoundation\RequestStack;

class FindService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function findAstronaute() {

        $request = $this->requestStack->getCurrentRequest();

        try {
            $astronaute = $this->entityManager->getRepository(Astronaute::class)
                            ->find($request->get('id'));

            return $astronaute;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}