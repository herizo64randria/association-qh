<?php

namespace DemandeQhBundle\Controller;


use AppBundle\Service\MonService;
use AppBundle\Service\MultipleUpload;
use AppBundle\Service\InfoGarantService;
use DemandeQhBundle\Entity\EtatSociete;
use DemandeQhBundle\Entity\Garant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PersonneBundle\Entity\Personne;
use Symfony\Component\Routing\Annotation\Route;
use DemandeQhBundle\Entity\SocieteDemandeQH;
/**
 * societedemandeQh controller.
 *
 */
class SocieteDemandeQHController extends Controller
{
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/accueil-societe", name="acceuil_societe")
     * @Method({"GET","POST"})
     */
    public function homeAction(Request $request)
    {
       return $this->render('@DemandeQh/societe/accueilsociete.html.twig');
    }
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/detail-demandesociete/AZDF34{id}D5FT", name="detail_demandesociete")
     * @Method({"GET","POST"})
     */
    public function deatailAction(Request $request,SocieteDemandeQH $demandeQH)
    {
        $em = $this->getDoctrine()->getManager();
        $res=array();
        $garant = $em->getRepository('DemandeQhBundle:Garant')->findBy(array('societe_demandeqh'=>$demandeQH));
        $tabgarant = $em->getRepository('DemandeQhBundle:Garant')->findBy(array('societe_demandeqh'=>$demandeQH));
        foreach ($tabgarant as $tabgarant)
        {
            $infogarant = new InfoGarantService();

            array_push($res,array(
                'index'=>$infogarant->testInfo($tabgarant),
            ));

        }
        if($request->getMethod()== 'POST') {

            $demandeQH->getEtat()->setNometat('En attente de confirmation');
            $dateTime = new \DateTime('now');
            $demandeQH->setDateenvoie($dateTime);
            $em->persist($demandeQH);
            $em->flush(); 
            return $this->redirectToRoute('detail_demandesociete',array('id'=>$demandeQH->getId()));

        }
            return $this->render('@DemandeQh/societe/detail_demade_societe.html.twig',array('demandeQH'=>$demandeQH,
            'garants'=>$garant,'res'=>$res));
    }
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/ajax-modifgarant", name="ajax_modifgarants")
     * @Method({"GET","POST"})
     */
    public function garants_ajaxmodifAction(Request $request)
    {
        if( $request->isXmlHttpRequest()) {
            $t1 = $request->request->all();
            $this->redirectToRoute('modif_demandesociete',array('id'=>$t1['id']));
            return 1;
        }
    }
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/modification-demandesociete/AZDF34{id}D5FT", name="modif_demandesociete")
     * @Method({"GET","POST"})
     */
    public function modifdemandesocieteAction(Request $request,Garant $garant)
    {

        $em=$this->getDoctrine()->getManager();
        $demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('garant1'=>$garant));

        if($request->getMethod()== 'POST') {

            $em = $this->getDoctrine()->getManager();

            if(!empty($_POST['ne']))
            {
                $ne = \DateTime::createFromFormat('d/m/Y',$_POST['ne']);
                $garant->setDateNaissance($ne);
            }

            $uploads= new MultipleUpload();
            $upload = new MonService();
            $tab_cin = array();
            $images=$_FILES['cin'];
            $name = count($images['name']);
            if($images['name'][0]!="")
            {  $tab_cin = array();
                if($res = $uploads->uploadFichiers('cin','cin','cin'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cin,array(
                            'url' => $res[$i],
                        ));

                    }

                    $garant->setCin($tab_cin);
                }
            }
            if (isset($_FILES['scanits']))
            {

                if ($res1 = $upload->uploadFichier('carte', 'carte', 'scanits')) {
                    $garant->setScanits(null);
                    $garant->setScanits($res1);
                }
            }
            $garant->setNomcin($_POST['nom']);
            $garant->setPrenomcin($_POST['prenom']);
            $garant->setLieu($_POST['lieu']);
            $garant->setAdresse($_POST['adresse']);
            $garant->setVille($_POST['ville']);
            $garant->setNationalite($_POST['nationalite']);
            $garant->setTypePiece($_POST['type']);
            $garant->setNumeroPiece($_POST['numero']);

            if(!empty($_POST['date']))
            {
                $date= \DateTime::createFromFormat('d/m/Y',$_POST['date']);
                $garant->setDatePiece($date);
            }

