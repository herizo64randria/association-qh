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
}
