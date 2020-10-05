<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeQh
 *
 * @ORM\Table(name="demande_qh")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\DemandeQhRepository")
 */
class DemandeQh
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
     * @ORM\Column(name="numero", type="string", length=50, nullable=true)
     */
    private $numero;


    /**
     * @var string
     *
     * @ORM\Column(name="siAncienDemande", type="string")
     */
    private $siAncienDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="siAncienDemandeEtat", type="string", nullable=true)
     */
    private $siAncienDemandeEtat;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;
    /**
     * @var int
     *
     * @ORM\Column(name="annee1", type="integer",nullable=true)
     */
    private $annee1;
    /**
     * @var float
     *
     * @ORM\Column(name="montant1", type="float",nullable=true)
     */
    private $montant1;
    /**
     * @var int
     *
     * @ORM\Column(name="annee2", type="integer",nullable=true)
     */
    private $annee2;
    /**
     * @var float
     *
     * @ORM\Column(name="montant2", type="float",nullable=true)
     */
    private $montant2;
    /**
     * @var int
     *
     * @ORM\Column(name="annee3", type="integer",nullable=true)
     */
    private $annee3;
    /**
     * @var float
     *
     * @ORM\Column(name="montant3", type="float",nullable=true)
     */
    private $montant3;
    /**
     * @var int
     *
     * @ORM\Column(name="nombreMois", type="integer")
     */
    private $nombreMois;

    /**
     * @var string
     *
     * @ORM\Column(name="typeMotif", type="string", length=100)
     */
    private $typeMotif;

    /**
     * @var string
     *
     * @ORM\Column(name="detailMotif", type="text", nullable=true)
     */
    private $detailMotif;


