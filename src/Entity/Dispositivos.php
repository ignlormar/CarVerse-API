<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Dispositivos
 *
 * @ORM\Table(name="dispositivos", uniqueConstraints={@ORM\UniqueConstraint(name="imei", columns={"imei"}), @ORM\UniqueConstraint(name="flespi_id", columns={"flespi_id"})})
 * @ORM\Entity
 */
class Dispositivos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("dispositvos")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="imei", type="string", length=50, nullable=false)
     * @Groups("dispositvos")
     */
    private $imei;

    /**
     * @var int
     *
     * @ORM\Column(name="flespi_id", type="bigint", nullable=false)
     * @Groups("dispositvos")
     */
    private $flespiId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     * @Groups("dispositvos")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     * @Groups("dispositvos")
     */
    private $fechaAlta = 'CURRENT_TIMESTAMP';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getImei(): string
    {
        return $this->imei;
    }

    public function setImei(string $imei): void
    {
        $this->imei = $imei;
    }

    public function getFlespiId(): int
    {
        return $this->flespiId;
    }

    public function setFlespiId(int $flespiId): void
    {
        $this->flespiId = $flespiId;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return \DateTime|string
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * @param \DateTime|string $fechaAlta
     */
    public function setFechaAlta($fechaAlta): void
    {
        $this->fechaAlta = $fechaAlta;
    }


}
