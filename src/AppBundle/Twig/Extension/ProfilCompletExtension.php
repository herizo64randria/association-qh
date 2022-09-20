<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Service\MonService;
use Doctrine\Common\Persistence\ObjectManager;
use PersonneBundle\Entity\Personne;

class ProfilCompletExtension extends \Twig_Extension
{
    private $em;
    private $userService;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;

    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('profilComplet', array($this,'ProfilComplet')),
            new \Twig_SimpleFilter('datelettre', array($this,'dateLettre')),
            new \Twig_SimpleFilter('ext',array($this,'extension')),

        );
    }
    public function extension($fichier)
    {
        //$resultat = explode('&',$fichier, 2)[1];
        $resultat = substr(strrchr($fichier, '.'), 1);
        return $resultat;
    }
    public function dateLettre($date)
    {
        $Jour = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi","Samedi");
        $Mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
        $date = $Jour[date("w")]." ".date("d")." ".$Mois[date("n")-1]." ".date("Y");
        return $date;
    }
    public function ProfilComplet(Personne $personne){

       $monservice=new MonService();

       return  $monservice->profilComplet($personne,$this->em);
    }


}
