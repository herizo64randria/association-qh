<?php

namespace PersonneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Service\MonService;
use PersonneBundle\Entity\Personne;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\RoleService;


class AccueilController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $usercompte = $this->getUser();

     $purcentage="";
     $personne="";
       if($usercompte){

               $repository_personne=$em->getRepository('PersonneBundle:Personne');
               $personne = $repository_personne->findOneBy(array('userCompte'=>$usercompte));
               $service=new MonService();
               $purcentage=$service->profilComplet($personne,$em);

               $procurations=$em->getRepository('PaieBundle:Procuration')->findBy(array('personne'=>$personne));
               return $this->render('@Personne/Accueil/accueil.html.twig',array('pourcentage'=>$purcentage,'personne'=>$personne));



       }
             return $this->render('@Personne/Accueil/accueil.html.twig',array('pourcentage'=>$purcentage,'personne'=>$personne));
    }


}
