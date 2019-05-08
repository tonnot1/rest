<?php

namespace App\Service;

use App\Entity\Astronaute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\Exception;

class RemoveService
{
    private $entityManager;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function removeAstronaute() {

        $request = $this->requestStack->getCurrentRequest();

        try {
            $astronaute = $this->entityManager->getRepository(Astronaute::class)
                            ->find($request->get('id'));
                $this->entityManager->remove($astronaute);
                $this->entityManager->flush();
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
