<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moze
 *
 * @ORM\Table(name="moze")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\MozeRepository")
 */
class Moze
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
     * @ORM\Column(name="moze", type="string", length=255, nullable=true)
     */
    private $moze;


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
     * Set moze
     *
     * @param string $moze
     *
     * @return Moze
     */
    public function setMoze($moze)
    {
        $this->moze = $moze;

        return $this;
    }

    /**
     * Get moze
     *
     * @return string
     */
    public function getMoze()
    {
        return $this->moze;
    }
}
