<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\FindService;

/**
 * @Route("/api", name="api_")
 */
class FindAction extends AbstractFOSRestController
{
    /** @var FindService */
    private $findService;

    public function __construct(FindService $findService) {
        $this->findService = $findService;
    }

    /**
     * @Rest\Get("/astro/{id}")
     */
    public function __invoke()
    {
        $astronaute = $this->findService->findAstronaute();

        return $this->handleView($this->view($astronaute));
    }
}
