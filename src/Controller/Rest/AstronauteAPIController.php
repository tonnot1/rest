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

/**
 * @Route("/api", name="api_")
 */
class AstronauteAPIController extends AbstractFOSRestController
{
    /**
   *
   * @Rest\Get("/astro")
   *
   * @return Response
   */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository(Astronaute::class);
        $astronautes = $repository->findall();

        return $this->handleView($this->view($astronautes));
    }

    /**
     *
     * @Rest\Get("/astro/{id}")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function findAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $astronaute = $em->getRepository(Astronaute::class)
            ->find($request->get('id'));

        return $this->handleView($this->view($astronaute));
    }

    /**
     *
     * @Rest\Put("/astro/{id}")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function setAction(Request $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $astronaute = $em->getRepository(Astronaute::class)
            ->find($request->get('id'));
        $em->flush();

        $form = $this->createForm(AstronauteType::class, $astronaute);
        $data = $serializer->decode($request->getContent(), 'json');

        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
          $em->flush();

          return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors()));
    }

    /**
     *
     * @Rest\Post("/astro")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $astronaute = new Astronaute();
        $form = $this->createForm(AstronauteType::class, $astronaute);

        $data = $serializer->decode($request->getContent(), 'json');
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($form->getData());
          $em->flush();

          return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors()));
    }

    /**
     *
     * @Rest\Delete("/astro/{id}")
     * @param Request $request
     */
    public function removeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $astronaute = $em->getRepository(Astronaute::class)
            ->find($request->get('id'));
        $em->remove($astronaute);
        $em->flush();
    }
}
