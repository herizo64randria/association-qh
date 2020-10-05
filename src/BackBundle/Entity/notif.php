<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * notif
 *
 * @ORM\Table(name="notif")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\notifRepository")
 */
class notif
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
     * @ORM\Column(name="labelle", type="string", length=255, nullable=true)
     */
    private $labelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean", nullable=true)
     */
    private $etat;


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
     * Set labelle
     *
     * @param string $labelle
     *
     * @return notif
     */
    public function setLabelle($labelle)
    {
        $this->labelle = $labelle;

        return $this;
    }

    /**
     * Get labelle
     *
     * @return string
     */
    public function getLabelle()
    {
        return $this->labelle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return notif
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
     * Set etat
     *
     * @param boolean $etat
     *
     * @return notif
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return bool
     */
    public function getEtat()
    {
        return $this->etat;
    }



}
