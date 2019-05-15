<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\RequestStack;
use FOS\RestBundle\Controller\Annotations as Rest;
use League\Tactician\CommandBus;
use App\Application\Command\Astronaute\RemoveCommand;
use App\Application\Query\Astronaute\ListQuery;

/**
 * @Route("/api", name="api_")
 */
class RemoveAction extends AbstractFOSRestController
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
     *
     * @Rest\Delete("/astro/{id}")
     * 
     * @return Response
     */
    public function __invoke()
    {
        $command = new RemoveCommand($this->request->getCurrentRequest()->get('id'));
        $this->commandBus->handle($command);

        $query = new ListQuery();
        $astronautes = $this->commandBus->handle($query);

        return $this->handleView($this->view($astronautes));
    }
}
