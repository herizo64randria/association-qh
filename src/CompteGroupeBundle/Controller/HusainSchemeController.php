<?php

namespace CompteGroupeBundle\Controller;

use CompteGroupeBundle\Entity\Groupe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CompteGroupeBundle\CompteGroupeBundle;
use PaieBundle\Entity\Compte_Paie;
use AppBundle\Service\MonService;
use PersonneBundle\Entity\Personne;
use CompteGroupeBundle\Entity\Membre;
use PaieBundle\Entity\Compte_Hussen;
use PaieBundle\Entity\Versement;
use PaieBundle\Entity\Demande_Remboursement;
use PaieBundle\Entity\Historique_Paie;
/**
 * grphusain controller.
 *
 */
class HusainSchemeController extends Controller
{
    /**
     * Groupe entities.
     *
     * @Route("/accueil-groupe-husain/AZ12{id}3ZEGT", name="accueil-groupe-husain")
     * @Method({"GET","POST"})
     */
    public function accueilgroupehusainAction(Request $request,Groupe $groupe)
    {

        $em = $this->getDoctrine()->getManager();
        $historique=$em->getRepository('PaieBundle:Historique_Paie')->findBy(
            array('comptePaie'=>$groupe->getComptePaie()),
            array('date' => 'asc')
        );

        return $this->render('@CompteGroupe/grp-husain/acceuilgrphusain.html.twig',array('historique'=>$historique,'groupe'=>$groupe));
    }
    /**
     * Versement entities.
     *
     * @Route("/list-grp-versement-notifier/AZ12{id}3ZEGT", name="Liste-grp-versement")
     * @Method({"GET","POST"})
     */
    public function listegrpversementAction(Request $request,Groupe $groupe)
    {

        $em = $this->getDoctrine()->getManager();
        $versements=$em->getRepository('PaieBundle:Versement')->findBy(array('groupe'=>$groupe), array('date' => 'desc'));

        return $this->render('@CompteGroupe/grp-husain/grp-listeversementnotifer.html.twig',array('versements'=>$versements,'groupe'=>$groupe));
    }
    /**
     * demande_remboursement entities.
     *
     * @Route("/list-grp-dmdremboursement/AZ12{id}3ZEGT", name="Liste-grp-dmdremboursement")
     * @Method({"GET","POST"})
     */
    public function listegrpdmdRemboursementAction(Request $request,Groupe $groupe)
    {

        $em = $this->getDoctrine()->getManager();
        $remboursements=$em->getRepository('PaieBundle:Demande_Remboursement')->findBy(array('groupe'=>$groupe), array('date' => 'desc'));

        return $this->render('@CompteGroupe/grp-husain/grp-listedmdremboursement.html.twig',array('remboursements'=>$remboursements,'groupe'=>$groupe));
    }
    /**
     * versement entities.
     *
     * @Route("/grp-versement/ajouter/123QSA34{id}ED12ER", name="grp-versement_ajouter")
     * @Method({"GET","POST"})
     */
    public function addversementAction(Request $request,Groupe $groupe)
    {
        $em=$this->getDoctrine()->getManager();

        $numero_compte=$em->getRepository('PaieBundle:Compte_Hussen')->findAll();

        if($request->getMethod()=='POST') {

            $usercompte = $this->getUser();
            $compte_hussen = $em->getRepository('PaieBundle:Compte_Hussen')->findOneBy(array('id' => $_POST['numero_compte']));
            $versement = new Versement();
            $monservice = new MonService();
            $date = \DateTime::createFromFormat('d/m/Y', $_POST['date_versement']);
            $versement->setDate($date);
            $versement->setGroupe($groupe);
            $versement->setUserCreer($usercompte);
            $versement->setUserConfirme(null);
            $versement->setUserRefuse(null);
            $versement->setEtat('En attente de confirmation');
            if ($_FILES['fichier_cheque'])
            {
                if ($scan = $monservice->uploadFichier('grp-fichier', 'cheque', 'fichier_cheque'))
                {
                    $versement->setBorderauUrl($scan);
                }
                else
                {
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }

            $versement->setCompteHussen($compte_hussen);
            $versement->setMontant($_POST['montant']);
            $em->persist($versement);

            $compte_Paie = $groupe->getComptePaie();
            $historique_paie = new Historique_Paie();
            $historique_paie->setComptePaie($compte_Paie);
            $historique_paie->setVersement($versement);
            $historique_paie->setDate($date);
            $historique_paie->setLibelle('Demande de versement ('.$versement->getMontant().')');
            $historique_paie->setMontant($versement->getMontant());
            $historique_paie->setType('0');
            $em->persist($historique_paie);

            $em->flush();

            return $this->redirectToRoute('accueil-groupe-husain',array('id'=>$groupe->getId()));


        }
        return $this->render('@CompteGroupe/grp-husain/grp-versementnotifier.html.twig',array('numero_compte'=>$numero_compte,
            'groupe'=>$groupe));

    }
    /**
     * Remboursement entities.
     *
     * @Route("/grp-demande-remboursement/ajouter/123QSA34{id}ED12ER", name="grp-dmdremboursement_ajouter")
     * @Method({"GET","POST"})
     */
    public function ajoutdmdremboursementAction(Request $request,Groupe $groupe)
    {

        $num=$this->recupererNumero();
        if($request->getMethod() == 'POST'){
            $usercompte=$this->getUser();
            $em=$this->getDoctrine()->getManager();
            $Demande_Remboursement=new Demande_Remboursement();
            $repository_numDemande = $em->getRepository('PaieBundle:Numero_demande');
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
            $Demande_Remboursement->setGroupe($groupe);
            $date = \DateTime::createFromFormat('d/m/Y', $_POST['date_demande']);
            $Demande_Remboursement->setDate($date);
            $Demande_Remboursement->setNumero($num);
            $Demande_Remboursement->setUserCreer($usercompte);
            $Demande_Remboursement->setTypeCheque($_POST['cheque']);
            $Demande_Remboursement->setMontant($_POST['montant']);
            $Demande_Remboursement->setEtat('En attente de confirmation');
            $Demande_Remboursement->setUserConfirme(null);
            $Demande_Remboursement->setUserRefuser(null);
            $em->persist($Demande_Remboursement);

            //----AJOUTER CREDIT DANS L'HISTORIQUE-----

            $compte_Paie = $groupe->getComptePaie();


            $historique_paie = new Historique_Paie();
            $historique_paie->setComptePaie($compte_Paie);
            $historique_paie->setDemandeReboursement($Demande_Remboursement);
            $historique_paie->setDate($date);
            $historique_paie->setLibelle('Demande de remboursement '.$Demande_Remboursement->getNumero().' ('.number_format($Demande_Remboursement->getMontant(),'2',',',' ').')');
            $historique_paie->setMontant($Demande_Remboursement->getMontant());
            $historique_paie->setType('0');
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
            return $this->redirectToRoute('accueil-groupe-husain',array('id'=>$groupe->getId()));


        }

        return $this->render('@CompteGroupe/grp-husain/grp-dmdremboursement.html.twig',array('num'=>$num,'groupe'=>$groupe));
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
