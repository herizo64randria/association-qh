<?php

namespace BackBundle\Controller;
use AppBundle\Service\MonService;
use BackBundle\Entity\Historique_Caisse;
use PaieBundle\Entity\Cheque_Versement;
use PaieBundle\Entity\Compte_Paie;
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
 * versementBack controller.
 *
 * @Route("/dash/versement/v")
 */
class versementController extends Controller
{
    /**
     * Versement_liste entities.
     *
     * @Route("/versement_liste", name="dmdVersement_liste")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $versements=$em->getRepository('PaieBundle:Versement')->findAll();
        return $this->render('@Back/versement/versement_liste.html.twig', array('versements' => $versements));
    }

    /**
     * formulaire_versement_confirme entities.
     *
     * @Route("/formulaire-versement/{id}", name="formulaireVersement")
     * @Method({"GET", "POST"})
     */
    public function formulaireConfirmeVersementAction(Versement $versement)
    {
        $em=$this->getDoctrine()->getManager();
        $versements=$em->getRepository('PaieBundle:Versement')->find($versement);
        return $this->render('@Back/versement/formulaire_confirme_versement.html.twig', array('versements' => $versements));
    }
    /**
     * versement_confirme entities.
     *
     * @Route("/n/confirmation-versement/AZE{id}34XRT", name="confirmationVersement")
     * @Method({"GET", "POST"})
     */
    public function ConfirmeVersementAction(Versement $versement)
    {
        $em=$this->getDoctrine()->getManager();
        $versements=$em->getRepository('PaieBundle:Versement')->find($versement);
        $versements->setUserConfirme($this->getUser());
        $versements->setEtat('Demande acceptée');
        $versements->setUserRefuse(null);
        $personne=$versement->getPersonne();
        $versement->getNotif()->setEtat(true);

        //----AJOUTER CREDIT DANS L'HISTORIQUE-----

        $compte_Paie=$personne->getComptePaie();
        $historique_paie = new Historique_Paie();
        $historique_paie->setComptePaie($compte_Paie);
        $historique_paie->setDate(new \DateTime());
        if ($versement->getProcuration()){
            $historique_paie->setLibelle('Versement par '.$versement->getProcuration()->getNom());
        }else{
            $historique_paie->setLibelle('Versement ');
        }

        $historique_paie->setMontant($versement->getMontant());
        $historique_paie->setType('credit');
        $em->persist($historique_paie);
        $em->flush();
        return $this->render('@Back/versement/formulaire_confirme_versement.html.twig', array('versements' => $versements));
    }

    /**
     * versement_refuser entities.
     *
     * @Route("/versement/refuser/ADR46{id}4T", name="versement_refuser")
     * @Method("GET")
     */
    public function refuserAction(Versement $versement)
    {
        $em=$this->getDoctrine()->getManager();
        $versements=$em->getRepository('PaieBundle:Versement')->find($versement);
        $versements->setUserRefuse($this->getUser());
        $versements->setEtat('Demande refusée');
        $versements->setUserConfirme(null);
        $versement->getNotif()->setEtat(true);

        $em->persist($versements);
        $em->flush();

        return $this->render('@Back/versement/formulaire_confirme_versement.html.twig', array('versements' => $versements));
    }
/**
 * Versement_ajouter entities.
 *
 * @Route("/nouveau/versement", name="versement_add")
 * @Method({"GET", "POST"})
 */
    public function addAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        if($request->getMethod()=='POST'){

            $repository_personne=$em->getRepository('PersonneBundle:Personne');
            $personne=$repository_personne->findOneBy(array('id'=>$_POST['textid']));
//            $compte_hussen=$em->getRepository('PaieBundle:Compte_Hussen')->findOneBy(array('id'=>$_POST['numero_id']));
            $versement=new Versement();
            $user=$this->getUser();
            $date = \DateTime::createFromFormat('d/m/Y', $_POST['datetime_versement']);
            $versement->setDate($date);
            if (isset($_POST['procuration'])){
                $procuration=$em->getRepository('PaieBundle:Procuration')->findOneBy(array('nom'=>$_POST['listProcuration'],'type'=>'procuration'));
                $versement->setProcuration($procuration);
            }
            $versement->setPersonne($personne);
            $versement->setUserCreer($user);
            $versement->setUserConfirme($user);
            $versement->setUserRefuse(null);
//            $versement->setCompteHussen($compte_hussen);
            $versement->setEtat('Demande acceptée');
            $versement->setMontant($_POST['montant']);
            $versement->setPaiement($_POST['paiement']);
            $em->persist($versement);
            $em->flush();

            $caisse=$em->getRepository('BackBundle:Caisse')->findOneBy(array('nom'=>$_POST['caisse']));
            $historique_caisse=new Historique_Caisse();
            $historique_caisse->setCompteCaisse($caisse->getCompteCaisse());
            $historique_caisse->setDate(new \DateTime());
            $historique_caisse->setType('credit');
            $historique_caisse->setLibelle('Versement');
            $historique_caisse->setLien($this->generateUrl('formulaireVersement',array('id'=>$versement->getId())));

            $historique_caisse->setMontant($versement->getMontant());
            $historique_caisse->setPaiement($_POST['paiement']);
            $historique_caisse->setVersement($versement);
            if (isset($_POST['cheque'])){
                $historique_caisse->setPaiement('Chèque');
                $especeTocheque=New Cheque_Versement();
                $especeTocheque->setBanque($_POST['banque']);
                $especeTocheque->setDate(new \DateTime());
                $especeTocheque->setLibelle($_POST['libelle_cheque']);
                $especeTocheque->setNumero($_POST['num_cheque']);
                $versement->setChequeVersement($especeTocheque);
                $historique_caisse->setCheque($especeTocheque);

                if ($_POST['paiement'] != 'Chèque'){
                    $versement->setPaiementAdmin('cheque');
                }


                if ($_FILES['fichier_cheque']['size'] > 0){
                    $monservice=new MonService();
                    if($scan = $monservice->uploadFichier('cheque_versement', 'cheque', 'fichier_cheque')){
                        $especeTocheque->setScanUrl($scan) ;
                    }else{
                        return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                    }
                }

                $em->persist($especeTocheque);
            }

            //----AJOUTER CREDIT DANS L'HISTORIQUE-----

            $compte_Paie=$personne->getComptePaie();
            $historique_paie = new Historique_Paie();
            $historique_paie->setComptePaie($compte_Paie);
            $historique_paie->setVersement($versement);
            $historique_paie->setDate($date);
            if (isset($_POST['procuration'])){
                $historique_paie->setLibelle('Versement fait par:' .$procuration->getNom());

            }else{
                $historique_paie->setLibelle('Versement');

            }
            $historique_paie->setMontant($versement->getMontant());
            $historique_paie->setType('credit');

            $em->persist($historique_paie);
            $em->persist($historique_caisse);

            $em->flush();
            return $this->redirect($this->generateUrl('paie_detail',array('slug'=>$compte_Paie->getSlug())));

        }

        return new Response( '404 not-found');

    }
}
