<?php

namespace DemandeQhBundle\Controller;

use AppBundle\Service\InscriptionService;
use AppBundle\Service\MonService;
use AppBundle\Service\MultipleUpload;
use DemandeQhBundle\Entity\Modification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Tests\Compiler\D;
use Symfony\Component\Routing\Annotation\Route;
use DemandeQhBundle\Entity\Etat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DemandeQhBundle\Entity\PhotoOr;
use DemandeQhBundle\Entity\DemandeQh;
use DemandeQhBundle\Entity\Garant ;
use DemandeQhBundle\Entity\Dossier ;
use DemandeQhBundle\Entity\GarantieOr ;
use PersonneBundle\Entity\Personne;
class DefaultController extends Controller
{
    public function choixAction()
    {
        return $this->render('@DemandeQh/demande/pagechoix.html.twig');

    }
    public function dateAction()
    {

            $tps_restant =$this->dateDiff("2019/05/21",3) ;
            return new Response(var_dump($tps_restant['day']));


    }
    public function dateDiff($date,$x)
    {
        $date2=time();
        $d=date_create($date);
        date_modify($d,"+$x days");
        $date=date_format($d,"Y/m/d");
        $date1 = strtotime($date);
        $diff = $date1 - $date2;
        $retour = array();

        $tmp = $diff;
        $retour['second'] = $tmp % 60;

        $tmp = floor( ($tmp - $retour['second']) /60 );
        $retour['minute'] = $tmp % 60;

        $tmp = floor( ($tmp - $retour['minute'])/60 );
        $retour['hour'] = $tmp % 24;

        $tmp = floor( ($tmp - $retour['hour'])  /24 );
        $retour['day'] = $tmp;

        return $retour;
    }
    public function societeQhAction()
    {
        return $this->render('@DemandeQh/societe/societe.html.twig');

    }
    public function addmembresocieteQhAction()
    {
        return $this->render('@DemandeQh/societe/membre_societe.html.twig');

    }

