<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfiguracionUsuario
 *
 * @ORM\Table(name="configuracion_usuario", uniqueConstraints={@ORM\UniqueConstraint(name="unique_usuario_config", columns={"usuario_id"})}, indexes={@ORM\Index(name="idx_config_usuario_id", columns={"usuario_id"})})
 * @ORM\Entity
 */
class ConfiguracionUsuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tema", type="string", length=20, nullable=true, options={"default"="claro"})
     */
    private $tema = 'claro';

    /**
     * @var string|null
     *
     * @ORM\Column(name="idioma", type="string", length=10, nullable=true, options={"default"="es"})
     */
    private $idioma = 'es';

    /**
     * @var string|null
     *
     * @ORM\Column(name="unidades", type="string", length=20, nullable=true, options={"default"="metrico"})
     */
    private $unidades = 'metrico';

    /**
     * @var string|null
     *
     * @ORM\Column(name="firebase_token", type="text", length=65535, nullable=true)
     */
    private $firebaseToken;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="notif_movimiento_activada", type="boolean", nullable=true, options={"default"="1"})
     */
    private $notifMovimientoActivada = true;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="notif_itv_activada", type="boolean", nullable=true, options={"default"="1"})
     */
    private $notifItvActivada = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="notif_itv_dias_antelacion", type="integer", nullable=true, options={"default"="30"})
     */
    private $notifItvDiasAntelacion = 30;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="notif_mantenimiento_activada", type="boolean", nullable=true, options={"default"="1"})
     */
    private $notifMantenimientoActivada = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="notif_mantenimiento_km_antelacion", type="integer", nullable=true, options={"default"="500"})
     */
    private $notifMantenimientoKmAntelacion = 500;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $fechaActualizacion;

    /**
     * @var \Usuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTema(): ?string
    {
        return $this->tema;
    }

    public function setTema(?string $tema): void
    {
        $this->tema = $tema;
    }

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(?string $idioma): void
    {
        $this->idioma = $idioma;
    }

    public function getUnidades(): ?string
    {
        return $this->unidades;
    }

    public function setUnidades(?string $unidades): void
    {
        $this->unidades = $unidades;
    }

    public function getFirebaseToken(): ?string
    {
        return $this->firebaseToken;
    }

    public function setFirebaseToken(?string $firebaseToken): void
    {
        $this->firebaseToken = $firebaseToken;
    }

    public function getNotifMovimientoActivada(): ?bool
    {
        return $this->notifMovimientoActivada;
    }

    public function setNotifMovimientoActivada(?bool $notifMovimientoActivada): void
    {
        $this->notifMovimientoActivada = $notifMovimientoActivada;
    }

    public function getNotifItvActivada(): ?bool
    {
        return $this->notifItvActivada;
    }

    public function setNotifItvActivada(?bool $notifItvActivada): void
    {
        $this->notifItvActivada = $notifItvActivada;
    }

    public function getNotifItvDiasAntelacion(): ?int
    {
        return $this->notifItvDiasAntelacion;
    }

    public function setNotifItvDiasAntelacion(?int $notifItvDiasAntelacion): void
    {
        $this->notifItvDiasAntelacion = $notifItvDiasAntelacion;
    }

    public function getNotifMantenimientoActivada(): ?bool
    {
        return $this->notifMantenimientoActivada;
    }

    public function setNotifMantenimientoActivada(?bool $notifMantenimientoActivada): void
    {
        $this->notifMantenimientoActivada = $notifMantenimientoActivada;
    }

    public function getNotifMantenimientoKmAntelacion(): ?int
    {
        return $this->notifMantenimientoKmAntelacion;
    }

    public function setNotifMantenimientoKmAntelacion(?int $notifMantenimientoKmAntelacion): void
    {
        $this->notifMantenimientoKmAntelacion = $notifMantenimientoKmAntelacion;
    }

    /**
     * @return DateTime|string
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * @param DateTime|string $fechaActualizacion
     */
    public function setFechaActualizacion($fechaActualizacion): void
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    public function getUsuario(): Usuarios
    {
        return $this->usuario;
    }

    public function setUsuario(Usuarios $usuario): void
    {
        $this->usuario = $usuario;
    }


}
