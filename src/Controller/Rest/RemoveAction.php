<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Astronaute;
use App\Form\AstronauteType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Service\ListService;
use App\Service\FindService;
use App\Service\UpdateService;
use App\Service\CreateService;
use App\Service\RemoveService;

/**
 * @Route("/api", name="api_")
 */
class RemoveAction
{
    /** @var RemoveService */
    private $removeAction;

    /** @var ListService */
    private $listService;

    public function __construct(RemoveService $removeAction, ListService $listService) {
        $this->removeAction = $removeAction;
        $this->listService = $listService;
    }

    /**
     *
     * @Rest\Delete("/astro/{id}")
     * 
     * @return Response
     */
    public function __invoke()
    {
        $this->removeService->removeAstronaute();
        $astronautes = $this->listService->listAstronaute();

        return $this->handleView($this->view($astronautes));
    }
}
