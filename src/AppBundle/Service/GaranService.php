<?php
/**
 * Created by PhpStorm.
 * User: haja
 * Date: 27/03/2019
 * Time: 09:11
 */

namespace AppBundle\Service;

use DemandeQhBundle\Entity\DemandeQh;
use DemandeQhBundle\Entity\Garant;
use PersonneBundle\Entity\Personne;
use Doctrine\ORM\EntityManager;

class GaranService
{

    public function testGarant(Garant $param,EntityManager $em,$index)
    {   $indice=0;
        $indice1=0;
        $i=0;
        $demandeqh=null;
        $etat=null;
        $garants=$em->getRepository('DemandeQhBundle:Garant')->findAll();
        $personnes=$em->getRepository('PersonneBundle:Personne')->findAll();
        foreach($garants as $garant)
        {

            if(($garant->getNumeroIts() == $param->getNumeroIts())  )
            {
                $demandeqhparam=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array($index=>$param));
                $demandeqhtemp=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('garant1'=>$garant));
               if($demandeqhtemp)
               {
                   $demandeqh=$demandeqhtemp;
               }
               else
               {
                   $demandeqhtemp=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('garant2'=>$garant));
                   $demandeqh=$demandeqhtemp;

               }
               if($demandeqh){
                   if($demandeqh->getNumero()!= $demandeqhparam->getNumero())
                   {
                       if($demandeqh->getPersonne()->getNumeroDemandeQHtemp())
                       {
                           $etat=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demandeqh));
                       }
                   }

               }


            }

        }



        /*foreach($personnes as $personne)
        {
            if(($personne->getNumeroIts()== $param->getNumeroIts()) && ($personne->getNumeroDemandeQHtemp() != null ) )
            {
                $indice1 = $indice1+1;
            }

        }
        $Tindice=$indice+$indice1;*/
        return $etat;
    }
}