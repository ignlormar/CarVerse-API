<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Dispositivos;
use App\Entity\Usuarios;

/**
 * Vehiculos
 *
 * @ORM\Table(name="vehiculos", uniqueConstraints={@ORM\UniqueConstraint(name="matricula", columns={"matricula"})}, indexes={@ORM\Index(name="idx_vehiculos_usuario_id", columns={"usuario_id"}), @ORM\Index(name="idx_vehiculos_dispositivo_id", columns={"dispositivo_id"})})
 * @ORM\Entity
 */
class Vehiculos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("vehiculos")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="foto", type="text", length=65535, nullable=true)
     * @Groups("vehiculos")
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=100, nullable=false)
     * @Groups("vehiculos")
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=100, nullable=false)
     * @Groups("vehiculos")
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=20, nullable=false)
     * @Groups("vehiculos")
     */
    private $matricula;

    /**
     * @var int|null
     *
     * @ORM\Column(name="anio_matriculacion", type="integer", nullable=true)
     * @Groups("vehiculos")
     */
    private $anioMatriculacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="combustible", type="string", length=50, nullable=true)
     * @Groups("vehiculos")
     */
    private $combustible;

    /**
     * @var int|null
     *
     * @ORM\Column(name="km", type="integer", nullable=true)
     * @Groups("vehiculos")
     */
    private $km = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="proximo_mantenimiento", type="integer", nullable=true)
     * @Groups("vehiculos")
     */
    private $proximoMantenimiento;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_itv", type="datetime", nullable=true)
     * @Groups("vehiculos")
     */
    private $fechaItv;

    /**
     * @var \Dispositivos
     *
     * @ORM\ManyToOne(targetEntity="Dispositivos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dispositivo_id", referencedColumnName="id")
     * })
     */
    private $dispositivo;

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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): void
    {
        $this->foto = $foto;
    }

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): void
    {
        $this->modelo = $modelo;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): void
    {
        $this->matricula = $matricula;
    }

    public function getAnioMatriculacion(): ?int
    {
        return $this->anioMatriculacion;
    }

    public function setAnioMatriculacion(?int $anioMatriculacion): void
    {
        $this->anioMatriculacion = $anioMatriculacion;
    }

    public function getCombustible(): ?string
    {
        return $this->combustible;
    }

    public function setCombustible(?string $combustible): void
    {
        $this->combustible = $combustible;
    }

    /**
     * @return int|string|null
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * @param int|string|null $km
     */
    public function setKm($km): void
    {
        $this->km = $km;
    }

    public function getProximoMantenimiento(): ?int
    {
        return $this->proximoMantenimiento;
    }

    public function setProximoMantenimiento(?int $proximoMantenimiento): void
    {
        $this->proximoMantenimiento = $proximoMantenimiento;
    }

    public function getFechaItv(): ?\DateTime
    {
        return $this->fechaItv;
    }

    public function setFechaItv(?\DateTime $fechaItv): void
    {
        $this->fechaItv = $fechaItv;
    }

    public function getDispositivo()
    {
        return $this->dispositivo;
    }

    public function setDispositivo(\App\Entity\Dispositivos $dispositivo): void
    {
        $this->dispositivo = $dispositivo;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario(\App\Entity\Usuarios $usuario): void
    {
        $this->usuario = $usuario;
    }


}
