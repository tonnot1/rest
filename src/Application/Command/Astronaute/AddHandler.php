<?php

namespace App\Application\Command\Astronaute;

use App\Entity\Astronaute;
use App\Form\AstronauteType;
use App\Repository\AstronauteRepositoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AddHandler
{
    /** @var AstronauteRepositoryInterface */
    private $astronauteRepository;

    /** @var RequestStack */
    private $requestStack;

    /** @var FormFactoryInterface */
    private $formFactory;

    public function __construct(AstronauteRepositoryInterface $astronauteRepository, RequestStack $requestStack, FormFactoryInterface $formFactory) {
        $this->astronauteRepository = $astronauteRepository;
        $this->requestStack = $requestStack;
        $this->formFactory = $formFactory;
    }

    public function handle(AddCommand $addCommand): void
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $request = $this->requestStack->getCurrentRequest();

        try {
            $astronaute = new Astronaute;

            $form = $this->formFactory->createBuilder(AstronauteType::class, $astronaute);
            $data = $serializer->decode($request->getContent(), 'json');

            $formBuild = $form->getForm();
            $formBuild->submit($data);

            if ($formBuild->isSubmitted() && $formBuild->isValid()) {
                $this->astronauteRepository->add($formBuild->getData());
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
