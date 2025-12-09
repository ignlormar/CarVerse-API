<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Vehiculos;
use App\Entity\Dispositivos;

/**
 * Viajes
 *
 * @ORM\Table(name="viajes", indexes={@ORM\Index(name="idx_viajes_dispositivo_id", columns={"dispositivo_id"}), @ORM\Index(name="idx_viajes_end_ts", columns={"end_ts"}), @ORM\Index(name="idx_viajes_start_ts", columns={"start_ts"}), @ORM\Index(name="idx_viajes_vehiculo_id", columns={"vehiculo_id"})})
 * @ORM\Entity
 */
class Viajes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("viajes")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_ts", type="datetime", nullable=false)
     * @Groups("viajes")
     */
    private $startTs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_ts", type="datetime", nullable=false)
     * @Groups("viajes")
     */
    private $endTs;

    /**
     * @var int
     *
     * @ORM\Column(name="duracion_s", type="integer", nullable=false)
     * @Groups("viajes")
     */
    private $duracionS;

    /**
     * @var int
     *
     * @ORM\Column(name="distancia_m", type="integer", nullable=false)
     * @Groups("viajes")
     */
    private $distanciaM;

    /**
     * @var float
     *
     * @ORM\Column(name="start_lat", type="float", precision=10, scale=0, nullable=false)
     * @Groups("viajes")
     */
    private $startLat;

    /**
     * @var float
     *
     * @ORM\Column(name="start_lon", type="float", precision=10, scale=0, nullable=false)
     * @Groups("viajes")
     */
    private $startLon;

    /**
     * @var float
     *
     * @ORM\Column(name="end_lat", type="float", precision=10, scale=0, nullable=false)
     * @Groups("viajes")
     */
    private $endLat;

    /**
     * @var float
     *
     * @ORM\Column(name="end_lon", type="float", precision=10, scale=0, nullable=false)
     * @Groups("viajes")
     */
    private $endLon;

    /**
     * @var float|null
     *
     * @ORM\Column(name="max_speed_kph", type="float", precision=10, scale=0, nullable=true)
     * @Groups("viajes")
     */
    private $maxSpeedKph;

    /**
     * @var float|null
     *
     * @ORM\Column(name="avg_speed_kph", type="float", precision=10, scale=0, nullable=true)
     * @Groups("viajes")
     */
    private $avgSpeedKph;

    /**
     * @var string|null
     *
     * @ORM\Column(name="route_polyline", type="text", length=65535, nullable=true)
     * @Groups("viajes")
     */
    private $routePolyline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creado_en", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     * @Groups("viajes")
     */
    private $creadoEn = 'CURRENT_TIMESTAMP';

    /**
     * @var \Vehiculos
     *
     * @ORM\ManyToOne(targetEntity="Vehiculos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id")
     * })
     */
    private $vehiculo;

    /**
     * @var \Dispositivos
     *
     * @ORM\ManyToOne(targetEntity="Dispositivos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dispositivo_id", referencedColumnName="id")
     * })
     */
    private $dispositivo;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getStartTs(): \DateTime
    {
        return $this->startTs;
    }

    public function setStartTs(\DateTime $startTs): void
    {
        $this->startTs = $startTs;
    }

    public function getEndTs(): \DateTime
    {
        return $this->endTs;
    }

    public function setEndTs(\DateTime $endTs): void
    {
        $this->endTs = $endTs;
    }

    public function getDuracionS(): int
    {
        return $this->duracionS;
    }

    public function setDuracionS(int $duracionS): void
    {
        $this->duracionS = $duracionS;
    }

    public function getDistanciaM(): int
    {
        return $this->distanciaM;
    }

    public function setDistanciaM(int $distanciaM): void
    {
        $this->distanciaM = $distanciaM;
    }

    public function getStartLat(): float
    {
        return $this->startLat;
    }

    public function setStartLat(float $startLat): void
    {
        $this->startLat = $startLat;
    }

    public function getStartLon(): float
    {
        return $this->startLon;
    }

    public function setStartLon(float $startLon): void
    {
        $this->startLon = $startLon;
    }

    public function getEndLat(): float
    {
        return $this->endLat;
    }

    public function setEndLat(float $endLat): void
    {
        $this->endLat = $endLat;
    }

    public function getEndLon(): float
    {
        return $this->endLon;
    }

    public function setEndLon(float $endLon): void
    {
        $this->endLon = $endLon;
    }

    public function getMaxSpeedKph(): ?float
    {
        return $this->maxSpeedKph;
    }

    public function setMaxSpeedKph(?float $maxSpeedKph): void
    {
        $this->maxSpeedKph = $maxSpeedKph;
    }

    public function getAvgSpeedKph(): ?float
    {
        return $this->avgSpeedKph;
    }

    public function setAvgSpeedKph(?float $avgSpeedKph): void
    {
        $this->avgSpeedKph = $avgSpeedKph;
    }

    public function getRoutePolyline(): ?string
    {
        return $this->routePolyline;
    }

    public function setRoutePolyline(?string $routePolyline): void
    {
        $this->routePolyline = $routePolyline;
    }

    /**
     * @return \DateTime|string
     */
    public function getCreadoEn()
    {
        return $this->creadoEn;
    }

    /**
     * @param \DateTime|string $creadoEn
     */
    public function setCreadoEn($creadoEn): void
    {
        $this->creadoEn = $creadoEn;
    }

    public function getVehiculo()
    {
        return $this->vehiculo;
    }

    public function setVehiculo(\App\Entity\Vehiculos $vehiculo): void
    {
        $this->vehiculo = $vehiculo;
    }

    public function getDispositivo()
    {
        return $this->dispositivo;
    }

    public function setDispositivo(\App\Entity\Dispositivos $dispositivo): void
    {
        $this->dispositivo = $dispositivo;
    }


}
