<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Application\Query\Astronaute\FindQuery;
use League\Tactician\CommandBus;
// use App\Service\FindService;

/**
 * @Route("/api", name="api_")
 */
class FindAction extends AbstractFOSRestController
{
    /** @var RequestStack */
    private $request;

    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus, RequestStack $request) {
    
        $this->commandBus = $commandBus;
        $this->request = $request;
    }

    /**
     * @Rest\Get("/astro/{id}")
     */
    public function __invoke()
    {
        $query = new FindQuery($this->request->getCurrentRequest()->get('id'));
        $astronaute = $this->commandBus->handle($query);

        return $this->handleView($this->view($astronaute));
    }
}
