<?php

namespace PersonneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Personne
 *
 * @ORM\Table(name="personne")
 * @ORM\Entity(repositoryClass="PersonneBundle\Repository\PersonneRepository")
 */
class Personne
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=50)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nomIts", type="string", length=255)
     */
    private $nomIts;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroIts", type="string", length=50, unique=true)
     */
    private $numeroIts;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="num1", type="string", length=50)
     */
    private $num1;

    /**
     * @var string
     *
     * @ORM\Column(name="num2", type="string", length=50, nullable=true)
     */
    private $num2;
    /**
     * @var string
     *
     * @ORM\Column(name="num3", type="string", length=50, nullable=true)
     */
    private $num3;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=25)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroSabil", type="string", length=255)
     */
    private $numeroSabil;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50)
     */
    private $ville;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=250, nullable=true)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=250)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="scan", type="string", length=250)
     */
    private $scan;
    /**
     * @var array
     *
     * @ORM\Column(name="scan_cin", type="array", nullable=true)
     */
    private $scancin;
    /**
     * @var string
     *
     * @ORM\Column(name="numerocin", type="string", length=255)
     */
    private $numerocin;
    /**
     * @var string
     *
     * @ORM\Column(name="delivrer", type="string", length=50)
     */
    private $delivrer;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_cin", type="datetime", nullable=true)
     */
    private $datecin;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="datetime", nullable=true)
     */
    private $datenaissance;
    /**
     * @var string
     *
     * @ORM\Column(name="moza", type="string", length=255, nullable=true)
     */
    private $moza;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="datetime", nullable=true)
     */
    private $dateInscription;
    /**
     * @var string
     *
     * @ORM\Column(name="numeroDemandeQHtemp", type="string", length=255, nullable=true)
     */
    private $numeroDemandeQHtemp;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255,nullable=true)
     */
    private $lieu;
    /**
     * @var string
     *
     * @ORM\Column(name="typePiece", type="string", length=255,nullable=true)
     */
    private $typePiece;
    /**
     * @var string
     *
     * @ORM\Column(name="paysPiece", type="string", length=255,nullable=true)
     */
    private $paysPiece;
    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=255,nullable=true)
     */
    private $profession;

