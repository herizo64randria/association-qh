<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Numero_demande
 *
 * @ORM\Table(name="numero_demande")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\Numero_demandeRepository")
 */
class Numero_demande
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
     * @var string
     *
     * @ORM\Column(name="numeroDemande", type="string", length=255)
     */
    private $numeroDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="non_config", type="string", length=50)
     */
    private $nonConfig;


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
     * Set numeroDemande
     *
     * @param string $numeroDemande
     *
     * @return Numero_demande
     */
    public function setNumeroDemande($numeroDemande)
    {
        $this->numeroDemande = $numeroDemande;

        return $this;
    }

    /**
     * Get numeroDemande
     *
     * @return string
     */
    public function getNumeroDemande()
    {
        return $this->numeroDemande;
    }

    /**
     * Set nonConfig
     *
     * @param string $nonConfig
     *
     * @return Numero_demande
     */
    public function setNonConfig($nonConfig)
    {
        $this->nonConfig = $nonConfig;

        return $this;
    }

    /**
     * Get nonConfig
     *
     * @return string
     */
    public function getNonConfig()
    {
        return $this->nonConfig;
    }
}