            $garant->setVillePiece($_POST['villepiece']);
            $garant->setPaysPiece($_POST['pays']);
            $garant->setProfession($_POST['profession']);
            $garant->setTel1($_POST['tel1']);
            $garant->setTel2($_POST['tel2']);
            $garant->setEmail($_POST['email']);
            $garant->setNumerocheque1($_POST['numerocheque1']);
            $garant->setMontantcheque1($_POST['montantcheque1']);
            $garant->setBanquecheque1($_POST['banquecheque1']);

            if(!empty($_POST['datecheque1']))
            {
                $datecheque1 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque1']);
                $garant->setDatetcheque1($datecheque1);
            }

            $garant->setNumerocheque2($_POST['numerocheque2']);
            $garant->setMontantcheque2($_POST['montantcheque2']);
            $garant->setBanquecheque2($_POST['banquecheque2']);

            if(!empty($_POST['datecheque2']))
            {
                $datecheque2 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque2']);
                $garant->setDatetcheque2($datecheque2);
            }

            $garant->setNumerocheque3($_POST['numerocheque3']);
            $garant->setMontantcheque3($_POST['montantcheque3']);
            $garant->setBanquecheque3($_POST['banquecheque3']);

            if(!empty($_POST['datecheque3']))
            {
                $datecheque3 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque3']);
                $garant->setDatetcheque3($datecheque3);
            }

