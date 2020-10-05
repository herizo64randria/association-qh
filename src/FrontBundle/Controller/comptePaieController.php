<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PaieBundle\Entity\Historique_Paie;
use PersonneBundle\Entity\Personne;


/**
 * Paie controller.
 *
 * @Route("/compte-hussein-scheme")
 */
class comptePaieController extends Controller
{

    /**
     * Paie controller.
     *
     * @Route("/afficher", name="paie_liste")
     */
    public function listAction()
    {
        $em=$this->getDoctrine()->getManager();
        $usercompte=$this->getUser();
        $repository_personne=$em->getRepository('PersonneBundle:Personne');

        $personne=$repository_personne->findOneBy(array('userCompte'=>$usercompte));

        $historique=$em->getRepository('PaieBundle:Historique_Paie')->findBy(
            array('comptePaie'=>$personne->getComptePaie()),
            array('date' =>'desc')
        );
        return $this->render('@Front/ComptePaie/compte_paie_liste.html.twig',array('historique'=>$historique,'personne'=>$personne));
    }
    /**
     * Paie controller.
     *
     * @Route("/afficher/ACDE31{id}5XFZ", name="paie_listeg")
     */
    public function listGroupeAction(Request $request, Personne $personne)
    {
        $em=$this->getDoctrine()->getManager();


        $historique=$em->getRepository('PaieBundle:Historique_Paie')->findBy(
            array('comptePaie'=>$personne->getComptePaie()),
            array('date' =>'desc')
        );
        return $this->render('@Front/ComptePaie/compte_paie_liste.html.twig',array('historique'=>$historique,'personne'=>$personne));
    }
    /**
     * Paie controller.
     *
     * @Route("/afficher-suivie/ACDE31{id}5XFZ", name="paie_listeInvite")
     */
    public function listSuivieAction(Request $request, Personne $personnesuivie)
    {
        $em=$this->getDoctrine()->getManager();

        $usercompte=$this->getUser();
        $repository_personne=$em->getRepository('PersonneBundle:Personne');

        $personne=$repository_personne->findOneBy(array('userCompte'=>$usercompte));
        $historique=$em->getRepository('PaieBundle:Historique_Paie')->findBy(
            array('comptePaie'=>$personnesuivie->getComptePaie()),
            array('date' =>'desc')
        );
        return $this->render('@Front/invitation/compte_paie_liste_suivie.html.twig',array('historique'=>$historique,'personnesuivie'=>$personnesuivie,'personne'=>$personne));
    }
    /**
     * Paie controller.
     *
     * @Route("/suprimer-suivie/ACDE31{id}5XFZ", name="paie_suprimerInvite")
     */
    public function deleteSuivieAction(Request $request, Personne $personnesuivie)
    {
        $em=$this->getDoctrine()->getManager();

        $user=$this->getUser();
        $repository_personne=$em->getRepository('PersonneBundle:Personne');

        $peers=$repository_personne->findOneBy(array('userCompte'=>$user));
        $invite1=$em->getRepository('FrontBundle:Invitation')->findOneBy(array('userCreer'=>$peers,'userInviter'=>$personnesuivie));
        $invite2=$em->getRepository('FrontBundle:Invitation')->findOneBy(array('userCreer'=>$personnesuivie,'userInviter'=>$peers));
        $invite="";
        if($invite1){
            $invite=$invite1;
        }
        if($invite2){
            $invite=$invite2;
        }
        $em->remove($invite);
        $peers->removeInviter1($personnesuivie);
        $personnesuivie->removeInviter1($peers);
        $em->flush();
        return $this->redirectToRoute('personne_profil');
    }

}
