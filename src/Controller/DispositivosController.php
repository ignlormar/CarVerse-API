<?php

namespace App\Controller;

use App\Entity\Dispositivos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class DispositivosController extends AbstractController
{
    public function createDispositivo(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $imei = $request->get('imei');
        $flespi_id = $request->get('flespi_id');
        $descripcion = $request->get('descripcion');

        if (!empty($imei) && !empty($flespi_id) && !empty($descripcion)) {
            $dispositivo = new Dispositivos();
            $dispositivo->setImei($imei);
            $dispositivo->setFlespiId($flespi_id);
            $dispositivo->setDescripcion($descripcion);
            $dispositivo->setFechaAlta(new \DateTime());
            $entityManager->persist($dispositivo);
            $entityManager->flush();

            $dispositivos = $serializer->serialize($dispositivo, 'json', ['groups' => 'dispositivos']);
            return new JsonResponse($dispositivos, 201, [], true);
        } else {
            return new JsonResponse(['error' => 'Faltan datos'], 400);
        }
    }

    public function updateDispositivo(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $id = $request->get('id');

        $dispsitivo = null;

        if (!empty($id)){
            $dispositivo = $this->getDoctrine()->getRepository(Dispositivos::class)->findOneBy(['id' => $id]);
        }

        $imei = $request->get('imei');
        $flespi_id = $request->get('flespi_id');
        $descripcion = $request->get('descripcion');

        if (!empty($dispositivo)){
            if (!empty($imei)){
                $dispositivo->setImei($imei);
            }
            if (!empty($flespi_id)){
                $dispositivo->setFlespiId($flespi_id);
            }
            if (!empty($descripcion)){
                $dispositivo->setDescripcion($descripcion);
            }

            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($dispositivo);
            $entityManager->flush();

            $dispsitivo = $serializer->serialize($dispositivo, 'json', ['groups' => 'dispositivos']);

            return new JsonResponse($dispsitivo, 201, [], true);
        } else {
            return new JsonResponse(['error' => 'Faltan datos'], 400);
        }
    }
}