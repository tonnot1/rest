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

class UpdateService
{
    private $entityManager;
    private $requestStack;
    private $formFactory;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, FormFactoryInterface $formFactory) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->formFactory = $formFactory;
    }

    public function updateAstronaute() {

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $request = $this->requestStack->getCurrentRequest();

        try {
            $astronaute = $this->entityManager->getRepository(Astronaute::class)
                            ->find($request->get('id'));

            $form = $this->formFactory->create(AstronauteType::class, $astronaute);
            $data = $serializer->decode($request->getContent(), 'json');
                
            $form->submit($data);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->entityManager->flush();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
