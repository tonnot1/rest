<?php

namespace App\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\RequestStack;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Application\Command\Astronaute\UpdateCommand;
use App\Application\Query\Astronaute\FindQuery;
use League\Tactician\CommandBus;

/**
 * @Route("/api", name="api_")
 */
class UpdateAction extends AbstractFOSRestController
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
     * @Rest\Put("/astro/{id}")
     */
    public function __invoke()
    {
        $command = new UpdateCommand($this->request->getCurrentRequest()->get('id'));
        $this->commandBus->handle($command);

        $query = new FindQuery($this->request->getCurrentRequest()->get('id'));
        $astronaute = $this->commandBus->handle($query);

        return $this->handleView($this->view($astronaute));
    }
}
