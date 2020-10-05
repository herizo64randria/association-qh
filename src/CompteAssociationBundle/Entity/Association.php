<?php

namespace CompteAssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Association
 *
 * @ORM\Table(name="association")
 * @ORM\Entity(repositoryClass="CompteAssociationBundle\Repository\AssociationRepository")
 */
class Association
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
     * @ORM\Column(name="dateassociation", type="datetime")
     */
    private $dateassociation;

    /**
     * @var string
     *
     * @ORM\Column(name="nomassociation", type="string", length=255)
     */
    private $nomassociation;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateassociation
     *
     * @param \DateTime $dateassociation
     *
     * @return Association
     */
    public function setDateassociation($dateassociation)
    {
        $this->dateassociation = $dateassociation;

        return $this;
    }

    /**
     * Get dateassociation
     *
     * @return \DateTime
     */
    public function getDateassociation()
    {
        return $this->dateassociation;
    }

    /**
     * Set nomassociation
     *
     * @param string $nomassociation
     *
     * @return Association
     */
    public function setNomassociation($nomassociation)
    {
        $this->nomassociation = $nomassociation;

        return $this;
    }

    /**
     * Get nomassociation
     *
     * @return string
     */
    public function getNomassociation()
    {
        return $this->nomassociation;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Association
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
     * Set description
     *
     * @param string $description
     *
     * @return Association
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set comptePaie
     *
     * @param \PaieBundle\Entity\Compte_Paie $comptePaie
     *
     * @return Association
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
     * @return Association
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
