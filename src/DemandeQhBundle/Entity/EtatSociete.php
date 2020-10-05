<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatSociete
 *
 * @ORM\Table(name="etat_societe")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\EtatSocieteRepository")
 */
class EtatSociete
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
     * @ORM\Column(name="nometat", type="string", length=255, nullable=true)
     */
    private $nometat;

    /**
     * @var string
     *
     * @ORM\Column(name="motifRefuser", type="string", length=255, nullable=true)
     */
    private $motifRefuser;

    /**
     * @var string
     *
     * @ORM\Column(name="MotifRefuserAdmin", type="string", length=255, nullable=true)
     */
    private $motifRefuserAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="MotifAccepter", type="string", length=255, nullable=true)
     */
    private $motifAccepter;


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
     * Set nometat
     *
     * @param string $nometat
     *
     * @return EtatSociete
     */
    public function setNometat($nometat)
    {
        $this->nometat = $nometat;

        return $this;
    }

    /**
     * Get nometat
     *
     * @return string
     */
    public function getNometat()
    {
        return $this->nometat;
    }

    /**
     * Set motifRefuser
     *
     * @param string $motifRefuser
     *
     * @return EtatSociete
     */
    public function setMotifRefuser($motifRefuser)
    {
        $this->motifRefuser = $motifRefuser;

        return $this;
    }

    /**
     * Get motifRefuser
     *
     * @return string
     */
    public function getMotifRefuser()
    {
        return $this->motifRefuser;
    }

    /**
     * Set motifRefuserAdmin
     *
     * @param string $motifRefuserAdmin
     *
     * @return EtatSociete
     */
    public function setMotifRefuserAdmin($motifRefuserAdmin)
    {
        $this->motifRefuserAdmin = $motifRefuserAdmin;

        return $this;
    }

    /**
     * Get motifRefuserAdmin
     *
     * @return string
     */
    public function getMotifRefuserAdmin()
    {
        return $this->motifRefuserAdmin;
    }

    /**
     * Set motifAccepter
     *
     * @param string $motifAccepter
     *
     * @return EtatSociete
     */
    public function setMotifAccepter($motifAccepter)
    {
        $this->motifAccepter = $motifAccepter;

        return $this;
    }

    /**
     * Get motifAccepter
     *
     * @return string
     */
    public function getMotifAccepter()
    {
        return $this->motifAccepter;
    }
}