            $garant->setNomheritier1($_POST['nomheritier']);
            $garant->setPrenomheritier1($_POST['prenomheritier']);
            $garant->setSexe($_POST['sexe']);
            $em->persist($garant);
            $em->flush();
//            return $this->redirectToRoute('ajouter_dossier_garant1');
            return $this->redirectToRoute('modif_demandesociete',array('id'=>$garant->getId()));

        }
        return $this->render('@DemandeQh/societe/edit_demande_societe.html.twig',array('garant'=>$garant,
            'demandeqh'=>$demandeqh));
    }
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/ajax-garant", name="ajax_garants")
     * @Method({"GET","POST"})
     */
    public function garants_ajaxAction(Request $request)
    {
        if( $request->isXmlHttpRequest())
        {
            $t1 = $request->request->all();
            $infogarant = new InfoGarantService();
            $em = $this->getDoctrine()->getManager();
            $garant = $em->getRepository('DemandeQhBundle:Garant')->findOneBy(array('id' => $t1['id']));
            $res=$infogarant->testInfo($garant);
            return new Response(var_dump($res));
        }
    }
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/liste-demandeqh-societe", name="liste_demandeqh_societe")
     * @Method({"GET","POST"})
     */
    public function listeAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
        $demandeQH=$em->getRepository('DemandeQhBundle:SocieteDemandeQH')->findBy(array('personne'=>$personne));
        return $this->render('@DemandeQh/societe/liste_demande_societe.html.twig',array('demandeQHs'=>$demandeQH));
    }
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/nouvelle-demandeQhSociete", name="nouvelle_SocieteDemandeQH")
     * @Method({"GET","POST"})
     */
    public function AddAction(Request $request)
    {
        $numeroqh_demande=$this->recupererNumero();
        $monservice=new MonService();
        $em=$this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST')
        {

            $em = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            $societedemandeqh= new SocieteDemandeQH();
            $etatsociete= new EtatSociete();
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
            $repository_numDemande = $em->getRepository('DemandeQhBundle:NumeroQH_demande');
            $qNumDemande = $repository_numDemande->findOneBy(array('id'=>1));
            $numDemande = $qNumDemande;
            $intNextNum = $numDemande->getIntnumeroQH() + 1;
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

            $numDemande->setIntnumeroQH($intNextNum);
            $numDemande->setNumeroQH($nextNum);
            $personne->setNumeroDemandeQHtemp($numeroqh_demande);

            $em->persist($personne);
            $em->persist($numDemande);

            $etatsociete->setNometat(null);

            $societedemandeqh->setNumero($_POST['numero']);
            $societedemandeqh->setSociete($_POST['societe']);
            $date = \DateTime::createFromFormat('d/m/Y', $_POST['date']);
            $societedemandeqh->setDatedemande($date);
            $societedemandeqh->setMontant($_POST['montant']);
            $societedemandeqh->setNombremois($_POST['mois']);
            $societedemandeqh->setMotif($_POST['motif']);
            $societedemandeqh->setPersonne($personne);
            $societedemandeqh->setEtat($etatsociete);
            $em->persist($etatsociete);
            $em->persist($societedemandeqh);
            $em->flush();
            return $this->redirectToRoute('Garant-Societe',array('id'=>$societedemandeqh->getId()));

        }

        return $this->render('@DemandeQh/societe/societeDemandeQH.html.twig',array('numero'=>$numeroqh_demande));
    }
    /* Fonction Recuperer Numero_demande QH */
    public function recupererNumero(){

        $em = $this->getDoctrine()->getManager();

        $repository_numDemande = $em->getRepository('DemandeQhBundle:NumeroQH_demande');

        $numRetour = '';

        $qNumDemande = $repository_numDemande->findOneBy(array('id'=>1));

        $numDemande = $qNumDemande;

        $numRetour = $numDemande->getNumeroQH().'/QH';

        return $numRetour;

    }
    /**
     * SocieteDemandeQH entities.
     *
     * @Route("/garant-societe/AZS23{id}4RT", name="Garant-Societe")
     * @Method({"GET","POST"})
     */
    public function garantAction(Request $request,SocieteDemandeQH $dmdsociete)
    {

        if($request->getMethod() == 'POST')
        {
            $em = $this->getDoctrine()->getManager();
            $uploads= new MultipleUpload();
            $upload = new MonService();

            $garant = new Garant();

            $images=$_FILES['cin'];
            $name = count($images['name']);

            $garant->setSocieteDemandeqh($dmdsociete);
            $garant->setNomcin($_POST['nom']);
            $garant->setPrenomcin($_POST['prenom']);
            $garant->setNomIts($_POST['nomits']);
            $garant->setNumeroIts($_POST['num_its']);
            $garant->setLieu($_POST['lieu']);
            $garant->setAdresse($_POST['adresse']);
            $garant->setVille($_POST['ville']);
            $garant->setNationalite($_POST['nationalite']);
            $garant->setTypePiece($_POST['type']);
            $garant->setNumeroPiece($_POST['numero']);
            $garant->setVillePiece($_POST['villepiece']);
            $garant->setPaysPiece($_POST['pays']);
            $garant->setProfession($_POST['profession']);
            $garant->setTel1($_POST['tel1']);
            $garant->setTel2($_POST['tel2']);
            $garant->setEmail($_POST['email']);
            $garant->setNumerocheque1($_POST['numerocheque1']);
            $garant->setMontantcheque1($_POST['montantcheque1']);
            $garant->setBanquecheque1($_POST['banquecheque1']);
            $garant->setNumerocheque2($_POST['numerocheque2']);
            $garant->setMontantcheque2($_POST['montantcheque2']);
            $garant->setBanquecheque2($_POST['banquecheque2']);
            $garant->setNumerocheque3($_POST['numerocheque3']);
            $garant->setMontantcheque3($_POST['montantcheque3']);
            $garant->setBanquecheque3($_POST['banquecheque3']);
            $garant->setNomheritier1($_POST['nomheritier']);
            $garant->setPrenomheritier1($_POST['prenomheritier']);
            $garant->setSexe($_POST['sexe']);
            if(!empty($_POST['ne']))
            {
                $ne = \DateTime::createFromFormat('d/m/Y',$_POST['ne']);
                $garant->setDateNaissance($ne);
            }
            if(!empty($_POST['date']))
            {
                $date= \DateTime::createFromFormat('d/m/Y',$_POST['date']);
                $garant->setDatePiece($date);
            }
            if(!empty($_POST['datecheque1']))
            {
                $datecheque1 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque1']);
                $garant->setDatetcheque1($datecheque1);
            }
            if(!empty($_POST['datecheque2']))
            {
                $datecheque2 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque2']);
                $garant->setDatetcheque2($datecheque2);
            }
            if(!empty($_POST['datecheque3']))
            {
                $datecheque3 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque3']);
                $garant->setDatetcheque3($datecheque3);
            }
            if($images['name'][0]!="")
            {  $tab_cin = array();
                if($res = $uploads->uploadFichiers('cin','cin','cin'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cin,array(
                            'url' => $res[$i],
                        ));

                    }

                    $garant->setCin($tab_cin);
                }
            }

            if (isset($_FILES['scanits']))
            {
                if ($res1 = $upload->uploadFichier('carte', 'carte', 'scanits')) {
                    $garant->setScanits($res1);
                }
            }
            $em->persist($garant);
            $em->flush();
            return $this->redirectToRoute('liste_demandeqh_societe');
        }
        return $this->render('@DemandeQh/societe/garant_societe.html.twig');
    }

}
