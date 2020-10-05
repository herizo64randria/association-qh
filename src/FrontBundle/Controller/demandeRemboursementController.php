<?php

namespace FrontBundle\Controller;
use BackBundle\Entity\notif;
use FrontBundle\FrontBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use PaieBundle\Entity\Compte_Hussen;
use PersonneBundle\Entity\Personne;
use PaieBundle\Entity\Versement;
use PaieBundle\Entity\Historique_Paie;
use PaieBundle\Entity\Numero_demande;
use PaieBundle\Entity\Demande_Remboursement;
/**
 * demandeRemboursement controller.
 *
 * @Route("/compte-hussein-scheme/remboursement")
 */

class demandeRemboursementController extends Controller
{
    /**
     * dmdRemboursement_liste entities.
     *
     * @Route("/vos-demandes", name="dmdRemboursement_liste")
     */
    public function indexAction()
    {

        $em=$this->getDoctrine()->getManager();
        $usercompte=$this->getUser();
        $repository_personne=$em->getRepository('PersonneBundle:Personne');
        $personne=$repository_personne->findOneBy(array('userCompte'=>$usercompte));
        $repository_remboursement = $em->getRepository('PaieBundle:Demande_Remboursement');
        $Demande_Remboursements= $repository_remboursement->findBy(
            array('personne' => $personne),
            array('date' => 'asc')
        );
        return $this->render('@Front/dmdRemboursement/dmdRemboursement_liste.html.twig', array(
            'personne'=>$personne,
            'demandes' => $Demande_Remboursements,
            'date'=>'asc'
        ));

    }

    /**
     *  dmdRemboursement_ajouter entities.
     *
     * @Route("/faire-demande/n", name="dmdRemboursement_ajouter")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $usercompte=$this->getUser();

        $repository_personne=$em->getRepository('PersonneBundle:Personne');

        $personne=$repository_personne->findOneBy(array('userCompte'=>$usercompte));
        $num=$this->recupererNumero();

        if($request->getMethod() == 'POST'){
            $Demande_Remboursement= new Demande_Remboursement();
            $repository_numDemande = $em

                ->getRepository('PaieBundle:Numero_demande');
            $numRetour = '';

            $qNumDemande = $repository_numDemande->findOneBy(array('id'=>1));
            $numDemande = $qNumDemande;
            $intNextNum = intval($numDemande->getNumeroDemande()) + 1;
            $nextNum = $intNextNum;

            if(strlen($intNextNum) == 1){
                $nextNum = '000'.$intNextNum;
            }

            if(strlen($intNextNum) == 2){
                $nextNum = '00'.$intNextNum;
            }

            if(strlen($intNextNum) == 3){
                $nextNum = '0'.$intNextNum;
            }

            $numDemande->setNumeroDemande($nextNum);
            $em->persist($numDemande);
            $Demande_Remboursement->setPersonne($personne);
            $date = \DateTime::createFromFormat('d/m/Y', $_POST['date_demande']);
            $Demande_Remboursement->setDate($date);
            $Demande_Remboursement->setNumero($num);
            $Demande_Remboursement->setUserCreer($usercompte);
            $Demande_Remboursement->setTypeCheque($_POST['cheque']);
            $Demande_Remboursement->setMontant($_POST['montant']);
            $Demande_Remboursement->setPaiement('Chèque');
            $Demande_Remboursement->setEtat('En attente de confirmation');
            $Demande_Remboursement->setUserConfirme(null);
            $Demande_Remboursement->setUserRefuser(null);


            //----AJOUTER CREDIT DANS L'HISTORIQUE-----

            $compte_Paie = $personne->getComptePaie();

            $notif= new notif();
            $notif->setDate(new \DateTime());
            $notif->setLabelle('Demande de remboursement par:'.$Demande_Remboursement->getPersonne()->getNom()." ".$Demande_Remboursement->getPersonne()->getPrenom());
            $notif->setEtat(false);
            $Demande_Remboursement->setNotif($notif);
            $historique_paie = new Historique_Paie();
            $historique_paie->setComptePaie($compte_Paie);
            $historique_paie->setDemandeReboursement($Demande_Remboursement);
            $historique_paie->setDate($date);
            $historique_paie->setLibelle('Demande de remboursement '.$Demande_Remboursement->getNumero().' ('.number_format($Demande_Remboursement->getMontant(),'2',',',' ').')');
            $historique_paie->setMontant($Demande_Remboursement->getMontant());
            $historique_paie->setType('0');
            $em->persist($Demande_Remboursement);
            $em->persist($notif);
            $em->persist($historique_paie);
            $em->flush();
            /*
                        //            ---HISTORIQUE GLOBAL-----

                        $historiqueGlobal = new Historique_Global();

                        $historiqueGlobal->setLibelle('Création d\'une nouvelle demande de remboursement '.$Demande_Remboursement->getNumero());
                        $historiqueGlobal->setDate(new \DateTime());
                        $historiqueGlobal->setLien($this->generateUrl('formulaire_confirme', array('id' => $Demande_Remboursement->getId())));
                        $historiqueGlobal->setUser($usercompte);

                        $em->persist($historiqueGlobal);

                        //            ---HISTORIQUE GLOBAL-----

                        $em->flush();
            */
                        return $this->redirect($this->generateUrl('dmdRemboursement_liste'));


                    }
                    return $this->render('@Front/dmdRemboursement/dmdRemboursement_ajouter.html.twig', array(
                        'num'=>$num,
                        'personne'=>$personne
                    ));

                }

                /* Fonction Recuperer Numero */
    public function recupererNumero(){
        $em = $this->getDoctrine()->getManager();

        $repository_numDemande = $em

            ->getRepository('PaieBundle:Numero_demande');

        $numRetour = '';

        $qNumDemande = $repository_numDemande->findOneBy(array('id'=>1));

        $numDemande = $qNumDemande;

        $dateJour  = new \DateTime();

        $numRetour = 'N° R - '.$numDemande->getNumeroDemande().'/'.$dateJour->format('y');

        return $numRetour;

    }


}
