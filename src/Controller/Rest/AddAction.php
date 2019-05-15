<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Application\Command\Astronaute\AddCommand;
use App\Application\Query\Astronaute\ListQuery;
use League\Tactician\CommandBus;

/**
 * @Route("/api", name="api_")
 */
class AddAction extends AbstractFOSRestController
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus) {
        $this->commandBus = $commandBus;
    }

    /**
     * @Rest\Post("/astro")
     */
    public function __invoke()
    {
        $command = new AddCommand();
        $this->commandBus->handle($command);

        $query = new ListQuery();
        $astronautes = $this->commandBus->handle($query);

        return $this->handleView($this->view($astronautes));
    }
}
