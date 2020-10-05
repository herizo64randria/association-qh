<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation")
 * @ORM\Entity(repositoryClass="FrontBundle\Repository\InvitationRepository")
 */
class Invitation
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
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean")
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

//---------------Relation---------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCreer;
    /**
     * @ORM\manyToOne(targetEntity="PersonneBundle\Entity\Personne",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $userInviter;
//---------------Fin Relation-----------------------------
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
     * @return Invitation
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
     * Set type
     *
     * @param string $type
     *
     * @return Invitation
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
     * Set etat
     *
     * @param boolean $etat
     *
     * @return Invitation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return bool
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Invitation
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
     * Set userCreer
     *
     * @param \PersonneBundle\Entity\Personne $userCreer
     *
     * @return Invitation
     */
    public function setUserCreer(\PersonneBundle\Entity\Personne $userCreer = null)
    {
        $this->userCreer = $userCreer;

        return $this;
    }

    /**
     * Get userCreer
     *
     * @return \PersonneBundle\Entity\Personne
     */
    public function getUserCreer()
    {
        return $this->userCreer;
    }

    /**
     * Set userInviter
     *
     * @param \PersonneBundle\Entity\Personne $userInviter
     *
     * @return Invitation
     */
    public function setUserInviter(\PersonneBundle\Entity\Personne $userInviter = null)
    {
        $this->userInviter = $userInviter;

        return $this;
    }

    /**
     * Get userInviter
     *
     * @return \PersonneBundle\Entity\Personne
     */
    public function getUserInviter()
    {
        return $this->userInviter;
    }

    /**
     * Set notif
     *
     * @param \BackBundle\Entity\notif $notif
     *
     * @return Invitation
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
