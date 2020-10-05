<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Procuration
 *
 * @ORM\Table(name="procuration")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\ProcurationRepository")
 */
class Procuration
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
     * @var int
     *
     * @ORM\Column(name="numeroits", type="integer")
     */
    private $numeroits;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="relation", type="string", length=255, nullable=true)
     */
    private $relation;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne;

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
     * Set numeroits
     *
     * @param integer $numeroits
     *
     * @return Procuration
     */
    public function setNumeroits($numeroits)
    {
        $this->numeroits = $numeroits;

        return $this;
    }

    /**
     * Get numeroits
     *
     * @return int
     */
    public function getNumeroits()
    {
        return $this->numeroits;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Procuration
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return Procuration
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
     * Set relation
     *
     * @param string $relation
     *
     * @return Procuration
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * Get relation
     *
     * @return string
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Procuration
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
}
