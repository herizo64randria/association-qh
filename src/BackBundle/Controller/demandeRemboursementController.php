<?php
namespace BackBundle\Controller;
use AppBundle\Service\MonService;
use BackBundle\Entity\Historique_Caisse;
use PaieBundle\Entity\Cheque_Versement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PaieBundle\Entity\Compte_Hussen;
use PersonneBundle\Entity\Personne;
use PaieBundle\Entity\Versement;
use PaieBundle\Entity\Historique_Paie;
use PaieBundle\Entity\Numero_demande;
use PaieBundle\Entity\Demande_Remboursement;
use PaieBundle\Entity\Cheque_Remboursement;
use PaieBundle\Entity\Remboursement;
/**
 * demandeBack controller.
 *
 * @Route("/dash/demande")
 */
class demandeRemboursementController extends Controller
{
    /**
     * demandeRemboursement_liste entities.
     *
     * @Route("/", name="demandeRemboursement_liste")
     */
    public function listeAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $repository_remboursement = $em->getRepository('PaieBundle:Demande_Remboursement');
        $Demande_Remboursements= $repository_remboursement->findAll();
        return $this->render('@Back/dmdRemboursement/dmdRemboursement_liste.html.twig', array(
            'demandes' => $Demande_Remboursements,
            'date'=> 'asc',
        ));
    }
    /**
     * ListeRemboursement_liste entities.
     *
     * @Route("/liste-rembourssement", name="Remboursement_liste")
     */
    public function listeRemboursementAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $remboursement = $em->getRepository('PaieBundle:Remboursement');
        $Remboursements= $remboursement->findAll();
        return $this->render('@Back/remboursement/remboursement.html.twig', array(
            'demandes' => $Remboursements,
            'date'=> 'asc',
        ));
    }

    /**
     * Detail_rembouresement entities.
     *
     * @Route("/detail-rembourssement/AZE2{id}345GT", name="Remboursement_detail")
     * @Method("GET")
     */
    public function detailRemboursementAction(Remboursement $remboursement)
    {
        $em=$this->getDoctrine()->getManager();
        $historique_paie=$em->getRepository('PaieBundle:Historique_Paie')->findBy(array('comptePaie'=>$remboursement->getPersonne()->getComptePaie()));
        return $this->render('@Back/remboursement/detail_remeboursement.html.twig', array(
            'remboursement' => $remboursement,
            'historique'=> $historique_paie

        ));
    }
    /**
     * Detail_rembouresement entities.
     *
     * @Route("/imprimer-rembourssement/AZE2{id}345GT", name="Remboursement_imprimer")
     * @Method("GET")
     */
    public function imprimeRemboursementAction(Remboursement $remboursement)
    {
        $em=$this->getDoctrine()->getManager();
        $historique_paie=$em->getRepository('PaieBundle:Historique_Paie')->findBy(array('comptePaie'=>$remboursement->getPersonne()->getComptePaie()));
        return $this->render('@Back/remboursement/imprime_remboursement.html.twig', array(
            'remboursement' => $remboursement,
            'historique'=> $historique_paie

        ));
    }
    /**
     * demandeRemboursement_confirme entities.
     *
     * @Route("/c/demande-rembourssement/confirme/AZE{id}54RT", name="demande_confirmation")
     * @Method({"GET", "POST"})
     */
    public function confirmeAction(Request $request, Demande_Remboursement $demande)
    {
        $em=$this->getDoctrine()->getManager();

        $Demande_Remboursements= $demande;
        if($request->getMethod() == 'POST'){
                $cheque = new Cheque_Remboursement();
                $monservice= new MonService();
                $remboursement =new Remboursement();
                $Demande_Remboursements->setEtat('Demande acceptée');
                $Demande_Remboursements->setUserConfirme($this->getUser());
                $Demande_Remboursements->setUserRefuser(null);
                $Demande_Remboursements->getNotif()->setEtat(true);
                $cheque->setNumero($_POST['num_cheque']);
                $cheque->setLibelle($_POST['libelle_cheque']);
                $cheque->setDate(new \DateTime());
                $cheque->setBanque($_POST['banque']);
                $em->persist($cheque);
                $em->persist($Demande_Remboursements);
                $remboursement->setCheque($cheque);
                $remboursement->setDate(new \DateTime());
                $remboursement-> setPersonne($demande->getPersonne());
                if ($_FILES['fichier_cheque']['size'] > 0){
                    if($scan = $monservice->uploadFichier('cheque_remboursement', 'cheque', 'fichier_cheque')){
                        $cheque->setScanUrl($scan) ;
                    }else{
                        return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                    }
                }


                $remboursement-> setDemandeReboursement($Demande_Remboursements);
                //----AJOUTER CREDIT DANS L'HISTORIQUE-----

                $compte_Paie = $demande->getPersonne()->getComptePaie();
                $historique_paie = new Historique_Paie();
                $historique_paie->setComptePaie($compte_Paie);
                $historique_paie->setDate($remboursement->getDate());
                $historique_paie->setLibelle('Remboursement du demande numéro '.$Demande_Remboursements->getNumero());
                $historique_paie->setMontant($Demande_Remboursements->getMontant());
                $historique_paie->setType('debit');
                $em->persist($historique_paie);
                $em->persist($remboursement);
                $em->flush();


            return $this->redirectToRoute('Remboursement_detail', array('id' => $remboursement->getId()));
        }
        return $this->render('@Back/dmdRemboursement/demande_confirmation.html.twig',array(

            'demandes'=>$Demande_Remboursements,
        ));


    }
    /**
     * demandeRemboursement_refuser entities.
     *
     * @Route("/demande-remboursement/refuser/ADR46{id}4T", name="demande_refuser")
     * @Method("GET")
     */
    public function refuserAction(Request $request,Demande_Remboursement $demande)
    {
        $em=$this->getDoctrine()->getManager();
        $repository_remboursement = $em->getRepository('PaieBundle:Demande_Remboursement');
        $Demande_Remboursements= $repository_remboursement->findOneBy(array('id'=>$demande->getId()));
        $Demande_Remboursements->getNotif()->setEtat(true);

           $Demande_Remboursements->setEtat('Demande refusée');
                $Demande_Remboursements->setUserRefuser($this->getUser());
                $Demande_Remboursements->setUserConfirme(null);
                $em->persist($Demande_Remboursements);
                $em->flush();

            return $this->render('@Back/dmdRemboursement/demande_confirmation.html.twig',array(
                'demandes'=>$Demande_Remboursements,
            ));
    }
    /**
     *  dmdRemboursement_ajouter entities.
     *
     * @Route("/ajouter-demande/n", name="demande_ajouter")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $repository_personne=$em->getRepository('PersonneBundle:Personne');

        $numero_demande=$this->recupererNumero();

        if($request->getMethod() == 'POST') {
            $personne=$repository_personne->findOneBy(array('id'=>$_POST['textid']));
            $Demande_Remboursement = new Demande_Remboursement();
            $repository_numDemande = $em
                ->getRepository('PaieBundle:Numero_demande');
            $numRetour = '';

            $qNumDemande = $repository_numDemande->findOneBy(array('id' => 1));
            $numDemande = $qNumDemande;
            $intNextNum = intval($numDemande->getNumeroDemande()) + 1;
            $nextNum = $intNextNum;

            if (strlen($intNextNum) == 1) {
                $nextNum = '000' . $intNextNum;
            }

            if (strlen($intNextNum) == 2) {
                $nextNum = '00' . $intNextNum;
            }

            if (strlen($intNextNum) == 3) {
                $nextNum = '0' . $intNextNum;
            }

            $numDemande->setNumeroDemande($nextNum);
            $em->persist($numDemande);
            $Demande_Remboursement->setPersonne($personne);
            $date = \DateTime::createFromFormat('d/m/Y H:i:s', $_POST['datetime_remboursement']);
            $Demande_Remboursement->setDate(new \DateTime($date));
            $Demande_Remboursement->setNumero($numero_demande);
            $Demande_Remboursement->setTypeCheque($_POST['cheque']);
            $Demande_Remboursement->setMontant($_POST['montant']);
            $Demande_Remboursement->setEtat('Demande acceptée');
            $Demande_Remboursement->setUserConfirme($this->getUser());
            $Demande_Remboursement->setUserCreer($this->getUser());
            $Demande_Remboursement->setUserRefuser(null);
            $Demande_Remboursement->setPaiement($_POST['paiement1']);

            $remboursement=new Remboursement();
            $remboursement->setDate(new \DateTime());
            $remboursement-> setPersonne($Demande_Remboursement->getPersonne());
            $remboursement->setDemandeReboursement($Demande_Remboursement);

            //-----Ajouter debit dans l'historique caisse---
            $caisse=$em->getRepository('BackBundle:Caisse')->findOneBy(array('nom'=>$_POST['caisse']));
            $historique_caisse=new Historique_Caisse();
            $historique_caisse->setPaiement($_POST['paiement1']);
            if($_POST['cheque1']){
                $monservice= new MonService();
                $historique_caisse->setPaiement('Chèque');
                $especeTocheque=New Cheque_Remboursement();
                $especeTocheque->setBanque($_POST['banque']);
                $especeTocheque->setDate(new \DateTime());
                $especeTocheque->setLibelle($_POST['libelle_cheque']);
                $especeTocheque->setNumero($_POST['num_cheque']);
                $remboursement->setCheque($especeTocheque);
                $historique_caisse->setCheque1($especeTocheque);
                if ($_POST['paiement1'] != 'Chèque'){
                    $Demande_Remboursement->setPaiementadmin('Chèque');
                }

                if ($_FILES['fichier_cheque']['size'] > 0){
                    if($scan = $monservice->uploadFichier('cheque_remboursement', 'cheque', 'fichier_cheque')){
                        $especeTocheque->setScanUrl($scan) ;
                    }else{
                        return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                    }
                }
                $em->persist($especeTocheque);

            }
            $em->persist($Demande_Remboursement);
            $historique_caisse->setRemboursement($remboursement);
            $em->persist($remboursement);
            $em->flush();
            $historique_caisse->setCompteCaisse($caisse->getCompteCaisse());
            $historique_caisse->setDate(new \DateTime());
            $historique_caisse->setType('debit');
            $historique_caisse->setLibelle('Remboursement');
            $historique_caisse->setLien($this->generateUrl('Remboursement_detail',array('id'=>$remboursement->getId())));

            $historique_caisse->setMontant($Demande_Remboursement->getMontant());





            //----AJOUTER DEBIT DANS L'HISTORIQUE-----

            $compte_Paie = $personne->getComptePaie();
            $historique_paie = new Historique_Paie();
            $historique_paie->setComptePaie($compte_Paie);
            $historique_paie->setDemandeReboursement($Demande_Remboursement);
            $historique_paie->setDate(new \DateTime($date));
            $historique_paie->setLibelle('Remboursement ');
            $historique_paie->setMontant($Demande_Remboursement->getMontant());
            $historique_paie->setType('debit');
            $em->persist($historique_paie);
            $em->persist($historique_caisse);
            $em->flush();

            return $this->redirectToRoute('Remboursement_detail', array('id' => $remboursement->getId()));

        }

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