    public function inscriptiontestAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $insc= new InscriptionService();
        $insc->InscriptionInfo($em,$user);
        if($insc->InscriptionInfo($em,$user))
        {
           $res="complet" ;
        }
        else
        {
           $res="Incomplet" ;
        }
        return new  Response($res);

    }
    // ARCHIVE partie admin ito fonctionaliter
    public function archiveAction(Request $request )
    {

        $em=$this->getDoctrine()->getManager();
        $demandeQhs = $em->getRepository('DemandeQhBundle:DemandeQh')
            ->createQueryBuilder('demandeqh')
            ->join('demandeqh.personne', 'personne')
            ->distinct()
            ->getQuery()
            ->getResult();
        $personnes = array();
        foreach ($demandeQhs as $demandeQh){
            if (! in_array($demandeQh->getPersonne(),$personnes)){
                array_push($personnes, $demandeQh->getPersonne());
            }
        }
        return $this->render('@Back/archive/archive.html.twig',array('personnes'=>$personnes));

    }
    public function listeArchiveAction(Request $request,Personne $personne)
    {

        $em=$this->getDoctrine()->getManager();
        $demandeQH = $em->getRepository('DemandeQhBundle:DemandeQh')->findBy(array('personne'=>$personne));


        return $this->render('@Back/archive/liste_archive_demandeqh.html.twig',
            array('demandeQHs'=>$demandeQH,'personne'=>$personne,));

    }

    public function detailArchiveAction(Request $request,DemandeQh $demande)
    {

        $garantior= $demande->getGarantieOR();

        $em=$this->getDoctrine()->getManager();
        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));
        $demandeQh=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demande));
        $dossier=$em-> getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$demande->getNumero()));

        if($demandeQh->getNomEtat()=='Acceptée')
        {
            return $this->render('@Back/archive/detailArchive.html.twig',array('demandeQH'=>$demandeQh,
                'photoor'=>$photoor,'dossier'=>$dossier
            ));
        }
        else
        {
            return $this->render('@Back/archive/detailArchiveRefuser.html.twig',array('demandeQH'=>$demandeQh,
                'photoor'=>$photoor,'dossier'=>$dossier
            ));
        }

    }
    // ARCHIVE  Fin


    // Modification partie utilisateur
    public function testAction(Request $request , DemandeQh $demande)
    {
        $garantior= $demande->getGarantieOR();

        $em=$this->getDoctrine()->getManager();
        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));
        $demandeQh=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demande));
        $dossier=$em-> getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$demande->getNumero()));

        if($demandeQh->getNomEtat()=='Acceptée')
        {
            return $this->render('@DemandeQh/dossier/DossierDetailAccepter.html.twig',array('demandeQH'=>$demandeQh,
                'photoor'=>$photoor,'dossier'=>$dossier
            ));

        }
        else
            {
                return $this->render('@DemandeQh/demande/DemandeDetailRefuser.html.twig',array('demandeQH'=>$demandeQh,
                    'photoor'=>$photoor,'dossier'=>$dossier
                ));
            }


    }

    public function modificationDemandeqhAction(Request $request , DemandeQh $demandeQH)
    {
        if($request->getMethod()== 'POST') {
            $em = $this->getDoctrine()->getManager();
            $demandeQH->SetSiAncienDemande($_POST['resume_question']);
            $demandeQH->setMontant($_POST['montant']);
            $demandeQH->setNombreMois($_POST['mois']);
            $demandeQH->setTypeMotif($_POST['motif']);
            $demandeQH->setDetailMotif($_POST['detail']);
            if($demandeQH->getSiAncienDemandeEtat()=='oui' and $demandeQH->getSiAncienDemande()=='oui' )
            {
                $demandeQH->setAnnee1($_POST['annee1']);
                $demandeQH->setMontant1($_POST['montant1']);
                $demandeQH->setAnnee2($_POST['annee2']);
                $demandeQH->setMontant2($_POST['montant2']);
                $demandeQH->setAnnee3($_POST['annee3']);
                $demandeQH->setMontant3($_POST['montant3']);
                $demandeQH->SetSiAncienDemandeEtat($_POST['resume_etat']);
            }


            $demandeQH->getGarantieOR()->getValeurAr($_POST['or']);
            $em->persist($demandeQH);
            $em->flush();
            return $this->redirectToRoute('_test',array('id'=>$demandeQH->getId()));
        }
        return $this->render('@DemandeQh/demande/modification_demandeqh.html.twig',array('demandeQH'=>$demandeQH));

    }

    public function modificationDossierAction(Request $request , Dossier $dossier)
    {

        $em = $this->getDoctrine()->getManager();
        $demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$dossier->getNumeroDossier()));

        if($request->getMethod()== 'POST') {

            $monservice = new MonService();

            if($scan = $monservice->uploadFichier('dossier', 'scan','safahi')){

                $dossier->setSafahi($scan);

            }

            if( $scan1 = $monservice->uploadFichier('dossier', 'scan','attestation_compte')){

                $dossier->setAttestationCopmteBank($scan1) ;
            }

            if( $scan2 = $monservice->uploadFichier('dossier', 'scan','attestation_solde')){
                $dossier->setAttestationSoldeCompte($scan2);
            }

            if($scan = $monservice->uploadFichier('dossier', 'scan','formulaire_garant')){
                $dossier->setFormulaireGarantie($scan) ;
            }
            if($scan1 = $monservice->uploadFichier('dossier', 'scan','chequebarre')){
                $dossier->setChequeBare($scan1) ;
            }
            if($scan2 = $monservice->uploadFichier('dossier', 'scan','cheque1barre')){
                $dossier->setCheque1Bare($scan2) ;
            }
            if($scan3 = $monservice->uploadFichier('dossier', 'scan','cheque2barre')){
                $dossier->setCheque2Bare($scan3) ;
            }
            if($scan = $monservice->uploadFichier('dossier', 'scan','formulaire_garant1')){
                $dossier->setFormulaireGarantie1($scan) ;
            }
            if($scan1 = $monservice->uploadFichier('dossier', 'scan','chequebarre1')){
                $dossier->setChequeBare1($scan1) ;
            }
            if($scan2 = $monservice->uploadFichier('dossier', 'scan','cheque1barre1')){
                $dossier->setCheque1Bare1($scan2) ;
            }
            if($scan3 = $monservice->uploadFichier('dossier', 'scan','cheque2barre1')){
                $dossier->setCheque2Bare1($scan3) ;
            }
            $em->persist($dossier);
            $em->flush();

            return $this->redirectToRoute('_test',array('id'=>$demandeqh->getId()));

        }
        return $this->render('@DemandeQh/dossier/modification_dossier.html.twig',array('dossier'=>$dossier));

    }

    public function modificationGarant1Action(Request $request , Garant $garant)
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

            if(isset($_FILES['cin']))
            {

                if($res = $uploads->uploadFichiers('cin','cin','cin'))
                {
                    $garant->setCin(null);
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
             return $this->redirectToRoute('_Mydetail',array('id'=>$demandeqh->getId()));

             }
        return $this->render('@DemandeQh/garant/modification_garant1.html.twig',array('garant'=>$garant,
            'demandeqh'=>$demandeqh));

    }
    public function modificationGarant2Action(Request $request , Garant $garant)
    {
        $em=$this->getDoctrine()->getManager();
        $demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('garant2'=>$garant));

        if($request->getMethod()== 'POST') {

            if(!empty($_POST['ne']))
            {
                $ne = \DateTime::createFromFormat('d/m/Y',$_POST['ne']);
                $garant->setDateNaissance($ne);
            }
            $uploads= new MultipleUpload();
            $upload = new MonService();
            $tab_cin = array();

            if(isset($_FILES['cin']))
            {

                if($res = $uploads->uploadFichiers('cin','cin','cin'))
                {
                    $garant->setCin(null);
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cin,array(
                            'url' => $res[$i],
                        ));
                    }

                    $garant->setScanits($tab_cin);
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
            return $this->redirectToRoute('_Mydetail',array('id'=>$demandeqh->getId()));

        }
        return $this->render('@DemandeQh/garant/modification_garant2.html.twig',array('garant'=>$garant,
            'demandeqh'=>$demandeqh));

    }
    // Modification coté utilisateur fin

}
