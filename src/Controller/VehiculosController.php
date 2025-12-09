<?php

namespace App\Controller;

use App\Entity\Dispositivos;
use App\Entity\Usuarios;
use App\Entity\Vehiculos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\SerializerInterface;

class VehiculosController extends AbstractController
{
    public function getVehiculos(EntityManagerInterface $entityManager, SerializerInterface $serializer){
        $vehiculos = $entityManager->getRepository(Vehiculos::class)->findAll();
        return new JsonResponse($serializer->serialize($vehiculos, 'json', ['groups' => 'vehiculos']), JsonResponse::HTTP_OK, [], true);
    }

    public function getVehiculosByUser(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse{
        $id = $request->get('userId');

        if (!empty($id)) {
            $usuario = $entityManager->getRepository(Usuarios::class)->findOneBy(['id' => $id]);
            if (!$usuario) {
                return new JsonResponse(['message' => 'Usuario no encontrado'], JsonResponse::HTTP_NOT_FOUND);
            }

            $vehiculos = $entityManager->getRepository(Vehiculos::class)->findBy(['usuario' => $usuario]);

            $vehiculos = $serializer->serialize(
                $vehiculos,
                'json',
                ['groups' => 'vehiculos']
            );

            return new JsonResponse($vehiculos, JsonResponse::HTTP_OK, [], true);
        } else {
            return new JsonResponse(['message' => 'Error'], JsonResponse::HTTP_NOT_FOUND);
        }

        $vehiculos = $usuario->getVehiculos();
        return new JsonResponse($serializer->serialize($vehiculos, 'json', ['groups' => 'vehiculos']), JsonResponse::HTTP_OK, [], true);
    }

    public function createVehiculo(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $usuario_id = $request->get('usuario_id');
        $foto = $request->get('foto');
        $marca = $request->get('marca');
        $modelo = $request->get('modelo');
        $matricula = $request->get('matricula');
        $anio_matriculacion = $request->get('anio_matriculacion');
        $combustible = $request->get('combustible');
        $km = $request->get('km');
        $proximo_mantenimiento = $request->get('proximo_mantenimiento');
        //$fecha_itv = $request->get('fecha_itv');
        $dispositivo_id = $request->get('dispositivo_id');

        if (!empty($usuario_id) && !empty($foto) && !empty($marca) && !empty($modelo) && !empty($matricula) && !empty($anio_matriculacion)
            && !empty($combustible) && !empty($km) && !empty($proximo_mantenimiento) /*&& !empty($fecha_itv)*/
            && !empty($dispositivo_id)) {

            $usuario = $entityManager->getRepository(Usuarios::class)->findOneBy(['id' => $usuario_id]);
            $dispositivo = $entityManager->getRepository(Dispositivos::class)->findOneBy(['id' => $dispositivo_id]);

            $vehiculo = new Vehiculos();
            $vehiculo->setUsuario($usuario);
            $vehiculo->setFoto($foto);
            $vehiculo->setMarca($marca);
            $vehiculo->setModelo($modelo);
            $vehiculo->setMatricula($matricula);
            $vehiculo->setAnioMatriculacion($anio_matriculacion);
            $vehiculo->setCombustible($combustible);
            $vehiculo->setKm($km);
            $vehiculo->setProximoMantenimiento($proximo_mantenimiento);
            $vehiculo->setFechaItv(new \DateTime());
            $vehiculo->setDispositivo($dispositivo);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehiculo);
            $entityManager->flush();

            $vehiculo = $serializer->serialize($vehiculo, 'json', ['groups' => 'vehiculos']);
            return new JsonResponse($vehiculo, JsonResponse::HTTP_OK, [], true);
        } else {
            return new JsonResponse(['message' => 'No ha sido posible crear el vehiculo'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function deleteVehiculos (Request $request, SerializerInterface $serializer): JsonResponse
    {
        $id = $request->get('id');

        $vehiculo = $this->getDoctrine()->getManager()->getRepository(Vehiculos::class)->findOneBy(['id' => $id]);

        $vehiculoDeleted = clone $vehiculo;
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($vehiculo);
        $entityManager->flush();

        $vehiculoDeleted = $serializer->serialize($vehiculoDeleted, 'json', ['groups' => 'vehiculos']);

        return new JsonResponse($vehiculoDeleted, JsonResponse::HTTP_OK, [], true);
    }

    public function updateVehiculos(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $id = $request->get('id');

        $vehiculo = null;
        if (!empty($id)) {
            $vehiculo = $this->getDoctrine()->getRepository(Vehiculos::class)->findOneBy(['id' => $id]);
        }
        $foto = $request->get('foto');
        $marca = $request->get('marca');
        $modelo = $request->get('modelo');
        $matricula = $request->get('matricula');
        $anio_matriculacion = $request->get('anio_matriculacion');
        $combustible = $request->get('combustible');
        $km = $request->get('km');
        $proximo_mantenimiento = $request->get('proximo_mantenimiento');
        $fechaItv = $request->get('fecha_itv');
        $dispositivo_id = $request->get('dispositivo_id');

        if (!empty($vehiculo)) {
            if (!empty($foto)) {
                $vehiculo->setFoto($foto);
            }
            if (!empty($marca)) {
                $vehiculo->setMarca($marca);
            }
            if (!empty($modelo)) {
                $vehiculo->setModelo($modelo);
            }
            if (!empty($matricula)) {
                $vehiculo->setMatricula($matricula);
            }
            if (!empty($anio_matriculacion)) {
                $vehiculo->setAnioMatriculacion($anio_matriculacion);
            }
            if (!empty($combustible)) {
                $vehiculo->setCombustible($combustible);
            }
            if (!empty($km)) {
                $vehiculo->setKm($km);
            }
            if (!empty($proximo_mantenimiento)) {
                $vehiculo->setProximoMantenimiento($proximo_mantenimiento);
            }
            if (!empty($fechaItv)){
                $vehiculo->setFechaItv(new \DateTime($fechaItv));
            }
            if (!empty($dispositivo_id)) {
                $vehiculo->setDispositivo($dispositivo_id);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehiculo);
            $entityManager->flush();

            $vehiculo = $serializer->serialize($vehiculo, 'json', ['groups' => 'vehiculos']);

            return new JsonResponse($vehiculo, JsonResponse::HTTP_OK, [], true);
        } else {
            return new JsonResponse(['message' => 'Vehiculo no encontrado'], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}