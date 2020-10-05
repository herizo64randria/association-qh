<?php

namespace CompteGroupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membre
 *
 * @ORM\Table(name="membre")
 * @ORM\Entity(repositoryClass="CompteGroupeBundle\Repository\MembreRepository")
 */
class Membre
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
     * @ORM\Column(name="datemembre", type="datetime")
     */
    private $datemembre;

//    ---------------//////RELATION//////---------------

    /**
     * @ORM\ManyToOne(targetEntity="CompteGroupeBundle\Entity\Groupe",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $groupe;
    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne",
    cascade={"persist"})
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
     * Set datemembre
     *
     * @param \DateTime $datemembre
     *
     * @return Membre
     */
    public function setDatemembre($datemembre)
    {
        $this->datemembre = $datemembre;

        return $this;
    }

    /**
     * Get datemembre
     *
     * @return \DateTime
     */
    public function getDatemembre()
    {
        return $this->datemembre;
    }

    /**
     * Set groupe
     *
     * @param \CompteGroupeBundle\Entity\Groupe $groupe
     *
     * @return Membre
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
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return Membre
     */
    public function setPersonne(\PersonneBundle\Entity\Personne $personne = null)
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
}
