<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Remboursement
 *
 * @ORM\Table(name="remboursement")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\RemboursementRepository")
 */
class Remboursement
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    //    ---------------RELATION---------------
    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Demande_Remboursement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $demandeReboursement;

    /**
     * @ORM\ManyToOne(targetEntity="PersonneBundle\Entity\Personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne;
    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Cheque_Remboursement",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $cheque;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Remboursement
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
     * Set demandeReboursement
     *
     * @param \PaieBundle\Entity\Demande_Remboursement $demandeReboursement
     *
     * @return Remboursement
     */
    public function setDemandeReboursement(\PaieBundle\Entity\Demande_Remboursement $demandeReboursement = null)
    {
        $this->demandeReboursement = $demandeReboursement;

        return $this;
    }

    /**
     * Get demandeReboursement
     *
     * @return \PaieBundle\Entity\Demande_Remboursement
     */
    public function getDemandeReboursement()
    {
        return $this->demandeReboursement;
    }

    /**
     * Set personne
     *
     * @param \PersonneBundle\Entity\Personne $personne
     *
     * @return Remboursement
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
     * Set cheque
     *
     * @param \PaieBundle\Entity\Cheque_Remboursement $cheque
     *
     * @return Remboursement
     */
    public function setCheque(\PaieBundle\Entity\Cheque_Remboursement $cheque = null)
    {
        $this->cheque = $cheque;

        return $this;
    }

    /**
     * Get cheque
     *
     * @return \PaieBundle\Entity\Cheque_Remboursement
     */
    public function getCheque()
    {
        return $this->cheque;
    }
}
