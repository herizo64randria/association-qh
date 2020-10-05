<?php
/**
 * Created by PhpStorm.
 * User: haja
 * Date: 16/04/2019
 * Time: 08:26
 */

namespace AppBundle\Service;
use http\Env\Response;
use PersonneBundle\Entity\Personne;
use Doctrine\ORM\EntityManager;


class InscriptionService
{
    public function InscriptionInfo(EntityManager $em,$user)
    {

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));

        if(!$personne->getNom() or !$personne->getPrenom() or !$personne->getNomIts()
        or !$personne->getPaysPiece() or !$personne->getNumeroIts() or !$personne->getAdresse() or !$personne->getDateCin()
        or !$personne->getDateNaissance() or !$personne->getEmail() or !$personne->getLieu() or !$personne->getNationalite()
        or !$personne->getDelivrer() or !$personne->getPhoto() or !$personne->getNum1() or !$personne->getProfession()
        or !$personne->getTypePiece()or !$personne->getNumerocin()or !$personne->getScan()  or !$personne->getScanCin()
        or !$personne->getNumeroSabil() or !$personne->getVille() )
         {
           return false;
         }
        else
         {
            return true;
         }

    }
}