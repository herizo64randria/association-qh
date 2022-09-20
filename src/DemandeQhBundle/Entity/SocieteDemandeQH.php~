<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocieteDemandeQH
 *
 * @ORM\Table(name="societe_demande_q_h")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\SocieteDemandeQHRepository")
 */
class SocieteDemandeQH
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
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedemande", type="datetime", nullable=true)
     */
    private $datedemande;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateenvoyer", type="datetime", nullable=true)
     */
    private $dateenvoie;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", nullable=true)
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="nombremois", type="integer", nullable=true)
     */
    private $nombremois;

    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="string", length=255, nullable=true)
     */
    private $motif;

    /**
     * @var string
     *
     * @ORM\Column(name="societe", type="string", length=255, nullable=true)
     */
    private $societe;

    /**
     * @var string
     *
     * @ORM\Column(name="siege", type="string", length=255, nullable=true)
     */
    private $siege;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;

    //    ---------------//////RELATION//////---------------
    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $personne;
    /**
     * @ORM\OneToOne(targetEntity="DemandeQhBundle\Entity\EtatSociete")
     * @ORM\JoinColumn(nullable=true)
     */
    private $etat;


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
     * @return SocieteDemandeQH
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
     * Set datedemande
     *
     * @param \DateTime $datedemande
     *
     * @return SocieteDemandeQH
     */
    public function setDatedemande($datedemande)
    {
        $this->datedemande = $datedemande;

        return $this;
    }

    /**
     * Get datedemande
     *
     * @return \DateTime
     */
    public function getDatedemande()
    {
        return $this->datedemande;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return SocieteDemandeQH
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
     * Set nombremois
     *
     * @param integer $nombremois
     *
     * @return SocieteDemandeQH
     */
    public function setNombremois($nombremois)
    {
        $this->nombremois = $nombremois;

        return $this;
    }

    /**
     * Get nombremois
     *
     * @return int
     */
    public function getNombremois()
    {
        return $this->nombremois;
    }

    /**
     * Set motif
     *
     * @param string $motif
     *
     * @return SocieteDemandeQH
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif
     *
     * @return string
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * Set societe
     *
     * @param string $societe
     *
     * @return SocieteDemandeQH
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set siege
     *
     * @param string $siege
     *
     * @return SocieteDemandeQH
     */
    public function setSiege($siege)
    {
        $this->siege = $siege;

        return $this;
    }

    /**
     * Get siege
     *
     * @return string
     */
    public function getSiege()
    {
        return $this->siege;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return SocieteDemandeQH
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set etat
     *
     * @param \DemandeQhBundle\Entity\EtatSociete $etat
     *
     * @return SocieteDemandeQH
     */
    public function setEtat(\DemandeQhBundle\Entity\EtatSociete $etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \DemandeQhBundle\Entity\EtatSociete
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return SocieteDemandeQH
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
     * Set dateenvoie
     *
     * @param \DateTime $dateenvoie
     *
     * @return SocieteDemandeQH
     */
    public function setDateenvoie($dateenvoie)
    {
        $this->dateenvoie = $dateenvoie;

        return $this;
    }

    /**
     * Get dateenvoie
     *
     * @return \DateTime
     */
    public function getDateenvoie()
    {
        return $this->dateenvoie;
    }
}
