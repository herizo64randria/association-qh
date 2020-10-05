<?php

namespace BackBundle\Controller;
use AppBundle\Service\MonService;
use BackBundle\Entity\Caisse;
use BackBundle\Entity\Compte_Caisse;
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
 * paieBack controller.
 *
 * @Route("/")
 */
class comptePaieController extends Controller
{

    /**
     * paie_liste entities.
     *
     * @Route("/dash/liste-compte/", name="paie_liste1")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();

        $personnes=$em->getRepository('PersonneBundle:Personne')->createQueryBuilder('personne')
            ->where('personne.userCompte IS NOT NULL')
            ->getQuery()->getResult();

        return $this->render('@Back/paie/paie_liste.html.twig', array(
           'personnes'=>$personnes
        ));

    }
//    /**
//     * notification entities.
//     *
//     * @Route("/notification/", name="notification")
//     */
//    public function notificationAction()
//    {
//        $em=$this->getDoctrine()->getManager();
//
//        $personnes=$em->getRepository('PersonneBundle:Personne')->createQueryBuilder('personne')
//            ->where('personne.userCompte IS NOT NULL')
//            ->getQuery()->getResult();
//
//        return $this->render('@Back/paie/paie_liste.html.twig', array(
//            'personnes'=>$personnes
//        ));
//
//    }
    /**
     * Paie_detail controller.
     *
     * @Route("/dash/compte-hussein-scheme/{slug}", name="paie_detail")
     * @Method("GET")
     */
    public function detailAction(Compte_Paie $compte_Paie)
    {
        $em=$this->getDoctrine()->getManager();
        $numero_demande=$this->recupererNumero();
        $personnes=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('comptePaie'=>$compte_Paie));
        $historique=$em->getRepository('PaieBundle:Historique_Paie')->findBy(
            array('comptePaie'=>$compte_Paie),
            array('date' => 'asc')
        );
        $caisses=$em->getRepository('BackBundle:Caisse')->findAll();
        $procurations = $em->getRepository('PaieBundle:Procuration')->findBy(array('type'=>'procuration','personne'=>$personnes));
        $numero_compte=$em->getRepository('PaieBundle:Compte_Hussen')->findOneBy(array('id'=>1));
        return $this->render('@Back/paie/paie_detail.html.twig',array(
            'historique'=>$historique,
            'pers'=>$personnes,
            'numero'=>$numero_compte,
            'num'=>$numero_demande,
            'procurations'=>$procurations,
            'caisses'=>$caisses

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

//-------------------------Caisse&Banque--------------------------
    /**
     * @Route("/caisse-banque",name="listeCaisse")
     */
    public function listeCaisseBanqueAction()
    {
        $em=$this->getDoctrine()->getManager();
        $caisses=$em->getRepository('BackBundle:Caisse')->findAll();
       // $banques=$em->getRepository('Banque')->findAll();
        return $this->render('@Back/CompteCaisse/index.html.twig',array('caisses'=>$caisses));
    }
    /**
     * @Route("/caisse-ajout",name="addCaisse")
     */
    public function addCaisseAction(Request $request)
    {
        if($request->getMethod()=='POST'){
            $em=$this->getDoctrine()->getManager();
            $caisse=new Caisse();
            $monservice=new MonService();
            $caisse->setNom($_POST['nom']);
            $caisse->setDetail($_POST['detail']);
            $compteCaisse=new Compte_Caisse();
            $compteCaisse->setSlug($monservice->randomLettre(10));
            $caisse->setCompteCaisse($compteCaisse);
            if(isset($_FILES['logo']))
            {
                if($logo = $monservice->uploadFichier('logo', 'logo', 'logo')){
                    $caisse->setLogo($logo) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
            $em->persist($compteCaisse);
            $em->persist($caisse);
            $em->flush();
            return  $this->redirectToRoute('listeCaisse');

        }
    }
    /**
     * @Route("/banque-ajout",name="addBanque")
     */
    public function addBanqueAction(Request $request)
    {
        if($request->getMethod()=='POST'){
            $em=$this->getDoctrine()->getManager();
            $caisse=new Caisse();
            $monservice=new MonService();
            $caisse->setNom($_POST['nom']);
            $caisse->setDetail($_POST['detail']);
            $compteCaisse=new Compte_Caisse();
            $compteCaisse->setSlug($monservice->randomLettre(10));
            $caisse->setCompteCaisse($compteCaisse);
            if(isset($_FILES['logo']))
            {
                if($logo = $monservice->uploadFichier('logo', 'logo', 'logo')){
                    $caisse->setLogo($logo) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
            $em->persist($compteCaisse);
            $em->persist($caisse);
            $em->flush();
            return  $this->redirectToRoute('listeCaisse');

        }

    }
    /**
     * @Route("/caisse-detail/{id}",name="detailCaisse")
     */
    public function detailCaisseAction(Request $request,Caisse $caisse)
    {
         $em=$this->getDoctrine()->getManager();
         $historique_caisses=$em->getRepository('BackBundle:Historique_Caisse')->findBy(array('compteCaisse'=>$caisse->getCompteCaisse()));
        return $this->render('@Back/CompteCaisse/detail.html.twig',array('caisse'=>$caisse,'historique_caisses'=>$historique_caisses));
    }
    /**
     * @Route("/cheque-espece",name="echangeEspece")
     */
    public function echangeEspeceAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $histo_caisse=$em->getRepository('BackBundle:Historique_Caisse')->find($_POST['id']);
        $histo_caisse->setPaiement('Espèce');
        $histo_caisse->setModif(true);
        $em->flush();
        $caisse=$em->getRepository('BackBundle:Caisse')->findOneBy(array('compteCaisse'=>$histo_caisse->getCompteCaisse()));
        return $this->redirectToRoute('detailCaisse',array('id'=>$caisse->getId()));
    }
    /**
     * @Route("/espece-cheque",name="echangeCheque")
     */
    public function echangeChequeAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $histo_caisse=$em->getRepository('BackBundle:Historique_Caisse')->find($_POST['id']);
        $histo_caisse->setPaiement('Chèque');
        $monservice= new MonService();
        $especeTocheque=New Cheque_Versement();
        $especeTocheque->setBanque($_POST['banque']);
        $especeTocheque->setDate(new \DateTime());
        $especeTocheque->setLibelle($_POST['libelle_cheque']);
        $especeTocheque->setNumero($_POST['num_cheque']);
        $histo_caisse->setCheque($especeTocheque);
        $histo_caisse->setModif(true);


        if ($_FILES['fichier_cheque']['size'] > 0){
            if($scan = $monservice->uploadFichier('cheque_remboursement', 'cheque', 'fichier_cheque')){
                $especeTocheque->setScanUrl($scan) ;
            }else{
                return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
            }
        }
        $em->persist($especeTocheque);
        $em->flush();
        $caisse=$em->getRepository('BackBundle:Caisse')->findOneBy(array('compteCaisse'=>$histo_caisse->getCompteCaisse()));
        return $this->redirectToRoute('detailCaisse',array('id'=>$caisse->getId()));
    }
    /**
     * @Route("/statistique",name="statistique")
     */
    public function statistiqueAction(Request $request)
    {
        return $this->render('@Back/CompteCaisse/statistique.html.twig');
    }

//----------------------------------------------------------------
}
