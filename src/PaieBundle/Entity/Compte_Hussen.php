<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte_Hussen
 *
 * @ORM\Table(name="compte__hussen")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\Compte_HussenRepository")
 */
class Compte_Hussen
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
     * @ORM\Column(name="numeroCompte", type="string", length=50)
     */
    private $numeroCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="Banque", type="string", length=255)
     */
    private $banque;


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
     * Set numeroCompte
     *
     * @param string $numeroCompte
     *
     * @return Compte_Hussen
     */
    public function setNumeroCompte($numeroCompte)
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }

    /**
     * Get numeroCompte
     *
     * @return string
     */
    public function getNumeroCompte()
    {
        return $this->numeroCompte;
    }

    /**
     * Set banque
     *
     * @param string $banque
     *
     * @return Compte_Hussen
     */
    public function setBanque($banque)
    {
        $this->banque = $banque;

        return $this;
    }

    /**
     * Get banque
     *
     * @return string
     */
    public function getBanque()
    {
        return $this->banque;
    }
}
