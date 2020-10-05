<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="etat")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\EtatRepository")
 */
class Etat
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
     * @ORM\Column(name="nomEtat", type="string", length=255, nullable=true)
     */
    private $nomEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="motifFrontRefuser", type="string", length=255, nullable=true)
     */
    private $motifFrontRefuser;

    /**
     * @var string
     *
     * @ORM\Column(name="motifBackRefuser", type="string", length=255, nullable=true)
     */
    private $motifBackRefuser;

    /**
     * @var string
     *
     * @ORM\Column(name="motifAccepter", type="string", length=255, nullable=true)
     */
    private $motifAccepter;
    /**
     * @var string
     *
     * @ORM\Column(name="verification", type="string", length=255, nullable=true)
     */
    private $verification;

    //    ---------------RELATION---------------

    /**
     * @ORM\OneToOne(targetEntity="DemandeQhBundle\Entity\DemandeQh")
     * @ORM\JoinColumn(nullable=true)
     */
    private $demadeQH;

//    ---------------//////RELATION//////---------------

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
     * Set nomEtat
     *
     * @param string $nomEtat
     *
     * @return Etat
     */
    public function setNomEtat($nomEtat)
    {
        $this->nomEtat = $nomEtat;

        return $this;
    }

    /**
     * Get nomEtat
     *
     * @return string
     */
    public function getNomEtat()
    {
        return $this->nomEtat;
    }

    /**
     * Set motifFrontRefuser
     *
     * @param string $motifFrontRefuser
     *
     * @return Etat
     */
    public function setMotifFrontRefuser($motifFrontRefuser)
    {
        $this->motifFrontRefuser = $motifFrontRefuser;

        return $this;
    }

    /**
     * Get motifFrontRefuser
     *
     * @return string
     */
    public function getMotifFrontRefuser()
    {
        return $this->motifFrontRefuser;
    }

    /**
     * Set motifBackRefuser
     *
     * @param string $motifBackRefuser
     *
     * @return Etat
     */
    public function setMotifBackRefuser($motifBackRefuser)
    {
        $this->motifBackRefuser = $motifBackRefuser;

        return $this;
    }

    /**
     * Get motifBackRefuser
     *
     * @return string
     */
    public function getMotifBackRefuser()
    {
        return $this->motifBackRefuser;
    }

    /**
     * Set motifAccepter
     *
     * @param string $motifAccepter
     *
     * @return Etat
     */
    public function setMotifAccepter($motifAccepter)
    {
        $this->motifAccepter = $motifAccepter;

        return $this;
    }

    /**
     * Get motifAccepter
     *
     * @return string
     */
    public function getMotifAccepter()
    {
        return $this->motifAccepter;
    }

    /**
     * Set demadeQH
     *
     * @param \DemandeQhBundle\Entity\DemandeQh $demadeQH
     *
     * @return Etat
     */
    public function setDemadeQH(\DemandeQhBundle\Entity\DemandeQh $demadeQH = null)
    {
        $this->demadeQH = $demadeQH;

        return $this;
    }

    /**
     * Get demadeQH
     *
     * @return \DemandeQhBundle\Entity\DemandeQh
     */
    public function getDemadeQH()
    {
        return $this->demadeQH;
    }

    /**
     * Set verification
     *
     * @param string $verification
     *
     * @return Etat
     */
    public function setVerification($verification)
    {
        $this->verification = $verification;

        return $this;
    }

    /**
     * Get verification
     *
     * @return string
     */
    public function getVerification()
    {
        return $this->verification;
    }
}
