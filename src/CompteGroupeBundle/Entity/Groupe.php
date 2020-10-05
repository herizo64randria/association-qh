<?php

namespace CompteGroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="CompteGroupeBundle\Repository\GroupeRepository")
 */
class Groupe
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
     * @ORM\Column(name="datecreer", type="datetime")
     */
    private $datecreer;
    /**
     * @var string
     *
     * @ORM\Column(name="nomgroup", type="string", length=255)
     */
    private $nomgroup;
    
//    ---------------RELATION---------------

    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Compte_Paie",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $comptePaie;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCreer;

//    ---------------RELATION---------------

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

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
     * Set nomgroup
     *
     * @param string $nomgroup
     *
     * @return Groupe
     */
    public function setNomgroup($nomgroup)
    {
        $this->nomgroup = $nomgroup;

        return $this;
    }

    /**
     * Get nomgroup
     *
     * @return string
     */
    public function getNomgroup()
    {
        return $this->nomgroup;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Groupe
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Groupe
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set datecreer
     *
     * @param \DateTime $datecreer
     *
     * @return Groupe
     */
    public function setDatecreer($datecreer)
    {
        $this->datecreer = $datecreer;

        return $this;
    }

    /**
     * Get datecreer
     *
     * @return \DateTime
     */
    public function getDatecreer()
    {
        return $this->datecreer;
    }

    /**
     * Set comptePaie
     *
     * @param \PaieBundle\Entity\Compte_Paie $comptePaie
     *
     * @return Groupe
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
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return Groupe
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
}
