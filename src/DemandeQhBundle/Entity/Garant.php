<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Garant
 *
 * @ORM\Table(name="garant")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\GarantRepository")
 */
class Garant
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
     * @ORM\Column(name="numeroIts", type="string", length=255,nullable=true)
     */
    private $numeroIts;

    /**
     * @var string
     *
     * @ORM\Column(name="nomIts", type="string", length=255,nullable=true)
     */
    private $nomIts;
    /**
     * @var string
     *
     * @ORM\Column(name="moze", type="string", length=255,nullable=true)
     */
    private $moze;
    /**
     * @var string
     *
     * @ORM\Column(name="nomcin", type="string", length=255,nullable=true)
     */
    private $nomcin;
    /**
     * @var string
     *
     * @ORM\Column(name="prenomcin", type="string", length=255,nullable=true)
     */
    private $prenomcin;
    /**
     * @var date
     *
     * @ORM\Column(name="date_naissance", type="date",nullable=true)
     */
    private $dateNaissance;
    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255,nullable=true)
     */
    private $lieu;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255,nullable=true)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255,nullable=true)
     */
    private $ville;
    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255,nullable=true)
     */
    private $nationalite;
    /**
     * @var string
     *
     * @ORM\Column(name="typePiece", type="string", length=255,nullable=true)
     */
    private $typePiece;
    /**
     * @var string
     *
     * @ORM\Column(name="numeroPiece", type="string", length=255,nullable=true)
     */
    private $numeroPiece;
    /**
     * @var date
     *
     * @ORM\Column(name="datePiece", type="date", length=255,nullable=true)
     */
    private $datePiece;
    /**
     * @var string
     *
     * @ORM\Column(name="villePiece", type="string", length=255,nullable=true)
     */
    private $villePiece;
    /**
     * @var string
     *
     * @ORM\Column(name="paysPiece", type="string", length=255,nullable=true)
     */
    private $paysPiece;
    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=255,nullable=true)
     */
    private $tel1;
    /**
     * @var string
     *
     * @ORM\Column(name="tel2", type="string", length=255,nullable=true)
     */
    private $tel2;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255,nullable=true)
     */
    private $email;
    /**
    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255,nullable=true)
     */
    private $sexe;
    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=255,nullable=true)
     */
    private $profession;
    /**
     * @var string
     *
     * @ORM\Column(name="numerocheque1", type="string", length=255,nullable=true)
     */
    private $numerocheque1;
    /**
     * @var string
     *
     * @ORM\Column(name="banquecheque1", type="string", length=255,nullable=true)
     */
    private $banquecheque1;
    /**
     * @var float
     *
     * @ORM\Column(name="montantcheque1", type="float", length=255,nullable=true)
     */
    private $montantcheque1;
    /**
     * @var date
     *
     * @ORM\Column(name="datecheque1", type="date", length=255,nullable=true)
     */
    private $datetcheque1;
    /**
     * @var string
     *
     * @ORM\Column(name="numerocheque2", type="string", length=255,nullable=true)
     */
    private $numerocheque2;
    /**
     * @var string
     *
     * @ORM\Column(name="banquecheque2", type="string", length=255,nullable=true)
     */
    private $banquecheque2;
    /**
     * @var float
     *
     * @ORM\Column(name="montantcheque2", type="float", length=255,nullable=true)
     */
    private $montantcheque2;
    /**
     * @var date
     *
     * @ORM\Column(name="datecheque2", type="date", length=255,nullable=true)
     */
    private $datetcheque2;
    /**
     * @var string
     *
     * @ORM\Column(name="numerocheque3", type="string", length=255,nullable=true)
     */
    private $numerocheque3;
    /**
     * @var string
     *
     * @ORM\Column(name="banquecheque3", type="string", length=255,nullable=true)
     */
    private $banquecheque3;
    /**
     * @var float
     *
     * @ORM\Column(name="montantcheque3", type="float", length=255,nullable=true)
     */
    private $montantcheque3;
    /**
     * @var date
     *
     * @ORM\Column(name="datecheque3", type="date", length=255,nullable=true)
     */
    private $datetcheque3;
    /**
     * @var string
     *
     * @ORM\Column(name="nomheritier1", type="string", length=255,nullable=true)
     */
    private $nomheritier1;
    /**
     * @var string
     *
     * @ORM\Column(name="prenomheritier1", type="string", length=255,nullable=true)
     */
    private $prenomheritier1;
    /**
     * @var array
     *
     * @ORM\Column(name="cin", type="array", nullable=true)
     */
    private $cin;
    /**
     * @var string
     *
     * @ORM\Column(name="prefixe", type="string", nullable=true)
     */
    private $prefixe;
    /**
     * @var string
     *
     * @ORM\Column(name="sabile", type="string", nullable=true)
     */
    private $sabile;
    /**
     * @var string
     *
     * @ORM\Column(name="scanits", type="string", length=255,nullable=true)
     */
    private $scanits;

    //    ---------------RELATION---------------

    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\Moze",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $mozegarant;
    /**
     * @ORM\ManyToOne(targetEntity="DemandeQhBundle\Entity\SocieteDemandeQH",
    cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $societe_demandeqh;
    //    --------------------------------------
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
     * Set numeroIts
     *
     * @param string $numeroIts
     *
     * @return Garant
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
     * Set nomIts
     *
     * @param string $nomIts
     *
     * @return Garant
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
     * Set moze
     *
     * @param string $moze
     *
     * @return Garant
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



    /**
     * Set nomcin
     *
     * @param string $nomcin
     *
     * @return Garant
     */
    public function setNomcin($nomcin)
    {
        $this->nomcin = $nomcin;

        return $this;
    }

    /**
     * Get nomcin
     *
     * @return string
     */
    public function getNomcin()
    {
        return $this->nomcin;
    }

    /**
     * Set prenomcin
     *
     * @param string $prenomcin
     *
     * @return Garant
     */
    public function setPrenomcin($prenomcin)
    {
        $this->prenomcin = $prenomcin;

        return $this;
    }

    /**
     * Get prenomcin
     *
     * @return string
     */
    public function getPrenomcin()
    {
        return $this->prenomcin;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Garant
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Garant
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Garant
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
     * Set ville
     *
     * @param string $ville
     *
     * @return Garant
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
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Garant
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
     * Set typePiece
     *
     * @param string $typePiece
     *
     * @return Garant
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
     * Set numeroPiece
     *
     * @param string $numeroPiece
     *
     * @return Garant
     */
    public function setNumeroPiece($numeroPiece)
    {
        $this->numeroPiece = $numeroPiece;

        return $this;
    }

    /**
     * Get numeroPiece
     *
     * @return string
     */
    public function getNumeroPiece()
    {
        return $this->numeroPiece;
    }

    /**
     * Set datePiece
     *
     * @param \DateTime $datePiece
     *
     * @return Garant
     */
    public function setDatePiece($datePiece)
    {
        $this->datePiece = $datePiece;

        return $this;
    }

    /**
     * Get datePiece
     *
     * @return \DateTime
     */
    public function getDatePiece()
    {
        return $this->datePiece;
    }

    /**
     * Set villePiece
     *
     * @param string $villePiece
     *
     * @return Garant
     */
    public function setVillePiece($villePiece)
    {
        $this->villePiece = $villePiece;

        return $this;
    }

    /**
     * Get villePiece
     *
     * @return string
     */
    public function getVillePiece()
    {
        return $this->villePiece;
    }

    /**
     * Set paysPiece
     *
     * @param string $paysPiece
     *
     * @return Garant
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
     * @return Garant
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
     * Set numerocheque1
     *
     * @param string $numerocheque1
     *
     * @return Garant
     */
    public function setNumerocheque1($numerocheque1)
    {
        $this->numerocheque1 = $numerocheque1;

        return $this;
    }

    /**
     * Get numerocheque1
     *
     * @return string
     */
    public function getNumerocheque1()
    {
        return $this->numerocheque1;
    }

    /**
     * Set banquecheque1
     *
     * @param string $banquecheque1
     *
     * @return Garant
     */
    public function setBanquecheque1($banquecheque1)
    {
        $this->banquecheque1 = $banquecheque1;

        return $this;
    }

    /**
     * Get banquecheque1
     *
     * @return string
     */
    public function getBanquecheque1()
    {
        return $this->banquecheque1;
    }

    /**
     * Set montantcheque1
     *
     * @param string $montantcheque1
     *
     * @return Garant
     */
    public function setMontantcheque1($montantcheque1)
    {
        $this->montantcheque1 = $montantcheque1;

        return $this;
    }

    /**
     * Get montantcheque1
     *
     * @return string
     */
    public function getMontantcheque1()
    {
        return $this->montantcheque1;
    }

    /**
     * Set datetcheque1
     *
     * @param \DateTime $datetcheque1
     *
     * @return Garant
     */
    public function setDatetcheque1($datetcheque1)
    {
        $this->datetcheque1 = $datetcheque1;

        return $this;
    }

    /**
     * Get datetcheque1
     *
     * @return \DateTime
     */
    public function getDatetcheque1()
    {
        return $this->datetcheque1;
    }

    /**
     * Set numerocheque2
     *
     * @param string $numerocheque2
     *
     * @return Garant
     */
    public function setNumerocheque2($numerocheque2)
    {
        $this->numerocheque2 = $numerocheque2;

        return $this;
    }

    /**
     * Get numerocheque2
     *
     * @return string
     */
    public function getNumerocheque2()
    {
        return $this->numerocheque2;
    }

    /**
     * Set banquecheque2
     *
     * @param string $banquecheque2
     *
     * @return Garant
     */
    public function setBanquecheque2($banquecheque2)
    {
        $this->banquecheque2 = $banquecheque2;

        return $this;
    }

    /**
     * Get banquecheque2
     *
     * @return string
     */
    public function getBanquecheque2()
    {
        return $this->banquecheque2;
    }

    /**
     * Set montantcheque2
     *
     * @param string $montantcheque2
     *
     * @return Garant
     */
    public function setMontantcheque2($montantcheque2)
    {
        $this->montantcheque2 = $montantcheque2;

        return $this;
    }

    /**
     * Get montantcheque2
     *
     * @return string
     */
    public function getMontantcheque2()
    {
        return $this->montantcheque2;
    }

    /**
     * Set datetcheque2
     *
     * @param \DateTime $datetcheque2
     *
     * @return Garant
     */
    public function setDatetcheque2($datetcheque2)
    {
        $this->datetcheque2 = $datetcheque2;

        return $this;
    }

    /**
     * Get datetcheque2
     *
     * @return \DateTime
     */
    public function getDatetcheque2()
    {
        return $this->datetcheque2;
    }

    /**
     * Set numerocheque3
     *
     * @param string $numerocheque3
     *
     * @return Garant
     */
    public function setNumerocheque3($numerocheque3)
    {
        $this->numerocheque3 = $numerocheque3;

        return $this;
    }

    /**
     * Get numerocheque3
     *
     * @return string
     */
    public function getNumerocheque3()
    {
        return $this->numerocheque3;
    }

    /**
     * Set banquecheque3
     *
     * @param string $banquecheque3
     *
     * @return Garant
     */
    public function setBanquecheque3($banquecheque3)
    {
        $this->banquecheque3 = $banquecheque3;

        return $this;
    }

    /**
     * Get banquecheque3
     *
     * @return string
     */
    public function getBanquecheque3()
    {
        return $this->banquecheque3;
    }

    /**
     * Set montantcheque3
     *
     * @param string $montantcheque3
     *
     * @return Garant
     */
    public function setMontantcheque3($montantcheque3)
    {
        $this->montantcheque3 = $montantcheque3;

        return $this;
    }

    /**
     * Get montantcheque3
     *
     * @return string
     */
    public function getMontantcheque3()
    {
        return $this->montantcheque3;
    }

    /**
     * Set datetcheque3
     *
     * @param \DateTime $datetcheque3
     *
     * @return Garant
     */
    public function setDatetcheque3($datetcheque3)
    {
        $this->datetcheque3 = $datetcheque3;

        return $this;
    }

    /**
     * Get datetcheque3
     *
     * @return \DateTime
     */
    public function getDatetcheque3()
    {
        return $this->datetcheque3;
    }

    /**
     * Set nomheritier1
     *
     * @param string $nomheritier1
     *
     * @return Garant
     */
    public function setNomheritier1($nomheritier1)
    {
        $this->nomheritier1 = $nomheritier1;

        return $this;
    }

    /**
     * Get nomheritier1
     *
     * @return string
     */
    public function getNomheritier1()
    {
        return $this->nomheritier1;
    }

    /**
     * Set prenomheritier1
     *
     * @param string $prenomheritier1
     *
     * @return Garant
     */
    public function setPrenomheritier1($prenomheritier1)
    {
        $this->prenomheritier1 = $prenomheritier1;

        return $this;
    }

    /**
     * Get prenomheritier1
     *
     * @return string
     */
    public function getPrenomheritier1()
    {
        return $this->prenomheritier1;
    }

    /**
     * Set tel1
     *
     * @param string $tel1
     *
     * @return Garant
     */
    public function setTel1($tel1)
    {
        $this->tel1 = $tel1;

        return $this;
    }

    /**
     * Get tel1
     *
     * @return string
     */
    public function getTel1()
    {
        return $this->tel1;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     *
     * @return Garant
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2;

        return $this;
    }

    /**
     * Get tel2
     *
     * @return string
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Garant
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
     * Set email
     *
     * @param string $email
     *
     * @return Garant
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
     * Set cin
     *
     * @param array $cin
     *
     * @return Garant
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return array
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set scanits
     *
     * @param string $scanits
     *
     * @return Garant
     */
    public function setScanits($scanits)
    {
        $this->scanits = $scanits;

        return $this;
    }

    /**
     * Get scanits
     *
     * @return string
     */
    public function getScanits()
    {
        return $this->scanits;
    }

    /**
     * Set mozegarant
     *
     * @param \DemandeQhBundle\Entity\Moze $mozegarant
     *
     * @return Garant
     */
    public function setMozegarant(\DemandeQhBundle\Entity\Moze $mozegarant = null)
    {
        $this->mozegarant = $mozegarant;

        return $this;
    }

    /**
     * Get mozegarant
     *
     * @return \DemandeQhBundle\Entity\Moze
     */
    public function getMozegarant()
    {
        return $this->mozegarant;
    }

    /**
     * Set societeDemandeqh
     *
     * @param \DemandeQhBundle\Entity\SocieteDemandeQH $societeDemandeqh
     *
     * @return Garant
     */
    public function setSocieteDemandeqh(\DemandeQhBundle\Entity\SocieteDemandeQH $societeDemandeqh = null)
    {
        $this->societe_demandeqh = $societeDemandeqh;

        return $this;
    }

    /**
     * Get societeDemandeqh
     *
     * @return \DemandeQhBundle\Entity\SocieteDemandeQH
     */
    public function getSocieteDemandeqh()
    {
        return $this->societe_demandeqh;
    }

    /**
     * Set prefixe
     *
     * @param string $prefixe
     *
     * @return Garant
     */
    public function setPrefixe($prefixe)
    {
        $this->prefixe = $prefixe;

        return $this;
    }

    /**
     * Get prefixe
     *
     * @return string
     */
    public function getPrefixe()
    {
        return $this->prefixe;
    }

    /**
     * Set sabile
     *
     * @param string $sabile
     *
     * @return Garant
     */
    public function setSabile($sabile)
    {
        $this->sabile = $sabile;

        return $this;
    }

    /**
     * Get sabile
     *
     * @return string
     */
    public function getSabile()
    {
        return $this->sabile;
    }
}
