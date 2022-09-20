<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhotoOr
 *
 * @ORM\Table(name="photo_or")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\PhotoOrRepository")
 */
class PhotoOr
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
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;
        //    RELATION
    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\GarantieOr")
     * @ORM\JoinColumn(nullable=true)
     */
    private $garantieor;
    //    RELATION

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
     * Set url
     *
     * @param string $url
     *
     * @return PhotoOr
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }



    /**
     * Set garantieor
     *
     * @param \DemandeQhBundle\Entity\GarantieOr $garantieor
     *
     * @return PhotoOr
     */
    public function setGarantieor(\DemandeQhBundle\Entity\GarantieOr $garantieor = null)
    {
        $this->garantieor = $garantieor;

        return $this;
    }

    /**
     * Get garantieor
     *
     * @return \DemandeQhBundle\Entity\GarantieOr
     */
    public function getGarantieor()
    {
        return $this->garantieor;
    }
}
