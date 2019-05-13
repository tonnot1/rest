<?php

namespace App\Service;

use App\Entity\Astronaute;
use App\Form\AstronauteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CreateService
{
    private $entityManager;
    private $requestStack;
    private $formFactory;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, FormFactoryInterface $formFactory) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->formFactory = $formFactory;
    }

    public function createAstronaute() {

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
                $this->entityManager->persist($formBuild->getData());
                $this->entityManager->flush();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
