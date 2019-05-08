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
class AstronauteAPIController extends AbstractFOSRestController
{
    /**
   *
   * @Rest\Get("/astro")
   * 
   * * @param ListService $listService
   *
   * @return Response
   */
    public function listAction(ListService $listService)
    {
        $astronautes = $listService->listAstronaute();

        return $this->handleView($this->view($astronautes));
    }

    /**
     *
     * @Rest\Get("/astro/{id}")
     *
     * @param FindService $findService
     *
     * @return Response
     */
    public function findAction(FindService $findService)
    {
        $astronaute = $findService->findAstronaute();

        return $this->handleView($this->view($astronaute));
    }

    /**
     *
     * @Rest\Put("/astro/{id}")
     *
     * @param UpdateService $updateService
     *
     * @return Response
     */
    public function setAction(UpdateService $updateService, FindService $findService)
    {
        $updateService->updateAstronaute();
        $astronaute = $findService->findAstronaute();

        return $this->handleView($this->view($astronaute));
        
    }

    /**
     *
     * @Rest\Post("/astro")
     *
     * @param CreateService $createService
     *
     * @return Response
     */
    public function addAction(CreateService $createService, ListService $listService)
    {
        $createService->createAstronaute();
        $astronautes = $listService->listAstronaute();

        return $this->handleView($this->view($astronautes));
    }

    /**
     *
     * @Rest\Delete("/astro/{id}")
     * @param RemoveService $removeService
     */
    public function removeAction(RemoveService $removeService, ListService $listService)
    {
        $removeService->removeAstronaute();
        $astronautes = $listService->listAstronaute();

        return $this->handleView($this->view($astronautes));
    }
}
