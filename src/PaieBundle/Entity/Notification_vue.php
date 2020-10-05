<?php

namespace PaieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification_vue
 *
 * @ORM\Table(name="notification_vue")
 * @ORM\Entity(repositoryClass="PaieBundle\Repository\Notification_vueRepository")
 */
class Notification_Vue
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
     * @var bool
     *
     * @ORM\Column(name="vu", type="boolean")
     */
    private $vu;

    //----------------------------RELATION-------------------------

    /**
     * @ORM\ManyToOne(targetEntity="\PaieBundle\Entity\Notification")
     * @ORM\JoinColumn(nullable=false)
     */
    private $notification;

    /**
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userNotif;

    //----------------//////////Les RELATIONS//////////////////-------------------


    public function __construct()
    {
        $this->vu = false;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Set vu
     *
     * @param boolean $vu
     * @return Notification_Vue
     */
    public function setVu($vu)
    {
        $this->vu = $vu;

        return $this;
    }

    /**
     * Get vu
     *
     * @return boolean
     */
    public function getVu()
    {
        return $this->vu;
    }

    /**
     * Set notification
     *
     * @param \PaieBundle\Entity\Notification $notification
     * @return Notification_Vue
     */
    public function setNotification(\PaieBundle\Entity\Notification $notification)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Get notification
     *
     * @return \PaieBundle\Entity\Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * Set userNotif
     *
     * @param \UserBundle\Entity\User $userNotif
     * @return Notification_Vue
     */
    public function setUserNotif(\UserBundle\Entity\User $userNotif )
    {
        $this->userNotif = $userNotif;

        return $this;
    }

    /**
     * Get userNotif
     *
     * @return \MPTDN\UserBundle\Entity\User
     */
    public function getUserNotif()
    {
        return $this->userNotif;
    }
}
