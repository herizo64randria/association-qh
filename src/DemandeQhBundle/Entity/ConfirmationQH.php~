<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConirmationQH
 *
 * @ORM\Table(name="conirmation_q_h")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\ConirmationQHRepository")
 */
class ConfirmationQH
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
     * @ORM\Column(name="reponse", type="string", length=255, nullable=true)
     */
    private $reponse;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", nullable=true)
     */
    private $montant;

//    ---------------RELATION---------------

    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\SocieteDemandeQH",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     *
     */
    
    private $societeDemandeQH;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $userConfirme;
//    ---------------------------------------

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
     * Set reponse
     *
     * @param string $reponse
     *
     * @return ConfirmationQH
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return ConfirmationQH
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set societeDemandeQH
     *
     * @param \DemandeQhBundle\Entity\SocieteDemandeQH $societeDemandeQH
     *
     * @return ConfirmationQH
     */
    public function setSocieteDemandeQH(\DemandeQhBundle\Entity\SocieteDemandeQH $societeDemandeQH = null)
    {
        $this->societeDemandeQH = $societeDemandeQH;

        return $this;
    }

    /**
     * Get societeDemandeQH
     *
     * @return \DemandeQhBundle\Entity\SocieteDemandeQH
     */
    public function getSocieteDemandeQH()
    {
        return $this->societeDemandeQH;
    }

    /**
     * Set userConfirme
     *
     * @param \UserBundle\Entity\User $userConfirme
     *
     * @return ConfirmationQH
     */
    public function setUserConfirme(\UserBundle\Entity\User $userConfirme = null)
    {
        $this->userConfirme = $userConfirme;

        return $this;
    }

    /**
     * Get userConfirme
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserConfirme()
    {
        return $this->userConfirme;
    }
}
