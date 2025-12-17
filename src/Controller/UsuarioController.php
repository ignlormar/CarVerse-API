<?php

namespace App\Controller;



use App\Entity\Usuarios;
use App\Entity\ConfiguracionUsuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class UsuarioController extends AbstractController
{
    public function getUsuarios(EntityManagerInterface $entityManager, SerializerInterface $serializer) {
        $usuarios = $entityManager->getRepository(Usuarios::class)->findAll();
        return new JsonResponse($serializer->serialize($usuarios, 'json', ['groups' => 'usuarios']), JsonResponse::HTTP_OK, [], true);
    }

    public function getUsuarioById(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $id = $request->get('id');

        $usuario = $this->getDoctrine()
            ->getManager()
            ->getRepository(Usuarios::class)
            ->findOneBy(['id' => $id]);

        $usuario = $serializer->serialize($usuario, 'json', ['groups' => 'usuarios']);
        return new JsonResponse($usuario, JsonResponse::HTTP_OK, [], true);
    }

    public function createUsuario(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $nombre = $request->get('nombre');
        $email = $request->get('email');
        $password = $request->get('password');
        $telefono = $request->get('telefono');

        if (!empty($nombre) && !empty($email) && !empty($password) && !empty($telefono)) {
            $usuario = new Usuarios();
            $usuario->setNombre($nombre);
            $usuario->setEmail($email);
            $usuario->setPassword($password);
            $usuario->setTelefono($telefono);
            $usuario->setFechaRegistro(new \DateTime());

            $config = new ConfiguracionUsuario();
            $config->setUsuario($usuario);
            $config->setFechaActualizacion(new \DateTime());

            $entityManager->persist($usuario);
            $entityManager->persist($config);
            $entityManager->flush();

            $usuario = $serializer->serialize($usuario, 'json', ['groups' => 'usuarios']);
            return new JsonResponse(['exito' => 'Usuario creado'], JsonResponse::HTTP_CREATED);
        } else {
            return new JsonResponse(['error' => 'Faltan datos'], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    public function updateUsuario(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $id =$request->get('id');
        $usuario = null;
        if (!empty($id)) {
            $usuario = $this->getDoctrine()->getRepository(Usuarios::class)->findOneBy(['id' => $id]);
        }

        $nombre = $request->get('nombre');
        $email = $request->get('email');
        $password = $request->get('password');
        $telefono = $request->get('telefono');
        if (!empty($usuario)){
            if (!empty($nombre)){
                $usuario->setNombre($nombre);
            }
            if (!empty($email)){
                $usuario->setEmail($email);
            }
            if (!empty($password)){
                $usuario->setPassword($password);
            }
            if (!empty($telefono)){
                $usuario->setTelefono($telefono);
            }

            $entityManager->persist($usuario);
            $entityManager->flush();

            $usuario = $serializer->serialize($usuario, 'json', ['groups' => 'usuarios']);

            return new JsonResponse(['exito' => 'Usuario actualizado'], JsonResponse::HTTP_OK);
        } else {
            return new JsonResponse(['error' => 'Faltan datos'], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    public function updateConfig(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $idUsuario = $request->get('idUsuario');
        $usuario = $this->getDoctrine()->getRepository(Usuarios::class)->findOneBy(['id' => $idUsuario]);
        $config = null;
        if (!empty($idUsuario)) {
            $config = $this->getDoctrine()
                ->getRepository(ConfiguracionUsuario::class)->findOneBy(['usuario' => $usuario]);
        }

        $tema = $request->get('tema');
        $idioma = $request->get('idioma');
        $unidades = $request->get('unidades');
        $firebase_token = $request->get('firebase_token');
        $notif_movimiento_activada = $request->get('notif_movimiento_activada');
        $notif_itv_activada = $request->get('notif_itv_activada');
        $notif_itv_dias_antelacion = $request->get('notif_itv_dias_antelacion');
        $notif_mantenimiento_activada = $request->get('notif_mantenimiento_activada');
        $notif_mantenimiento_km_antelacion = $request->get('notif_mantenimiento_km_antelacion');

        if (!empty($config)){
            if (!empty($tema)){
                $config->setTema($tema);
            }
            if (!empty($idioma)){
                $config->setIdioma($idioma);
            }
            if (!empty($unidades)){
                $config->setUnidades($unidades);
            }
            if (!empty($firebase_token)){
                $config->setFirebaseToken($firebase_token);
            }
            if (!empty($notif_movimiento_activada)){
                $config->setNotifMovimientoActivada($notif_movimiento_activada);
            }
            if (!empty($notif_itv_activada)){
                $config->setNotifItvActivada($notif_itv_activada);
            }
            if (!empty($notif_itv_dias_antelacion)){
                $config->setNotifItvDiasAntelacion($notif_itv_dias_antelacion);
            }
            if (!empty($notif_mantenimiento_activada)){
                $config->setNotifMantenimientoActivada($notif_mantenimiento_activada);
            }
            if (!empty($notif_mantenimiento_km_antelacion)){
                $config->setNotifMantenimientoKmAntelacion($notif_mantenimiento_km_antelacion);
            }

            $config->setFechaActualizacion(new \DateTime());

            $entityManager->persist($config);
            $entityManager->flush();

            $config = $serializer->serialize($config, 'json');
            return new JsonResponse(['exito' => 'Configuracion actualizada'], JsonResponse::HTTP_OK);
        } else {
            return new JsonResponse(['error' => 'Faltan datos'], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}