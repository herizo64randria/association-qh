<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeQh_societe
 *
 * @ORM\Table(name="demande_qh_societe")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\DemandeQh_societeRepository")
 */
class Societe
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="numTemp", type="string", length=255, nullable=true)
     */
    private $numTemp;

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

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    //    ---------------//////RELATION//////---------------

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCreer;
  
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Societe
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
     * Set siege
     *
     * @param string $siege
     *
     * @return Societe
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
     * @return Societe
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
     * Set email
     *
     * @param string $email
     *
     * @return Societe
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Societe
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
     * Set numero
     *
     * @param string $numero
     *
     * @return Societe
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
     * Set userCreer
     *
     * @param \UserBundle\Entity\User $userCreer
     *
     * @return Societe
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
     * Set societe
     *
     * @param \PersonneBundle\Entity\Personne $societe
     *
     * @return Societe
     */
    public function setSociete(\PersonneBundle\Entity\Personne $societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \PersonneBundle\Entity\Personne
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set numTemp
     *
     * @param string $numTemp
     *
     * @return Societe
     */
    public function setNumTemp($numTemp)
    {
        $this->numTemp = $numTemp;

        return $this;
    }

    /**
     * Get numTemp
     *
     * @return string
     */
    public function getNumTemp()
    {
        return $this->numTemp;
    }
}
