<?php
/**
 * Created by PhpStorm.
 * User: haja
 * Date: 04/04/2019
 * Time: 13:12
 */

namespace AppBundle\Service;
use DemandeQhBundle\Entity\DemandeQh;
use DemandeQhBundle\Entity\Dossier;
use PersonneBundle\Entity\Personne;
use Doctrine\ORM\EntityManager;

class InfoDossierService
{
    public function testInfodossier(Dossier $dossier)
    {

        if($dossier->getSafahi()==null or
            $dossier->getAttestationCopmteBank()==null or $dossier->getAttestationSoldeCompte()==null )
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function testInfodossiergarant1(Dossier $dossier)
    {

        if($dossier->getFormulaireGarantie()==null or $dossier->getChequeBare()==null or $dossier->getCheque1Bare()==null
            or $dossier->getCheque2Bare()==null)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function testInfodossiergarant2(Dossier $dossier)
    {

        if($dossier->getFormulaireGarantie1()==null or $dossier->getChequeBare1()==null or $dossier->getCheque1Bare1()==null
            or $dossier->getCheque2Bare1()==null){
            return false;
        }
        else
        {
            return true;
        }
    }
}