//    ---------------RELATION---------------
    /**
     * @ORM\ManyToMany(targetEntity="PersonneBundle\Entity\Personne", inversedBy="personne1")
     */
    protected $inviter1;

    /**
     * @ORM\ManyToMany(targetEntity="PersonneBundle\Entity\Personne", mappedBy="inviter1")
     */
    protected $personne1;

    /**
     * @ORM\OneToOne(targetEntity="PaieBundle\Entity\Compte_Paie",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $comptePaie;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCompte;
    /**
     * @ORM\OneToOne(targetEntity="DemandeQhBundle\Entity\Dossier",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $dossierEncours;
    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\Moze",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $moze;

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
     * Set nomIts
     *
     * @param string $nomIts
     *
     * @return Personne
     */
    public function setNomIts($nomIts)
    {
        $this->nomIts = $nomIts;

        return $this;
    }

    /**
     * Get nomIts
     *
     * @return string
     */
    public function getNomIts()
    {
        return $this->nomIts;
    }

    /**
     * Set numeroIts
     *
     * @param string $numeroIts
     *
     * @return Personne
     */
    public function setNumeroIts($numeroIts)
    {
        $this->numeroIts = $numeroIts;

        return $this;
    }

    /**
     * Get numeroIts
     *
     * @return string
     */
    public function getNumeroIts()
    {
        return $this->numeroIts;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Personne
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set num1
     *
     * @param string $num1
     *
     * @return Personne
     */
    public function setNum1($num1)
    {
        $this->num1 = $num1;

        return $this;
    }

    /**
     * Get num1
     *
     * @return string
     */
    public function getNum1()
    {
        return $this->num1;
    }

    /**
     * Set num2
     *
     * @param string $num2
     *
     * @return Personne
     */
    public function setNum2($num2)
    {
        $this->num2 = $num2;

        return $this;
    }

    /**
     * Get num2
     *
     * @return string
     */
    public function getNum2()
    {
        return $this->num2;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Personne
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set numeroSabil
     *
     * @param string $numeroSabil
     *
     * @return Personne
     */
    public function setNumeroSabil($numeroSabil)
    {
        $this->numeroSabil = $numeroSabil;

        return $this;
    }

    /**
     * Get numeroSabil
     *
     * @return string
     */
    public function getNumeroSabil()
    {
        return $this->numeroSabil;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Personne
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Personne
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set comptePaie
     *
     * @param \PaieBundle\Entity\Compte_Paie $comptePaie
     *
     * @return Personne
     */
    public function setComptePaie(\PaieBundle\Entity\Compte_Paie $comptePaie)
    {
        $this->comptePaie = $comptePaie;

        return $this;
    }

    /**
     * Get comptePaie
     *
     * @return \PaieBundle\Entity\Compte_Paie
     */
    public function getComptePaie()
    {
        return $this->comptePaie;
    }

    /**
     * Set userCompte
     *
     * @param \UserBundle\Entity\User $userCompte
     *
     * @return Personne
     */
    public function setUserCompte(\UserBundle\Entity\User $userCompte = null)
    {
        $this->userCompte = $userCompte;

        return $this;
    }

    /**
     * Get userCompte
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserCompte()
    {
        return $this->userCompte;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Personne
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Personne
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
     * @return Personne
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

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Personne
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Personne
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set scan
     *
     * @param string $scan
     *
     * @return Personne
     */
    public function setScan($scan)
    {
        $this->scan = $scan;

        return $this;
    }

    /**
     * Get scan
     *
     * @return string
     */
    public function getScan()
    {
        return $this->scan;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Personne
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set scanCin
     *
     * @param string $scanCin
     *
     * @return Personne
     */
    public function setScanCin($scanCin)
    {
        $this->scancin = $scanCin;

        return $this;
    }

    /**
     * Get scanCin
     *
     * @return string
     */
    public function getScanCin()
    {
        return $this->scancin;
    }

    /**
     * Set delivrer
     *
     * @param string $delivrer
     *
     * @return Personne
     */
    public function setDelivrer($delivrer)
    {
        $this->delivrer = $delivrer;

        return $this;
    }

    /**
     * Get delivrer
     *
     * @return string
     */
    public function getDelivrer()
    {
        return $this->delivrer;
    }

    /**
     * Set dateCin
     *
     * @param \DateTime $dateCin
     *
     * @return Personne
     */
    public function setDateCin($dateCin)
    {
        $this->datecin = $dateCin;

        return $this;
    }

    /**
     * Get dateCin
     *
     * @return \DateTime
     */
    public function getDateCin()
    {
        return $this->datecin;
    }

    /**
     * Set num3
     *
     * @param string $num3
     *
     * @return Personne
     */
    public function setNum3($num3)
    {
        $this->num3 = $num3;

        return $this;
    }

    /**
     * Get num3
     *
     * @return string
     */
    public function getNum3()
    {
        return $this->num3;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Personne
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->datenaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set moza
     *
     * @param string $moza
     *
     * @return Personne
     */
    public function setMoza($moza)
    {
        $this->moza = $moza;

        return $this;
    }

    /**
     * Get moza
     *
     * @return string
     */
    public function getMoza()
    {
        return $this->moza;
    }

    /**
     * Set numerocin
     *
     * @param string $numerocin
     *
     * @return Personne
     */
    public function setNumerocin($numerocin)
    {
        $this->numerocin = $numerocin;

        return $this;
    }

    /**
     * Get numerocin
     *
     * @return string
     */
    public function getNumerocin()
    {
        return $this->numerocin;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Personne
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }


    /**
     * Set numeroDemandeQHtemp
     *
     * @param string $numeroDemandeQHtemp
     *
     * @return Personne
     */
    public function setNumeroDemandeQHtemp($numeroDemandeQHtemp)
    {
        $this->numeroDemandeQHtemp = $numeroDemandeQHtemp;

        return $this;
    }

    /**
     * Get numeroDemandeQHtemp
     *
     * @return string
     */
    public function getNumeroDemandeQHtemp()
    {
        return $this->numeroDemandeQHtemp;
    }

    /**
     * Set dossierEncours
     *
     * @param \DemandeQhBundle\Entity\Dossier $dossierEncours
     *
     * @return Personne
     */
    public function setDossierEncours(\DemandeQhBundle\Entity\Dossier $dossierEncours = null)
    {
        $this->dossierEncours = $dossierEncours;

        return $this;
    }

    /**
     * Get dossierEncours
     *
     * @return \DemandeQhBundle\Entity\Dossier
     */
    public function getDossierEncours()
    {
        return $this->dossierEncours;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Personne
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set typePiece
     *
     * @param string $typePiece
     *
     * @return Personne
     */
    public function setTypePiece($typePiece)
    {
        $this->typePiece = $typePiece;

        return $this;
    }

    /**
     * Get typePiece
     *
     * @return string
     */
    public function getTypePiece()
    {
        return $this->typePiece;
    }

    /**
     * Set paysPiece
     *
     * @param string $paysPiece
     *
     * @return Personne
     */
    public function setPaysPiece($paysPiece)
    {
        $this->paysPiece = $paysPiece;

        return $this;
    }

    /**
     * Get paysPiece
     *
     * @return string
     */
    public function getPaysPiece()
    {
        return $this->paysPiece;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return Personne
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set moze
     *
     * @param \DemandeQhBundle\Entity\Moze $moze
     *
     * @return Personne
     */
    public function setMoze(\DemandeQhBundle\Entity\Moze $moze = null)
    {
        $this->moze = $moze;

        return $this;
    }

    /**
     * Get moze
     *
     * @return \DemandeQhBundle\Entity\Moze
     */
    public function getMoze()
    {
        return $this->moze;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inviter1 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->personne1 = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add inviter1
     *
     * @param \PersonneBundle\Entity\Personne $inviter1
     *
     * @return Personne
     */
    public function addInviter1(\PersonneBundle\Entity\Personne $inviter1)
    {
        $this->inviter1[] = $inviter1;

        return $this;
    }

    /**
     * Remove inviter1
     *
     * @param \PersonneBundle\Entity\Personne $inviter1
     */
    public function removeInviter1(\PersonneBundle\Entity\Personne $inviter1)
    {
        $this->inviter1->removeElement($inviter1);
    }

    /**
     * Get inviter1
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInviter1()
    {
        return $this->inviter1;
    }

    /**
     * Add personne1
     *
     * @param \PersonneBundle\Entity\Personne $personne1
     *
     * @return Personne
     */
    public function addPersonne1(\PersonneBundle\Entity\Personne $personne1)
    {
        $this->personne1[] = $personne1;

        return $this;
    }

    /**
     * Remove personne1
     *
     * @param \PersonneBundle\Entity\Personne $personne1
     */
    public function removePersonne1(\PersonneBundle\Entity\Personne $personne1)
    {
        $this->personne1->removeElement($personne1);
    }

    /**
     * Get personne1
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonne1()
    {
        return $this->personne1;
    }
}
