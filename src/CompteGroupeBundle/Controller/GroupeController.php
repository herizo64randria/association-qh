<?php

namespace CompteGroupeBundle\Controller;

use PaieBundle\PaieBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CompteGroupeBundle\CompteGroupeBundle;
use PaieBundle\Entity\Compte_Paie;
use AppBundle\Service\MonService;
use PersonneBundle\Entity\Personne;
use CompteGroupeBundle\Entity\Groupe;
use CompteGroupeBundle\Entity\Membre;
/**
 * groupe controller.
 *
 */
class GroupeController extends Controller
{

    /**
     * Groupe entities.
     *
     * @Route("/creer-groupe", name="add_groupe")
     * @Method({"GET","POST"})
     */
    public function addAction(Request $request)
    {
        if($request->getMethod() == 'POST'){

          $groupe = new Groupe();
          $monservice = new MonService();
          $groupe->setDatecreer(new \DateTime());
          $groupe->setNomgroup($_POST['nomgrp']);
          $groupe->setUserCreer($this->getUser());

            if(isset($_FILES['photo']))
            {
                if($photo = $monservice->uploadFichier('profil', 'photo', 'photo')){
                    $groupe->setPhoto($photo) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }

          $comptePaie = new Compte_Paie();
          $membre = new Membre();
          $comptePaie->setSlug($monservice->randomLettre(10));
          $groupe->setComptePaie($comptePaie);
          $em = $this->getDoctrine()->getManager();
          $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
          $membre->setGroupe($groupe);
          //$date = \DateTime::createFromFormat('d/m/Y',new \DateTime());

          $membre->setDatemembre(new \DateTime());
          $membre->setPersonne($personne);
          $em->persist($comptePaie);
          $em->persist($groupe);
          $em->persist($membre);

          $em->flush();
          return $this->redirectToRoute('liste-groupe');
        }

        return $this->render('@CompteGroupe/groupe/Creergroup.html.twig');
    }

    /**
     * Membre entities.
     *
     * @Route("/creer-membre/ACS23D3{id}FGTRS/", name="add_membre")
     * @Method({"GET","POST"})
     */
    public function ajoutMembreAction(Request $request,Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        $message=null;
        $personnes = $em->getRepository('PersonneBundle:Personne')->findAll();
        $membres = $em->getRepository('CompteGroupeBundle:Membre')->findBy(array('groupe'=>$groupe), array('datemembre' => 'desc'));

        if($request->getMethod() == 'POST')
        {
            $compteur=0;
// script pour tester si un personne est deja membre
            $personne = $em->getRepository('PersonneBundle:Personne')->findOneBy(array('slug'=>$_POST['membre']));
            foreach($membres as $membre)
            {
                if($membre->getPersonne()->getId()==$personne->getId())
                {
                    $compteur=$compteur+1;
                }
            }
//

            if ($compteur==0)
            {
                $membre = new Membre();
                $date = \DateTime::createFromFormat('d/m/Y', $_POST['datemembre']);
                $membre->setDatemembre($date);
                $membre->setPersonne($personne);
                $membre->setGroupe($groupe);
                $em->persist($membre);
                $em->flush();
            }
            $id=$groupe->getId();
            return $this->redirectToRoute('add_membre',array('id'=>$id));


        }
        return $this->render('@CompteGroupe/groupe/Membregroupe.html.twig',array('personnes'=>$personnes,'membres'=>$membres,
            'groupe'=>$groupe,'message'=>$message));
    }
    /**
     * Membre entities.
     *
     * @Route("/sup-membre/ACS23D3{id}FGTRS/ZSER25T3{id1}FGTRS", name="delete_membre")
     * @Method({"GET","POST"})
     */
    public function deleteMembreAction(Request $request,$id,$id1)
    {
        $em = $this->getDoctrine()->getManager();
        $membre=$em->getRepository('CompteGroupeBundle:Membre')->findOneBy(array('id'=>$id));
        $em->remove($membre);
        $em->flush();
        return $this->redirectToRoute('add_membre',array('id'=>$id1));
    }
    /**
     * GroupeaffichagAjax controller.
     *
     * @Route("/affichag_membreAjax", name="membre_affichagAjax")
     * @Method{"GET"}
     */
    public function affichageAjaxAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {
            $em=$this->getDoctrine()->getManager();

            $personne = $em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));

            $datas=$em->getRepository('CompteGroupeBundle:Membre')->findBy(array('personne'=>$personne));
            $nombre = count($datas);
            return new Response($nombre);
        }


    }
    /**
     * Groupe controller.
     *
     * @Route("/liste-groupe", name="liste-groupe")
     * @Method{"GET"}
     */
    public function listAction(Request $request)
    {

            $em=$this->getDoctrine()->getManager();

            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
            $datas=$em->getRepository('CompteGroupeBundle:Membre')->findBy(array('personne'=>$personne));
            return $this->render('@CompteGroupe/groupe/Listegroupe.html.twig',array('groupes'=>$datas,'personne'=>$personne));
    }
    /**
     * Groupe controller.
     *
     * @Route("/page-choix-groupe/126ZD{id}43ERF/", name="page-choix-groupe")
     * @Method{"GET"}
     */
    public function choixAction(Request $request,Groupe $groupe)
    {

        return $this->render('@CompteGroupe/groupe/pagegrpchoix.html.twig',array('groupe'=>$groupe));
    }
    /**
     * Groupe controller.
     *
     * @Route("/apropos-groupe/126ZD{id}43ERF/", name="apropos-groupe")
     * @Method{"GET"}
     */
    public function aproposgrpAction(Request $request,Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository('CompteGroupeBundle:Membre')->findBy(array('groupe'=>$groupe), array('datemembre' => 'desc'));
        return $this->render('@CompteGroupe/groupe/aproposgrp.html.twig',array('groupe'=>$groupe,'membres'=>$membres));
    }
}
