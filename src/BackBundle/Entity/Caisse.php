<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caisse
 *
 * @ORM\Table(name="caisse")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\CaisseRepository")
 */
class Caisse
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=255)
     */
    private $detail;
    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

/////////////////////////////  Relation     //////////////////////////
    /**
     * @ORM\OneToOne(targetEntity="BackBundle\Entity\Compte_Caisse",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteCaisse;

//////////////////////////// Fin Relation ///////////////////////////

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
     * @return Caisse
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
     * Set detail
     *
     * @param string $detail
     *
     * @return Caisse
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set compteCaisse
     *
     * @param \BackBundle\Entity\Compte_Caisse $compteCaisse
     *
     * @return Caisse
     */
    public function setCompteCaisse(\BackBundle\Entity\Compte_Caisse $compteCaisse)
    {
        $this->compteCaisse = $compteCaisse;

        return $this;
    }

    /**
     * Get compteCaisse
     *
     * @return \BackBundle\Entity\Compte_Caisse
     */
    public function getCompteCaisse()
    {
        return $this->compteCaisse;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Caisse
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
