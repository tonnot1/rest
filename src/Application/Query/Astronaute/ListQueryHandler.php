<?php

namespace App\Application\Query\Astronaute;

use App\Entity\Astronaute;
use App\Repository\AstronauteRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\Exception;
use App\Application\Query\Astronaute\ListQuery;

class ListQueryHandler
{
    /** @var AstronauteRepositoryInterface */
    private $astronauteRepository;

    public function __construct(AstronauteRepositoryInterface $astronauteRepository) {
        $this->astronauteRepository = $astronauteRepository;
    }

    /**
     * @return Astronaute[]
     */
    public function handle(ListQuery $listQuery): array
    {
        try {
            $astronautes = $this->astronauteRepository->findAll();
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $astronautes;
    }
}