//    ---------------RELATION---------------

    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userConfirme;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userRefuser;

    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\Garant")
     * @ORM\JoinColumn(nullable=true)
     */
    private $garant1;
    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\Garant")
     * @ORM\JoinColumn(nullable=true)
     */
    private $garant2;
    /**
     * @ORM\OneToOne(targetEntity="DemandeQhBundle\Entity\GarantieOr")
     * @ORM\JoinColumn(nullable=true)
     */
    private $garantieOR;

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
     * Set numero
     *
     * @param string $numero
     *
     * @return DemandeQh
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set siAncienDemande
     *
     * @param boolean $siAncienDemande
     *
     * @return DemandeQh
     */
    public function setSiAncienDemande($siAncienDemande)
    {
        $this->siAncienDemande = $siAncienDemande;

        return $this;
    }

    /**
     * Get siAncienDemande
     *
     * @return bool
     */
    public function getSiAncienDemande()
    {
        return $this->siAncienDemande;
    }

    /**
     * Set siAncienDemandeEtat
     *
     * @param boolean $siAncienDemandeEtat
     *
     * @return DemandeQh
     */
    public function setSiAncienDemandeEtat($siAncienDemandeEtat)
    {
        $this->siAncienDemandeEtat = $siAncienDemandeEtat;

        return $this;
    }

    /**
     * Get siAncienDemandeEtat
     *
     * @return bool
     */
    public function getSiAncienDemandeEtat()
    {
        return $this->siAncienDemandeEtat;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return DemandeQh
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set nombreMois
     *
     * @param integer $nombreMois
     *
     * @return DemandeQh
     */
    public function setNombreMois($nombreMois)
    {
        $this->nombreMois = $nombreMois;

        return $this;
    }

    /**
     * Get nombreMois
     *
     * @return int
     */
    public function getNombreMois()
    {
        return $this->nombreMois;
    }

    /**
     * Set typeMotif
     *
     * @param string $typeMotif
     *
     * @return DemandeQh
     */
    public function setTypeMotif($typeMotif)
    {
        $this->typeMotif = $typeMotif;

        return $this;
    }

    /**
     * Get typeMotif
     *
     * @return string
     */
    public function getTypeMotif()
    {
        return $this->typeMotif;
    }

    /**
     * Set detailMotif
     *
     * @param string $detailMotif
     *
     * @return DemandeQh
     */
    public function setDetailMotif($detailMotif)
    {
        $this->detailMotif = $detailMotif;

        return $this;
    }

    /**
     * Get detailMotif
     *
     * @return string
     */
    public function getDetailMotif()
    {
        return $this->detailMotif;
    }

    /**
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return DemandeQh
     */
    public function setPersonne(\PersonneBundle\Entity\Personne $personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \PersonneBundle\Entity\Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }



    /**
     * Set garant1
     *
     * @param \DemandeQhBundle\Entity\Garant $garant1
     *
     * @return DemandeQh
     */
    public function setGarant1(\DemandeQhBundle\Entity\Garant $garant1 = null)
    {
        $this->garant1 = $garant1;

        return $this;
    }

    /**
     * Get garant1
     *
     * @return \DemandeQhBundle\Entity\Garant
     */
    public function getGarant1()
    {
        return $this->garant1;
    }

    /**
     * Set garant2
     *
     * @param \DemandeQhBundle\Entity\Garant $garant2
     *
     * @return DemandeQh
     */
    public function setGarant2(\DemandeQhBundle\Entity\Garant $garant2 = null)
    {
        $this->garant2 = $garant2;

        return $this;
    }

    /**
     * Get garant2
     *
     * @return \DemandeQhBundle\Entity\Garant
     */
    public function getGarant2()
    {
        return $this->garant2;
    }

    /**
     * Set garantieOR
     *
     * @param \DemandeQhBundle\Entity\GarantieOr $garantieOR
     *
     * @return DemandeQh
     */
    public function setGarantieOR(\DemandeQhBundle\Entity\GarantieOr $garantieOR = null)
    {
        $this->garantieOR = $garantieOR;

        return $this;
    }

    /**
     * Get garantieOR
     *
     * @return \DemandeQhBundle\Entity\GarantieOr
     */
    public function getGarantieOR()
    {
        return $this->garantieOR;
    }



    /**
     * Set annee1
     *
     * @param integer $annee1
     *
     * @return DemandeQh
     */
    public function setAnnee1($annee1)
    {
        $this->annee1 = $annee1;

        return $this;
    }

    /**
     * Get annee1
     *
     * @return integer
     */
    public function getAnnee1()
    {
        return $this->annee1;
    }

    /**
     * Set montant1
     *
     * @param float $montant1
     *
     * @return DemandeQh
     */
    public function setMontant1($montant1)
    {
        $this->montant1 = $montant1;

        return $this;
    }

    /**
     * Get montant1
     *
     * @return float
     */
    public function getMontant1()
    {
        return $this->montant1;
    }

    /**
     * Set annee2
     *
     * @param integer $annee2
     *
     * @return DemandeQh
     */
    public function setAnnee2($annee2)
    {
        $this->annee2 = $annee2;

        return $this;
    }

    /**
     * Get annee2
     *
     * @return integer
     */
    public function getAnnee2()
    {
        return $this->annee2;
    }

    /**
     * Set montant2
     *
     * @param float $montant2
     *
     * @return DemandeQh
     */
    public function setMontant2($montant2)
    {
        $this->montant2 = $montant2;

        return $this;
    }

    /**
     * Get montant2
     *
     * @return float
     */
    public function getMontant2()
    {
        return $this->montant2;
    }

    /**
     * Set annee3
     *
     * @param integer $annee3
     *
     * @return DemandeQh
     */
    public function setAnnee3($annee3)
    {
        $this->annee3 = $annee3;

        return $this;
    }

    /**
     * Get annee3
     *
     * @return integer
     */
    public function getAnnee3()
    {
        return $this->annee3;
    }

    /**
     * Set montant3
     *
     * @param float $montant3
     *
     * @return DemandeQh
     */
    public function setMontant3($montant3)
    {
        $this->montant3 = $montant3;

        return $this;
    }

    /**
     * Get montant3
     *
     * @return float
     */
    public function getMontant3()
    {
        return $this->montant3;
    }

    /**
     * Set userRefuser
     *
     * @param \UserBundle\Entity\User $userRefuser
     *
     * @return DemandeQh
     */
    public function setUserRefuser(\UserBundle\Entity\User $userRefuser = null)
    {
        $this->userRefuser = $userRefuser;

        return $this;
    }

    /**
     * Get userRefuser
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserRefuser()
    {
        return $this->userRefuser;
    }

    /**
     * Set userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return DemandeQh
     */
    public function setUserConfirme(\UserBundle\Entity\User $userConfirme = null)
    {
        $this->userConfirme = $userConfirme;

        return $this;
    }

    /**
     * Get userConfirme
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserConfirme()
    {
        return $this->userConfirme;
    }
}
