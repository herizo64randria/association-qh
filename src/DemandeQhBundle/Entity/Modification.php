<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modification
 *
 * @ORM\Table(name="modification")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\ModificationRepository")
 */
class Modification
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
     * @ORM\Column(name="dossier", type="string", length=255, nullable=true)
     */
    private $dossier;

    /**
     * @var string
     *
     * @ORM\Column(name="formulaire", type="string", length=255, nullable=true)
     */
    private $formulaire;

    /**
     * @var string
     *
     * @ORM\Column(name="notif", type="string", length=255, nullable=true)
     */
    private $notif;
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
     */
    private $message;
    //    ---------------RELATION---------------

    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\Etat")
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
     * Set dossier
     *
     * @param string $dossier
     *
     * @return Modification
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return string
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set formulaire
     *
     * @param string $formulaire
     *
     * @return Modification
     */
    public function setFormulaire($formulaire)
    {
        $this->formulaire = $formulaire;

        return $this;
    }

    /**
     * Get formulaire
     *
     * @return string
     */
    public function getFormulaire()
    {
        return $this->formulaire;
    }

    /**
     * Set notif
     *
     * @param string $notif
     *
     * @return Modification
     */
    public function setNotif($notif)
    {
        $this->notif = $notif;

        return $this;
    }

    /**
     * Get notif
     *
     * @return string
     */
    public function getNotif()
    {
        return $this->notif;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Modification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set etat
     *
     * @param \DemandeQhBundle\Entity\Etat $etat
     *
     * @return Modification
     */
    public function setEtat(\DemandeQhBundle\Entity\Etat $etat = null)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \DemandeQhBundle\Entity\Etat
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
