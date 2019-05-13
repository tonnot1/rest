<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\FindService;
use App\Service\UpdateService;

/**
 * @Route("/api", name="api_")
 */
class UpdateAction extends AbstractFOSRestController
{

    /** @var UpdateService */
    private $updateService; 

    /** @var FindService */
    private $findService;

    public function __construct(UpdateService $updateService, FindService $findService) {
        $this->updateService = $updateService;
        $this->findService = $findService;
    }
    /**
     * @Rest\Put("/astro/{id}")
     */
    public function __invoke()
    {
        $this->updateService->updateAstronaute();
        $astronaute = $this->findService->findAstronaute();

        return $this->handleView($this->view($astronaute));
    }
}
