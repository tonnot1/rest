<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Application\Query\Astronaute\ListQuery;
use League\Tactician\CommandBus;

/**
 * @Route("/api", name="api_")
 */
class ListAction extends AbstractFOSRestController
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus) {
        $this->commandBus = $commandBus;
    }

   /**
   * @Rest\Get("/astro")
   */
    public function __invoke()
    {
        $query = new ListQuery();
        $astronautes = $this->commandBus->handle($query);

        return $this->handleView($this->view($astronautes));
    }
}
