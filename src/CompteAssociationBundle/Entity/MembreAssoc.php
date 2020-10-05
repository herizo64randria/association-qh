<?php

namespace CompteAssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MembreAssoc
 *
 * @ORM\Table(name="membre_assoc")
 * @ORM\Entity(repositoryClass="CompteAssociationBundle\Repository\MembreAssocRepository")
 */
class MembreAssoc
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
     * @ORM\Column(name="datemembreassoc", type="datetime")
     */
    private $datemembreassoc;
//    ---------------//////RELATION//////---------------

    /**
     * @ORM\ManyToOne(targetEntity="CompteAssociationBundle\Entity\Association",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $association;
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
     * Set datemembreassoc
     *
     * @param \DateTime $datemembreassoc
     *
     * @return MembreAssoc
     */
    public function setDatemembreassoc($datemembreassoc)
    {
        $this->datemembreassoc = $datemembreassoc;

        return $this;
    }

    /**
     * Get datemembreassoc
     *
     * @return \DateTime
     */
    public function getDatemembreassoc()
    {
        return $this->datemembreassoc;
    }

    /**
     * Set association
     *
     * @param \CompteAssociationBundle\Entity\Association $association
     *
     * @return MembreAssoc
     */
    public function setAssociation(\CompteAssociationBundle\Entity\Association $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \CompteAssociationBundle\Entity\Association
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return MembreAssoc
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
