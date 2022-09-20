<?php

namespace DemandeQhBundle\Controller;
use AppBundle\Service\ChiffresEnLettres;
use AppBundle\Service\InfoDossierService;
use AppBundle\Service\MonService;
use AppBundle\Service\MultipleUpload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DemandeQhBundle\Entity\DemandeQh;
use DemandeQhBundle\Entity\Garant;
use DemandeQhBundle\Entity\GarantieOr;
use DemandeQhBundle\Entity\PhotoOr;
use PersonneBundle\Entity\Personne;
use DemandeQhBundle\Entity\NumeroQH_demande;
use DemandeQhBundle\Entity\Etat;
use DemandeQhBundle\Entity\Dossier;

/**
 * dossier controller.
 *
 */
class dossierController extends Controller
{
    /**
     * dossier entities.
     *
     * @Route("/boutton_dossier/{id}", name="boutton_dossier")
     * @Method({"GET","POST"})
     */
    public function boutton_dossierAction(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
           if($demandeqh->getDossier()){
               return $this->render('@DemandeQh/demande/infoDoc.html.twig',array('demandeqh'=>$demandeqh,'demandeQH'=>$demandeqh));

           }else{
               return $this->render('@DemandeQh/dossier/doc.html.twig',array('demandeqh'=>$demandeqh));

           }
//            return $this->render('@DemandeQh/demande/infoDoc.html.twig',array('demandeqh'=>$demandeqh,'demandeQH'=>$demandeqh));



    }
    /**
     * dossier entities.
     *
     * @Route("/dossier/{id}", name="fournir_dossier")
     * @Method({"GET","POST"})
     */
    public function fournir_dossierAction(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        if($request->getMethod() == 'POST') {
            return $this->redirectToRoute('boutton_dossier',array('id'=>$demandeqh->getId()));
/*            return $this->render('@DemandeQh/dossier/doc.html.twig',array('demandeqh'=>$demandeqh));*/
        }

        return $this->render('@DemandeQh/demande/infodossier.html.twig',array('demandeqh'=>$demandeqh));
    }
    /**
     * dossier entities.
     *
     * @Route("/Ajouter_garant_dossier_qh/{id}", name="ajouter_garant_dossier_qh")
     * @Method({"GET","POST"})
     */
    public function ajouter_garant_dossierAction(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        if($request->getMethod() == 'POST') {
            $dossier=$demandeqh->getDossier();
            $uploads= new MultipleUpload();
            $monservice = new MonService();
            $tab_cin = array();
            $tab_cin1 = array();
            $tab_cheque= array();
            $tab_cheque1= array();
            if(isset($_FILES['cheques']))
            {
                if($res = $uploads->uploadFichiers('cheque','cheque','cheques'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cheque,array(
                            'url' => $res[$i],
                        ));
                    }
                    $dossier->setChequesG1($tab_cheque);
                }
            }
            if(isset($_FILES['cheques1']))
            {
                if($res = $uploads->uploadFichiers('cheque','cheque','cheques1'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cheque1,array(
                            'url' => $res[$i],
                        ));
                    }
                    $dossier->setChequesG2($tab_cheque1);
                }
            }
            if(isset($_FILES['cin']))
            {
                if($res = $uploads->uploadFichiers('cin','cin','cin'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cin,array(
                            'url' => $res[$i],
                        ));
                    }
                    $dossier->setPieceG1($tab_cin);
                }
            }
            if(isset($_FILES['cin1']))
            {
                if($res = $uploads->uploadFichiers('cin','cin','cin1'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cin1,array(
                            'url' => $res[$i],
                        ));
                    }
                    $dossier->setPieceG2($tab_cin1);
                }
            }
            if(isset($_FILES['its']))
            {
                if($scan = $monservice->uploadFichier('carte', 'carte', 'its')){
                    $dossier->setItsG1($scan) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
            if(isset($_FILES['its1']))
            {
                if($scan = $monservice->uploadFichier('carte', 'carte', 'its1')){
                    $dossier->setItsG2($scan) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
            $dossier->setComplet('oui');
            $dossier->setValide('Dossier non reçu');
            $em->persist($dossier);
            $em->persist($demandeqh);
            $em->flush();
            return $this->redirectToRoute('boutton_dossier',array('id'=>$demandeqh->getId()));
        }
        return $this->render('@DemandeQh/dossier/docGarant.html.twig',array('demandeqh'=>$demandeqh));
    }
    /**
     * dossier entities.
     *
     * @Route("/Ajouter_dossier_qh/{id}", name="ajouter_dossier_qh")
     * @Method({"GET","POST"})
     */
    public function ajouter_dossierAction(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        if($request->getMethod() == 'POST') {
            $dossier=new Dossier();
            $uploads= new MultipleUpload();
            $monservice = new MonService();
            $tab_cin = array();
            $tab_cheque= array();
            $tab_acte= array();
            $tab_pret= array();

            if(isset($_FILES['rembourse']))
            {
                if($res = $uploads->uploadFichiers('cheque','cheque','rembourse'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cheque,array(
                            'url' => $res[$i],
                        ));
                    }$dossier->setRembourse($tab_cheque);
                }
            }
            if(isset($_FILES['piece']))
             {
                 if($res = $uploads->uploadFichiers('cin','cin','piece'))
                 {
                     for($i=0;$i<count($res);$i++)
                     {
                         array_push($tab_cin,array(
                             'url' => $res[$i],
                         ));
                     }$dossier->setCin($tab_cin);
                 }
             }
            if(isset($_FILES['its']))
            {
                if($scan = $monservice->uploadFichier('carte', 'carte', 'its')){
                    $dossier->setIts1($scan) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
            if(isset($_FILES['safahi']))
            {
                if($scan = $monservice->uploadFichier('dossier', 'dossier', 'safahi')){
                    $dossier->setSafahi($scan) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
            if(isset($_FILES['pret']))
            {
                if($res = $uploads->uploadFichiers('formulaire','formulaire','pret'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_pret,array(
                            'url' => $res[$i],
                        ));
                    }$dossier->setPret1($tab_pret);
                }


            }
            if(isset($_FILES['rehen']))
            {
                if($scan = $monservice->uploadFichier('formulaire', 'formulaire', 'rehen')){
                    $dossier->setRehen($scan) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }

            if(isset($_FILES['acte']))
            {
                if($res = $uploads->uploadFichiers('formulaire','formulaire','acte'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_acte,array(
                            'url' => $res[$i],
                        ));
                    }$dossier->setActe1($tab_acte);
                }


            }


            if(isset($_FILES['vente']))
            {
                if($scan = $monservice->uploadFichier('formulaire', 'formulaire', 'vente')){
                    $dossier->setVente($scan) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
            $dossier->setComplet('non');
            $demandeqh->setDossier($dossier);
            $em->persist($dossier);
            $em->persist($demandeqh);
            $em->flush();
            return $this->redirectToRoute('boutton_dossier',array('id'=>$demandeqh->getId()));
         }
        return $this->render('@DemandeQh/dossier/doc.html.twig',array('demandeqh'=>$demandeqh));
/*         return $this->render('@DemandeQh/demande/infodossier.html.twig',array('demandeqh'=>$demandeqh));*/
     }
     /**
      * dossier entities.
      *
      * @Route("/contrat", name="contratdossier")
      * @Method({"GET","POST"})
      */
    public function contratdossierAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('personne'=>$personne));
        return $this->render('@DemandeQh/dossier/contratDossierQh.html.twig',array('demandeqh'=>$demandeqh));
    }
    /**
     * contrat de pret Generate PDF
     *
     * @Route("/contrat-pret/pdf/AZRD1{id}3AZ", name="contrat_pret")
     * @Method({"GET","POST"})
     */
    public function contrat_pretAction(DemandeQh $demandeQh)
    {
        $tfox = $this->get('t_fox_mpdf_port.pdf');

        $chiffreEnLettre = new ChiffresEnLettres();

        $sommeLettre = $chiffreEnLettre->Conversion($demandeQh->getMontant());

       /* $html = $this->render('@DemandeQh/pdf/contrat_pret.html.twig', array(
            'demandeqh' => $demandeQh,
            'sommeLettre' => $sommeLettre,

        ));*/
        return $this->render('@DemandeQh/pdf/pret.html.twig', array(
            'demandeqh' => $demandeQh,
            'sommeLettre' => $sommeLettre,

        ));

//        return $html;
        return new \TFox\MpdfPortBundle\Response\PDFResponse($tfox->generatePdf($html));
    }
    /**
     * contrat de pret Generate PDF
     *
     * @Route("/autorsation_vente/pdf/AZRD1{id}3AZ", name="vente")
     * @Method({"GET","POST"})
     */
    public function venteAction(DemandeQh $demandeQh)
    {


        $tfox = $this->get('t_fox_mpdf_port.pdf');



        /* $html = $this->render('@DemandeQh/pdf/contrat_pret.html.twig', array(
             'demandeqh' => $demandeQh,
             'sommeLettre' => $sommeLettre,

         ));*/
        return $this->render('@DemandeQh/pdf/vente.html.twig', array(
            'demandeqh' => $demandeQh,

        ));


//        return $html;
        return new \TFox\MpdfPortBundle\Response\PDFResponse($tfox->generatePdf($html));
    }
    /**
     * dossierattente entities.
     *
     * @Route("/dossierattente", name="dossierattent")
     * @Method({"GET","POST"})
     */
    public function dossierattenteAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $user=$this->getUser();

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));

        $demande=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));

        $etat=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demande));

        if($etat->getVerification()=='En attente de verification')
        {
            return $this->render('@DemandeQh/dossier/DossierAttente.html.twig',array('etat'=>$etat));
        }
        if($etat->getVerification()=='Valider')
        {
            return $this->render('@DemandeQh/dossier/DossierValider.html.twig',array('etat'=>$etat));
        }

    }
    /**
     * dossier entities.
     *
     * @Route("/ajouter_dossier", name="ajouter_dossier")
     * @Method({"GET","POST"})
     */
    public function ajouterdossierAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $dossier=$em->getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$personne->getNumeroDemandeQHtemp()));
        $infodossier=new InfoDossierService();
        if($request->getMethod()== 'POST') {

            $monservice = new MonService();
            if(empty($dossier))
            {
                $dossier = new Dossier();
            }


            $dossier->setNumeroDossier($personne->getNumeroDemandeQHtemp());
            if($dossier->getSlug())
            {
                $dossier->setSlug($monservice->randomLettre(10));
            }


            if($scan = $monservice->uploadFichier('dossier', 'scan','safahi')){

                $dossier->setSafahi($scan);

            }

            if( $scan1 = $monservice->uploadFichier('dossier', 'scan','attestation_compte')){

                $dossier->setAttestationCopmteBank($scan1) ;
            }

            if( $scan2 = $monservice->uploadFichier('dossier', 'scan','attestation_solde')){
                $dossier->setAttestationSoldeCompte($scan2);
            }


            $personne->setDossierEncours($dossier);
            $em->persist($personne);
            $em->persist($dossier);
            $em->flush();

            return $this->render('@DemandeQh/demande/infodossier.html.twig',array('demandeqh'=>$demandeqh));

        }

        if(empty($dossier)){
            return $this->render('@DemandeQh/dossier/importationdossier.html.twig',array('dossier'=>$dossier));
        }
        else{
            if($infodossier->testInfodossier($dossier) == false ){
                return $this->render('@DemandeQh/dossier/importationdossier.html.twig',array('dossier'=>$dossier));
            }
            else{

                return $this->redirectToRoute('ajouter_dossier_garant1');

            }

        }

    }

    /**
     * dossier entities.
     *
     * @Route("/ajouter_dossier_garant1", name="ajouter_dossier_garant1")
     * @Method({"GET","POST"})
     */
    public function ajouterdossiergarant1Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $dossier=$em->getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$personne->getNumeroDemandeQHtemp()));
        $infodossier=new InfoDossierService();
        if($request->getMethod()== 'POST') {

            $monservice= new MonService();

            $em = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));

            $dossier=$em->getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$personne->getNumeroDemandeQHtemp()));

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
            $personne->setDossierEncours($dossier);
            $em->persist($personne);
            $em->persist($dossier);
            $em->flush();

            return $this->redirectToRoute('ajouter_dossier_garant2');

        }
        if($infodossier->testInfodossiergarant1($dossier) == false ){
            return $this->render('@DemandeQh/dossier/importationdossiergarant1.html.twig',array('dossier'=>$dossier));
        }
        else{

            return $this->redirectToRoute('ajouter_dossier_garant2');
        }
    }

    /**
     * dossier entities.
     *
     * @Route("/ajouter_dossier_garant2", name="ajouter_dossier_garant2")
     * @Method({"GET","POST"})
     */
    public function ajouterdossiergarant2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $dossier=$em->getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$personne->getNumeroDemandeQHtemp()));
        $infodossier=new InfoDossierService();
        if($request->getMethod()== 'POST') {

            $infodossier=new InfoDossierService();
            $monservice= new MonService();

            $em = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));

            $dossier=$em->getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$personne->getNumeroDemandeQHtemp()));


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
            $personne->setDossierEncours($dossier);
            $em->persist($personne);
            $em->persist($dossier);
            $em->flush();

            if($infodossier->testInfodossier($dossier) and $infodossier->testInfodossiergarant1($dossier)
                and  $infodossier->testInfodossiergarant2($dossier)){
                return $this->redirectToRoute('dossierattent');

            }

            else{
                return $this->redirectToRoute('pagetestdossier');
                //return $this->redirectToRoute('pagetestdossier');

            }


        }

        if( $infodossier->testInfodossiergarant2($dossier)){
            return $this->redirectToRoute('dossierattent');

        }

        else{
            return $this->render('@DemandeQh/dossier/importationdossiergarant2.html.twig',array('dossier'=>$dossier));
            //return $this->redirectToRoute('pagetestdossier');

        }


    }
    /**
     * pagetestDossier
     *
     * @Route("/page_information_dossier", name="pagetestdossier")
     *
     */
    public function pagetestDossierQHAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $infodossierQH = new InfoDossierService();

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $dossier=$em->getRepository('DemandeQhBundle:Dossier')->findOneBy(array('numeroDossier'=>$personne->getNumeroDemandeQHtemp()));

        $infodossier=$infodossierQH->testInfodossier($dossier);
        $infodossier1=$infodossierQH->testInfodossiergarant1($dossier);
        $infodossier2=$infodossierQH->testInfodossiergarant2($dossier);

        return $this->render('@DemandeQh/dossier/pagetestdossier.html.twig',
            array('dossier'=>$dossier,'infodossier'=>$infodossier,'infodossier1'=>$infodossier1,'infodossier2'=>$infodossier2,));

    }
}
