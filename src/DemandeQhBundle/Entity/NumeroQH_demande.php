<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NumeroQH_demande
 *
 * @ORM\Table(name="numero_q_h_demande")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\NumeroQH_demandeRepository")
 */
class NumeroQH_demande
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
     * @var int
     *
     * @ORM\Column(name="intnumeroQH", type="integer")
     */
    private $intnumeroQH;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroQH", type="string", length=255)
     */
    private $numeroQH;

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
     * Set intnumeroQH
     *
     * @param integer $intnumeroQH
     *
     * @return NumeroQH_demande
     */
    public function setIntnumeroQH($intnumeroQH)
    {
        $this->intnumeroQH = $intnumeroQH;

        return $this;
    }

    /**
     * Get intnumeroQH
     *
     * @return int
     */
    public function getIntnumeroQH()
    {
        return $this->intnumeroQH;
    }

    /**
     * Set numeroQH
     *
     * @param string $numeroQH
     *
     * @return NumeroQH_demande
     */
    public function setNumeroQH($numeroQH)
    {
        $this->numeroQH = $numeroQH;

        return $this;
    }

    /**
     * Get numeroQH
     *
     * @return string
     */
    public function getNumeroQH()
    {
        return $this->numeroQH;
    }

}
