<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GarantieOr
 *
 * @ORM\Table(name="garantie_or")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\GarantieOrRepository")
 */
class GarantieOr
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="valeurAr", type="float")
     */
    private $valeurAr;

    /**
     * @var string
     *
     * @ORM\Column(name="scanKalidas", type="string", length=255,nullable=true)
     */
    private $scanKalidas;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valeurAr
     *
     * @param float $valeurAr
     *
     * @return GarantieOr
     */
    public function setValeurAr($valeurAr)
    {
        $this->valeurAr = $valeurAr;

        return $this;
    }

    /**
     * Get valeurAr
     *
     * @return float
     */
    public function getValeurAr()
    {
        return $this->valeurAr;
    }

    /**
     * Set scanKalidas
     *
     * @param string $scanKalidas
     *
     * @return GarantieOr
     */
    public function setScanKalidas($scanKalidas)
    {
        $this->scanKalidas = $scanKalidas;

        return $this;
    }

    /**
     * Get scanKalidas
     *
     * @return string
     */
    public function getScanKalidas()
    {
        return $this->scanKalidas;
    }
}
