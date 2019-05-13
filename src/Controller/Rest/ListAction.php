<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\ListService;

/**
 * @Route("/api", name="api_")
 */
class ListAction extends AbstractFOSRestController
{
    /** @var ListeService */
    private $listeService; 

    public function __construct(ListService $listService) {
        $this->listeService = $listeService;
    }

   /**
   * @Rest\Get("/astro")
   */
    public function __invoke()
    {
        $astronautes = $this->listService->listAstronaute();

        return $this->handleView($this->view($astronautes));
    }
}
