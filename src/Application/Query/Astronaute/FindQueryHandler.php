<?php

namespace App\Application\Query\Astronaute;

use App\Entity\Astronaute;
use App\Repository\AstronauteRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\Exception;

class FindQueryHandler
{
    /** @var AstronauteRepositoryInterface */
    private $astronauteRepository;

    public function __construct(AstronauteRepositoryInterface $astronauteRepository) {
        $this->astronauteRepository = $astronauteRepository;
    }

    public function handle(FindQuery $findQuery): Astronaute
    {
        try {
            $astronaute = $this->astronauteRepository->find($findQuery->astronauteId);
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $astronaute;
    }
}
