<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique_Paie
 *
 * @ORM\Table(name="historique__paie")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\Historique_PaieRepository")
 */
class Historique_Paie
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var array
     *
     * @ORM\Column(name="modification", type="array", nullable=true)
     */
    private $test_modification;

    //--------------RELATION--------------------

    /**
     * @ORM\ManyToOne(targetEntity="PaieBundle\Entity\Compte_Paie",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $comptePaie;

    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Demande_Remboursement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $demandeReboursement;

    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Versement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $versement;

    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Remboursement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $remboursement;


    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Cheque_Remboursement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $cheque;


    //--------------/////RELATION/////--------------------

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
     * Set comptePaie
     *
     * @param \PaieBundle\Entity\Compte_Paie $comptePaie
     *
     * @return Historique_Paie
     */
    public function setComptePaie(\PaieBundle\Entity\Compte_Paie $comptePaie)
    {
        $this->comptePaie = $comptePaie;

        return $this;
    }

    /**
     * Get comptePaie
     *
     * @return \PaieBundle\Entity\Compte_Paie
     */
    public function getComptePaie()
    {
        return $this->comptePaie;
    }

    /**
     * Set demandeReboursement
     *
     * @param \PaieBundle\Entity\Demande_Remboursement $demandeReboursement
     *
     * @return Historique_Paie
     */
    public function setDemandeReboursement(\PaieBundle\Entity\Demande_Remboursement $demandeReboursement = null)
    {
        $this->demandeReboursement = $demandeReboursement;

        return $this;
    }

    /**
     * Get demandeReboursement
     *
     * @return \PaieBundle\Entity\Demande_Remboursement
     */
    public function getDemandeReboursement()
    {
        return $this->demandeReboursement;
    }

    /**
     * Set versement
     *
     * @param \PaieBundle\Entity\Versement $versement
     *
     * @return Historique_Paie
     */
    public function setVersement(\PaieBundle\Entity\Versement $versement = null)
    {
        $this->versement = $versement;

        return $this;
    }

    /**
     * Get versement
     *
     * @return \PaieBundle\Entity\Versement
     */
    public function getVersement()
    {
        return $this->versement;
    }

    /**
     * Set remboursement
     *
     * @param \PaieBundle\Entity\Remboursement $remboursement
     *
     * @return Historique_Paie
     */
    public function setRemboursement(\PaieBundle\Entity\Remboursement $remboursement = null)
    {
        $this->remboursement = $remboursement;

        return $this;
    }

    /**
     * Get remboursement
     *
     * @return \PaieBundle\Entity\Remboursement
     */
    public function getRemboursement()
    {
        return $this->remboursement;
    }

    /**
     * Set cheque
     *
     * @param \PaieBundle\Entity\Cheque_Remboursement $cheque
     *
     * @return Historique_Paie
     */
    public function setCheque(\PaieBundle\Entity\Cheque_Remboursement $cheque)
    {
        $this->cheque = $cheque;

        return $this;
    }

    /**
     * Get cheque
     *
     * @return \PaieBundle\Entity\Cheque_Remboursement
     */
    public function getCheque()
    {
        return $this->cheque;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Historique_Paie
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Historique_Paie
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Historique_Paie
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Historique_Paie
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
     * Set testModification
     *
     * @param array $testModification
     *
     * @return Historique_Paie
     */
    public function setTestModification($testModification)
    {
        $this->test_modification = $testModification;

        return $this;
    }

    /**
     * Get testModification
     *
     * @return array
     */
    public function getTestModification()
    {
        return $this->test_modification;
    }
}
