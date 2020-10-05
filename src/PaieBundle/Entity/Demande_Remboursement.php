<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande_Remboursement
 *
 * @ORM\Table(name="demande__remboursement")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\Demande_RemboursementRepository")
 */
class Demande_Remboursement
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
     * @ORM\Column(name="numero", type="string", length=50, unique=true)
     */
    private $numero;

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
     * @var bool
     *
     * @ORM\Column(name="type_cheque", type="boolean")
     */
    private $typeCheque;
    /**
     * @var string
     *
     * @ORM\Column(name="paiement", type="string", length=250)
     */
    private $paiement;
    /**
     * @var string
     *
     * @ORM\Column(name="paiementadmin", type="string", length=250, nullable=true)
     */
    private $paiementadmin;
    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=250)
     */
    private $etat;


//    ---------------RELATION---------------
    /**
     * @ORM\OneToOne(targetEntity="BackBundle\Entity\notif",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $notif;
    /**
     * @ORM\ManyToOne(targetEntity="CompteGroupeBundle\Entity\Groupe")
     * @ORM\JoinColumn(nullable=true)
     */
    private $groupe;
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCreer;

    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne")
     * @ORM\JoinColumn(nullable=true)
     */
    private $personne;

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
     * @return Demande_Remboursement
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Demande_Remboursement
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
     * @return Demande_Remboursement
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
     * Set typeCheque
     *
     * @param boolean $typeCheque
     *
     * @return Demande_Remboursement
     */
    public function setTypeCheque($typeCheque)
    {
        $this->typeCheque = $typeCheque;

        return $this;
    }

    /**
     * Get typeCheque
     *
     * @return boolean
     */
    public function getTypeCheque()
    {
        return $this->typeCheque;
    }

    /**
     * Set userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return Demande_Remboursement
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
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return Demande_Remboursement
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
     * Set etat
     *
     * @param string $etat
     *
     * @return Demande_Remboursement
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
     * Set userRefuser
     *
     * @param \UserBundle\Entity\User $userRefuser
     *
     * @return Demande_Remboursement
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
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return Demande_Remboursement
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
     * Set groupe
     *
     * @param \CompteGroupeBundle\Entity\Groupe $groupe
     *
     * @return Demande_Remboursement
     */
    public function setGroupe(\CompteGroupeBundle\Entity\Groupe $groupe = null)
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
     * Set notif
     *
     * @param \BackBundle\Entity\notif $notif
     *
     * @return Demande_Remboursement
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

    /**
     * Set paiement
     *
     * @param string $paiement
     *
     * @return Demande_Remboursement
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
     * Set paiementadmin
     *
     * @param string $paiementadmin
     *
     * @return Demande_Remboursement
     */
    public function setPaiementadmin($paiementadmin)
    {
        $this->paiementadmin = $paiementadmin;

        return $this;
    }

    /**
     * Get paiementadmin
     *
     * @return string
     */
    public function getPaiementadmin()
    {
        return $this->paiementadmin;
    }
}
