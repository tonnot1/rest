<?php

namespace App\Application\Command\Astronaute;

use App\Entity\Astronaute;
use App\Form\AstronauteType;
use App\Repository\AstronauteRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RemoveHandler
{
    /** @var AstronauteRepositoryInterface */
    private $astronauteRepository;

    public function __construct(AstronauteRepositoryInterface $astronauteRepository) {
        $this->astronauteRepository = $astronauteRepository;
    }

    public function handle(RemoveCommand $removeCommand): void
    {
        try {
                $astronaute = $this->astronauteRepository->find($removeCommand->astronauteId);
                $this->astronauteRepository->remove($astronaute);
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
