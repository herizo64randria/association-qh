<?php
/**
 * Created by PhpStorm.
 * User: haja
 * Date: 04/04/2019
 * Time: 08:36
 */

namespace AppBundle\Service;
use DemandeQhBundle\Entity\DemandeQh;
use DemandeQhBundle\Entity\Garant;
use PersonneBundle\Entity\Personne;
use Doctrine\ORM\EntityManager;

class InfoGarantService
{
    public function testInfo(Garant $garant)
    {

        if ($garant->getId() != 0 and $garant->getNomcin() == null or $garant->getPrenomcin() == null or $garant->getDateNaissance() == null or
            $garant->getLieu() == null or $garant->getAdresse() == null or $garant->getVille() == null or
            $garant->getNationalite() == null or $garant->getTypePiece() == null or $garant->getNumeroPiece() == null
            or $garant->getDatePiece() == null or $garant->getVillePiece() == null or $garant->getPaysPiece() == null
            or $garant->getProfession() == null or $garant->getTel1() == null or $garant->getEmail() == null
            or $garant->getNumerocheque1() == null or $garant->getBanquecheque1() == null or $garant->getMontantcheque1() == null
            or $garant->getDatetcheque1() == null or $garant->getNumerocheque2() == null or $garant->getBanquecheque2() == null or $garant->getMontantcheque2() == null
            or $garant->getDatetcheque2() == null or $garant->getNumerocheque3() == null or $garant->getBanquecheque3() == null or $garant->getMontantcheque3() == null
            or $garant->getDatetcheque3() == null or $garant->getNomheritier1() == null or $garant->getPrenomheritier1() == null
        )
        {

            return false;
        }
        else
        {
            return true;
        }
    }
}