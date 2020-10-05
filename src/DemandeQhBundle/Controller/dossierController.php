<?php

namespace DemandeQhBundle\Controller;
use AppBundle\Service\ChiffresEnLettres;
use AppBundle\Service\InfoDossierService;
use AppBundle\Service\MonService;
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

        $html = $this->render('@DemandeQh/pdf/contrat_pret.html.twig', array(
            'demandeqh' => $demandeQh,
            'sommeLettre' => $sommeLettre,

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

            return $this->redirectToRoute('ajouter_dossier_garant1');

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
