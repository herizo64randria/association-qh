<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cheque_Remboursement
 *
 * @ORM\Table(name="cheque__remboursement")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\Cheque_RemboursementRepository")
 */
class Cheque_Remboursement
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
     * @ORM\Column(name="banque", type="string", length=50)
     */
    private $banque;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=50)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ScanUrl", type="string", length=255, nullable=true)
     */
    private $scanUrl;


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
     * Set banque
     *
     * @param string $banque
     *
     * @return Cheque_Remboursement
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

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Cheque_Remboursement
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
     * Set numero
     *
     * @param string $numero
     *
     * @return Cheque_Remboursement
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Cheque_Remboursement
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
     * Set scanUrl
     *
     * @param string $scanUrl
     *
     * @return Cheque_Remboursement
     */
    public function setScanUrl($scanUrl)
    {
        $this->scanUrl = $scanUrl;

        return $this;
    }

    /**
     * Get scanUrl
     *
     * @return string
     */
    public function getScanUrl()
    {
        return $this->scanUrl;
    }
}
