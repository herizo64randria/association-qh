<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Versement
 *
 * @ORM\Table(name="versement")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\VersementRepository")
 */
class Versement
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
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;
    /**
     * @var array
     *
     * @ORM\Column(name="BorderauUrl", type="array", nullable=true)
     */
    private $borderauUrl;
    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    private $etat;
    /**
     * @var string
     *
     * @ORM\Column(name="paiement", type="string", length=255, nullable=true)
     */
    private $paiement;
    /**
     * @var string
     *
     * @ORM\Column(name="paiementAdmin", type="string", length=255, nullable=true)
     */
    private $paiementAdmin;
//    ---------------RELATION---------------

    /**
     * @ORM\ManyToOne(targetEntity="PaieBundle\Entity\Compte_Hussen")
     * @ORM\JoinColumn(nullable=true)
     */
    private $compteHussen;

    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne")
     * @ORM\JoinColumn(nullable=true)
     */
    private $personne;
    /**
     * @ORM\ManyToOne(targetEntity="CompteGroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=true)
     */
    private $groupe;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCreer;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userConfirme;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userRefuse;
    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Cheque_Versement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $chequeVersement;
    /**
     * @ORM\ManyToOne(targetEntity="PaieBundle\Entity\Procuration",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $procuration;
    /**
     * @ORM\OneToOne(targetEntity="BackBundle\Entity\notif",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $notif;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Versement
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
     * Set montant
     *
     * @param float $montant
     *
     * @return Versement
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
     * Set compteHussen
     *
     * @param \PaieBundle\Entity\Compte_Hussen $compteHussen
     *
     * @return Versement
     */
    public function setCompteHussen(\PaieBundle\Entity\Compte_Hussen $compteHussen = null)
    {
        $this->compteHussen = $compteHussen;

        return $this;
    }

    /**
     * Get compteHussen
     *
     * @return \PaieBundle\Entity\Compte_Hussen
     */
    public function getCompteHussen()
    {
        return $this->compteHussen;
    }

    /**
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return Versement
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
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return Versement
     */
    public function setUserCreer(\UserBundle\Entity\User $userCreer = null)
    {
        $this->userCreer = $userCreer;

        return $this;
    }

    /**
     * Get userCreer
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserCreer()
    {
        return $this->userCreer;
    }



    /**
     * Set userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return Versement
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

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Versement
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set userRefuse
     *
     * @param \UserBundle\Entity\User $userRefuse
     *
     * @return Versement
     */
    public function setUserRefuse(\UserBundle\Entity\User $userRefuse = null)
    {
        $this->userRefuse = $userRefuse;

        return $this;
    }

    /**
     * Get userRefuse
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserRefuse()
    {
        return $this->userRefuse;
    }

    /**
     * Set groupe
     *
     * @param \CompteGroupeBundle\Entity\Groupe $groupe
     *
     * @return Versement
     */
    public function setGroupe(\CompteGroupeBundle\Entity\Groupe $groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \CompteGroupeBundle\Entity\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set borderauUrl
     *
     * @param array $borderauUrl
     *
     * @return Versement
     */
    public function setBorderauUrl($borderauUrl)
    {
        $this->borderauUrl = $borderauUrl;

        return $this;
    }

    /**
     * Get borderauUrl
     *
     * @return array
     */
    public function getBorderauUrl()
    {
        return $this->borderauUrl;
    }

    /**
     * Set paiement
     *
     * @param string $paiement
     *
     * @return Versement
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
     * Set paiementAdmin
     *
     * @param string $paiementAdmin
     *
     * @return Versement
     */
    public function setPaiementAdmin($paiementAdmin)
    {
        $this->paiementAdmin = $paiementAdmin;

        return $this;
    }

    /**
     * Get paiementAdmin
     *
     * @return string
     */
    public function getPaiementAdmin()
    {
        return $this->paiementAdmin;
    }

    /**
     * Set chequeVersement
     *
     * @param \PaieBundle\Entity\Cheque_Versement $chequeVersement
     *
     * @return Versement
     */
    public function setChequeVersement(\PaieBundle\Entity\Cheque_Versement $chequeVersement = null)
    {
        $this->chequeVersement = $chequeVersement;

        return $this;
    }

    /**
     * Get chequeVersement
     *
     * @return \PaieBundle\Entity\Cheque_Versement
     */
    public function getChequeVersement()
    {
        return $this->chequeVersement;
    }

    /**
     * Set procuration
     *
     * @param \PaieBundle\Entity\Procuration $procuration
     *
     * @return Versement
     */
    public function setProcuration(\PaieBundle\Entity\Procuration $procuration = null)
    {
        $this->procuration = $procuration;

        return $this;
    }

    /**
     * Get procuration
     *
     * @return \PaieBundle\Entity\Procuration
     */
    public function getProcuration()
    {
        return $this->procuration;
    }

    /**
     * Set notif
     *
     * @param \BackBundle\Entity\notif $notif
     *
     * @return Versement
     */
    public function setNotif(\BackBundle\Entity\notif $notif = null)
    {
        $this->notif = $notif;

        return $this;
    }

    /**
     * Get notif
     *
     * @return \BackBundle\Entity\notif
     */
    public function getNotif()
    {
        return $this->notif;
    }
}
