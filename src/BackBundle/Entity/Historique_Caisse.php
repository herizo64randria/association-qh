<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique_Caisse
 *
 * @ORM\Table(name="historique__caisse")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\Historique_CaisseRepository")
 */
class Historique_Caisse
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="paiement", type="string", length=255, nullable=true)
     */
    private $paiement;
    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;
    /**
     * @var string
     *
     * @ORM\Column(name="modif", type="boolean", length=255, nullable=true)
     */
    private $modif;
    public function __construct()
    {

        $this->setModif(false);
    }
    //--------------RELATION--------------------

    /**
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Compte_Caisse",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $compteCaisse;
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
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Cheque_Versement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $cheque;
    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Cheque_Remboursement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $cheque1;

    //------------FIN RELATION-------------------
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Historique_Caisse
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
     * @return Historique_Caisse
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
     * @return Historique_Caisse
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
     * @return Historique_Caisse
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
     * Set paiement
     *
     * @param string $paiement
     *
     * @return Historique_Caisse
     */
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;

        return $this;
    }

    /**
     * Get paiement
     *
     * @return string
     */
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * Set compteCaisse
     *
     * @param \BackBundle\Entity\Compte_Caisse $compteCaisse
     *
     * @return Historique_Caisse
     */
    public function setCompteCaisse(\BackBundle\Entity\Compte_Caisse $compteCaisse)
    {
        $this->compteCaisse = $compteCaisse;

        return $this;
    }

    /**
     * Get compteCaisse
     *
     * @return \BackBundle\Entity\Compte_Caisse
     */
    public function getCompteCaisse()
    {
        return $this->compteCaisse;
    }

    /**
     * Set versement
     *
     * @param \PaieBundle\Entity\Versement $versement
     *
     * @return Historique_Caisse
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
     * @return Historique_Caisse
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
     * @param \PaieBundle\Entity\Cheque_Versement $cheque
     *
     * @return Historique_Caisse
     */
    public function setCheque(\PaieBundle\Entity\Cheque_Versement $cheque = null)
    {
        $this->cheque = $cheque;

        return $this;
    }

    /**
     * Get cheque
     *
     * @return \PaieBundle\Entity\Cheque_Versement
     */
    public function getCheque()
    {
        return $this->cheque;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Historique_Caisse
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set cheque1
     *
     * @param \PaieBundle\Entity\Cheque_Remboursement $cheque1
     *
     * @return Historique_Caisse
     */
    public function setCheque1(\PaieBundle\Entity\Cheque_Remboursement $cheque1 = null)
    {
        $this->cheque1 = $cheque1;

        return $this;
    }

    /**
     * Get cheque1
     *
     * @return \PaieBundle\Entity\Cheque_Remboursement
     */
    public function getCheque1()
    {
        return $this->cheque1;
    }

    /**
     * Set modif
     *
     * @param boolean $modif
     *
     * @return Historique_Caisse
     */
    public function setModif($modif)
    {
        $this->modif = $modif;

        return $this;
    }

    /**
     * Get modif
     *
     * @return boolean
     */
    public function getModif()
    {
        return $this->modif;
    }
}
