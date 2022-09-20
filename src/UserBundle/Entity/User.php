<?php

namespace UserBundle\Entity;

use AppBundle\Service\RoleService;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *@package User\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

    //const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;

    public function getMyRoles()
    {
        $ral = $this->getRoles();

        $rol = $ral[0];

        return $rol;
    }
    //--------------------------------------

    public function ifRole($rl){
        $ok = false;

        foreach($this->getRoles() as $rol){
            if($rol == $rl){
                $ok = true;
            }
        }

        return $ok;
    }

    //--------------------------------------



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
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


}

