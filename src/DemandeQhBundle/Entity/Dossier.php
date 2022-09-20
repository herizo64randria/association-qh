<?php

namespace DemandeQhBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dossier
 *
 * @ORM\Table(name="dossier")
 * @ORM\Entity(repositoryClass="DemandeQhBundle\Repository\DossierRepository")
 */
class Dossier
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
     * @ORM\Column(name="numeroDossier", type="string", length=255,nullable=true)
     */
    private $numeroDossier;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255,nullable=true)
     */
    private $slug;
    /**
     * @var string
     *
     * @ORM\Column(name="safahi", type="string", length=255,nullable=true)
     */
    private $safahi;
    /**
     * @var array
     *
     * @ORM\Column(name="cin", type="array", nullable=true)
     */
    private $cin;
    /**
     * @var array
     *
     * @ORM\Column(name="pret1", type="array", nullable=true)
     */
    private $pret1;
    /**
     * @var array
     *
     * @ORM\Column(name="acte1", type="array", nullable=true)
     */
    private $acte1;
    /**
     * @var string
     *
     * @ORM\Column(name="its", type="string", nullable=true)
     */
    private $its;
    /**
     * @var string
     *
     * @ORM\Column(name="pret", type="string", length=255,nullable=true)
     */
    private $pret;
    /**
     * @var string
     *
     * @ORM\Column(name="rehen", type="string", length=255,nullable=true)
     */
    private $rehen;
    /**
     * @var string
     *
     * @ORM\Column(name="vente", type="string", length=255,nullable=true)
     */
    private $vente;
    /**
     * @var string
     *
     * @ORM\Column(name="acte", type="string", length=255,nullable=true)
     */
    private $acte;
    /**
     * @var array
     *
     * @ORM\Column(name="rembourse", type="array", length=255,nullable=true)
     */
    private $rembourse;
    /**
     * @var array
     *
     * @ORM\Column(name="chequesG1", type="array", length=255,nullable=true)
     */
    private $chequesG1;
    /**
     * @var array
     *
     * @ORM\Column(name="pieceG1", type="array", length=255,nullable=true)
     */
    private $pieceG1;
    /**
     * @var string
     *
     * @ORM\Column(name="itsG1", type="string", length=255,nullable=true)
     */
    private $itsG1;
    /**
     * @var array
     *
     * @ORM\Column(name="chequesG2", type="array", length=255,nullable=true)
     */
    private $chequesG2;
    /**
     * @var array
     *
     * @ORM\Column(name="pieceG2", type="array", length=255,nullable=true)
     */
    private $pieceG2;
    /**
     * @var string
     *
     * @ORM\Column(name="itsG2", type="string", length=255,nullable=true)
     */
    private $itsG2;
    /**
     * @var string
     *
     * @ORM\Column(name="attestationCopmteBank", type="string", length=255,nullable=true)
     */
    private $attestationCopmteBank;
    /**
     * @var string
     *
     * @ORM\Column(name="attestationSoldeCompte", type="string", length=255,nullable=true)
     */
    private $attestationSoldeCompte;
    /**
     * @var string
     *
     * @ORM\Column(name="formulaireGarantie", type="string", length=255,nullable=true)
     */
    private $formulaireGarantie;
    /**
     * @var string
     *
     * @ORM\Column(name="chequeBare", type="string", length=255,nullable=true)
     */
    private $chequeBare;
    /**
     * @var string
     *
     * @ORM\Column(name="valide", type="string", length=255,nullable=true)
     */
    private $valide;
    /**
     * @var string
     *
     * @ORM\Column(name="complet", type="string", length=255,nullable=true)
     */
    private $complet;
    /**
     * @var string
     *
     * @ORM\Column(name="raison", type="string", length=255,nullable=true)
     */
    private $raison;
    /**
     * @var string
     *
     * @ORM\Column(name="cheque1Bare", type="string", length=255,nullable=true)
     */
    private $cheque1Bare;
    /**
     * @var string
     *
     * @ORM\Column(name="cheque2Bare", type="string", length=255,nullable=true)
     */
    private $cheque2Bare;
    /**
     * @var string
     *
     * @ORM\Column(name="formulaireGarantie1", type="string", length=255,nullable=true)
     */
    private $formulaireGarantie1;
    /**
     * @var string
     *
     * @ORM\Column(name="cin1", type="string", length=255,nullable=true)
     */
    private $cin1;
    /**
     * @var string
     *
     * @ORM\Column(name="its1", type="string", length=255,nullable=true)
     */
    private $its1;
    /**
     * @var string
     *
     * @ORM\Column(name="chequeBare1", type="string", length=255,nullable=true)
     */
    private $chequeBare1;
    /**
     * @var string
     *
     * @ORM\Column(name="cheque1Bare1", type="string", length=255,nullable=true)
     */
    private $cheque1Bare1;
    /**
     * @var string
     *
     * @ORM\Column(name="cheque2Bare1", type="string", length=255,nullable=true)
     */
    private $cheque2Bare1;

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
     * Set numeroDossier
     *
     * @param string $numeroDossier
     *
     * @return Dossier
     */
    public function setNumeroDossier($numeroDossier)
    {
        $this->numeroDossier = $numeroDossier;

        return $this;
    }

    /**
     * Get numeroDossier
     *
     * @return string
     */
    public function getNumeroDossier()
    {
        return $this->numeroDossier;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Dossier
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
     * Set safahi
     *
     * @param string $safahi
     *
     * @return Dossier
     */
    public function setSafahi($safahi)
    {
        $this->safahi = $safahi;

        return $this;
    }

    /**
     * Get safahi
     *
     * @return string
     */
    public function getSafahi()
    {
        return $this->safahi;
    }

    /**
     * Set attestationCopmteBank
     *
     * @param string $attestationCopmteBank
     *
     * @return Dossier
     */
    public function setAttestationCopmteBank($attestationCopmteBank)
    {
        $this->attestationCopmteBank = $attestationCopmteBank;

        return $this;
    }

    /**
     * Get attestationCopmteBank
     *
     * @return string
     */
    public function getAttestationCopmteBank()
    {
        return $this->attestationCopmteBank;
    }

    /**
     * Set attestationSoldeCompte
     *
     * @param string $attestationSoldeCompte
     *
     * @return Dossier
     */
    public function setAttestationSoldeCompte($attestationSoldeCompte)
    {
        $this->attestationSoldeCompte = $attestationSoldeCompte;

        return $this;
    }

    /**
     * Get attestationSoldeCompte
     *
     * @return string
     */
    public function getAttestationSoldeCompte()
    {
        return $this->attestationSoldeCompte;
    }

    /**
     * Set formulaireGarantie
     *
     * @param string $formulaireGarantie
     *
     * @return Dossier
     */
    public function setFormulaireGarantie($formulaireGarantie)
    {
        $this->formulaireGarantie = $formulaireGarantie;

        return $this;
    }

    /**
     * Get formulaireGarantie
     *
     * @return string
     */
    public function getFormulaireGarantie()
    {
        return $this->formulaireGarantie;
    }
    /**
     * Set formulaireGarantie1
     *
     * @param string $formulaireGarantie1
     *
     * @return Dossier
     */
    public function setFormulaireGarantie1($formulaireGarantie1)
    {
        $this->formulaireGarantie1 = $formulaireGarantie1;

        return $this;
    }

    /**
     * Get formulaireGarantie1
     *
     * @return string
     */
    public function getFormulaireGarantie1()
    {
        return $this->formulaireGarantie1;
    }

    /**
     * Set cin1
     *
     * @param string $cin1
     *
     * @return Dossier
     */
    public function setCin1($cin1)
    {
        $this->cin1 = $cin1;

        return $this;
    }

    /**
     * Get cin1
     *
     * @return string
     */
    public function getCin1()
    {
        return $this->cin1;
    }

    /**
     * Set its1
     *
     * @param string $its1
     *
     * @return Dossier
     */
    public function setIts1($its1)
    {
        $this->its1 = $its1;

        return $this;
    }

    /**
     * Get its1
     *
     * @return string
     */
    public function getIts1()
    {
        return $this->its1;
    }


    /**
     * Set chequeBare
     *
     * @param string $chequeBare
     *
     * @return Dossier
     */
    public function setChequeBare($chequeBare)
    {
        $this->chequeBare = $chequeBare;

        return $this;
    }

    /**
     * Get chequeBare
     *
     * @return string
     */
    public function getChequeBare()
    {
        return $this->chequeBare;
    }

    /**
     * Set chequeBare1
     *
     * @param string $chequeBare1
     *
     * @return Dossier
     */
    public function setChequeBare1($chequeBare1)
    {
        $this->chequeBare1 = $chequeBare1;

        return $this;
    }

    /**
     * Get chequeBare1
     *
     * @return string
     */
    public function getChequeBare1()
    {
        return $this->chequeBare1;
    }

    /**
     * Set cheque1Bare
     *
     * @param string $cheque1Bare
     *
     * @return Dossier
     */
    public function setCheque1Bare($cheque1Bare)
    {
        $this->cheque1Bare = $cheque1Bare;

        return $this;
    }

    /**
     * Get cheque1Bare
     *
     * @return string
     */
    public function getCheque1Bare()
    {
        return $this->cheque1Bare;
    }

    /**
     * Set cheque2Bare
     *
     * @param string $cheque2Bare
     *
     * @return Dossier
     */
    public function setCheque2Bare($cheque2Bare)
    {
        $this->cheque2Bare = $cheque2Bare;

        return $this;
    }

    /**
     * Get cheque2Bare
     *
     * @return string
     */
    public function getCheque2Bare()
    {
        return $this->cheque2Bare;
    }

    /**
     * Set cheque1Bare1
     *
     * @param string $cheque1Bare1
     *
     * @return Dossier
     */
    public function setCheque1Bare1($cheque1Bare1)
    {
        $this->cheque1Bare1 = $cheque1Bare1;

        return $this;
    }

    /**
     * Get cheque1Bare1
     *
     * @return string
     */
    public function getCheque1Bare1()
    {
        return $this->cheque1Bare1;
    }

    /**
     * Set cheque2Bare1
     *
     * @param string $cheque2Bare1
     *
     * @return Dossier
     */
    public function setCheque2Bare1($cheque2Bare1)
    {
        $this->cheque2Bare1 = $cheque2Bare1;

        return $this;
    }

    /**
     * Get cheque2Bare1
     *
     * @return string
     */
    public function getCheque2Bare1()
    {
        return $this->cheque2Bare1;
    }

    /**
     * Set cin
     *
     * @param array $cin
     *
     * @return Dossier
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
     * Set its
     *
     * @param array $its
     *
     * @return Dossier
     */
    public function setIts($its)
    {
        $this->its = $its;

        return $this;
    }

    /**
     * Get its
     *
     * @return array
     */
    public function getIts()
    {
        return $this->its;
    }

    /**
     * Set pret
     *
     * @param string $pret
     *
     * @return Dossier
     */
    public function setPret($pret)
    {
        $this->pret = $pret;

        return $this;
    }

    /**
     * Get pret
     *
     * @return string
     */
    public function getPret()
    {
        return $this->pret;
    }

    /**
     * Set rehen
     *
     * @param string $rehen
     *
     * @return Dossier
     */
    public function setRehen($rehen)
    {
        $this->rehen = $rehen;

        return $this;
    }

    /**
     * Get rehen
     *
     * @return string
     */
    public function getRehen()
    {
        return $this->rehen;
    }

    /**
     * Set vente
     *
     * @param string $vente
     *
     * @return Dossier
     */
    public function setVente($vente)
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * Get vente
     *
     * @return string
     */
    public function getVente()
    {
        return $this->vente;
    }

    /**
     * Set acte
     *
     * @param string $acte
     *
     * @return Dossier
     */
    public function setActe($acte)
    {
        $this->acte = $acte;

        return $this;
    }

    /**
     * Get acte
     *
     * @return string
     */
    public function getActe()
    {
        return $this->acte;
    }



    /**
     * Set rembourse
     *
     * @param array $rembourse
     *
     * @return Dossier
     */
    public function setRembourse($rembourse)
    {
        $this->rembourse = $rembourse;

        return $this;
    }

    /**
     * Get rembourse
     *
     * @return array
     */
    public function getRembourse()
    {
        return $this->rembourse;
    }

    /**
     * Set chequesG1
     *
     * @param array $chequesG1
     *
     * @return Dossier
     */
    public function setChequesG1($chequesG1)
    {
        $this->chequesG1 = $chequesG1;

        return $this;
    }

    /**
     * Get chequesG1
     *
     * @return array
     */
    public function getChequesG1()
    {
        return $this->chequesG1;
    }

    /**
     * Set pieceG1
     *
     * @param array $pieceG1
     *
     * @return Dossier
     */
    public function setPieceG1($pieceG1)
    {
        $this->pieceG1 = $pieceG1;

        return $this;
    }

    /**
     * Get pieceG1
     *
     * @return array
     */
    public function getPieceG1()
    {
        return $this->pieceG1;
    }

    /**
     * Set itsG1
     *
     * @param string $itsG1
     *
     * @return Dossier
     */
    public function setItsG1($itsG1)
    {
        $this->itsG1 = $itsG1;

        return $this;
    }

    /**
     * Get itsG1
     *
     * @return string
     */
    public function getItsG1()
    {
        return $this->itsG1;
    }

    /**
     * Set chequesG2
     *
     * @param array $chequesG2
     *
     * @return Dossier
     */
    public function setChequesG2($chequesG2)
    {
        $this->chequesG2 = $chequesG2;

        return $this;
    }

    /**
     * Get chequesG2
     *
     * @return array
     */
    public function getChequesG2()
    {
        return $this->chequesG2;
    }

    /**
     * Set pieceG2
     *
     * @param array $pieceG2
     *
     * @return Dossier
     */
    public function setPieceG2($pieceG2)
    {
        $this->pieceG2 = $pieceG2;

        return $this;
    }

    /**
     * Get pieceG2
     *
     * @return array
     */
    public function getPieceG2()
    {
        return $this->pieceG2;
    }

    /**
     * Set itsG2
     *
     * @param string $itsG2
     *
     * @return Dossier
     */
    public function setItsG2($itsG2)
    {
        $this->itsG2 = $itsG2;

        return $this;
    }

    /**
     * Get itsG2
     *
     * @return string
     */
    public function getItsG2()
    {
        return $this->itsG2;
    }

    /**
     * Set valide
     *
     * @param string $valide
     *
     * @return Dossier
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return string
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set raison
     *
     * @param string $raison
     *
     * @return Dossier
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * Get raison
     *
     * @return string
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * Set complet
     *
     * @param string $complet
     *
     * @return Dossier
     */
    public function setComplet($complet)
    {
        $this->complet = $complet;

        return $this;
    }

    /**
     * Get complet
     *
     * @return string
     */
    public function getComplet()
    {
        return $this->complet;
    }

    /**
     * Set pret1
     *
     * @param array $pret1
     *
     * @return Dossier
     */
    public function setPret1($pret1)
    {
        $this->pret1 = $pret1;

        return $this;
    }

    /**
     * Get pret1
     *
     * @return array
     */
    public function getPret1()
    {
        return $this->pret1;
    }

    /**
     * Set acte1
     *
     * @param array $acte1
     *
     * @return Dossier
     */
    public function setActe1($acte1)
    {
        $this->acte1 = $acte1;

        return $this;
    }

    /**
     * Get acte1
     *
     * @return array
     */
    public function getActe1()
    {
        return $this->acte1;
    }
}
