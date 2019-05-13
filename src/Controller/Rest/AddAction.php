<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\ListService;
use App\Service\CreateService;

/**
 * @Route("/api", name="api_")
 */
class AddAction extends AbstractFOSRestController
{
    /** @var CreateService */
    private $createService; 

    /** @var ListService */
    private $listService;

    public function __construct(CreateService $createService, ListService $listService) {
        $this->createService = $createService;
        $this->listService = $listService;
    }

    /**
     * @Rest\Post("/astro")
     */
    public function __invoke()
    {
        $this->createService->createAstronaute();
        $astronautes = $this->listService->listAstronaute();

        return $this->handleView($this->view($astronautes));
    }
}
