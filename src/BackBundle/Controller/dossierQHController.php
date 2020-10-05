<?php

namespace BackBundle\Controller;
use DemandeQhBundle\Entity\Modification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use DemandeQhBundle\Entity\Etat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DemandeQhBundle\Entity\PhotoOr;
use DemandeQhBundle\Entity\DemandeQh;
use DemandeQhBundle\Entity\Garant ;
use DemandeQhBundle\Entity\GarantieOr ;

/**
 * dossierQhBack controller.
 *
 * @Route("/dash/dossierQH/")
 */
class dossierQHController extends Controller
{
    /**
     * dossierQh entities.
     *
     * @Route("/dossier", name="dossierQh_liste")
     */
    public function indexAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $repsitory_etat=$em->getRepository('DemandeQhBundle:Etat');
        $dossier=$repsitory_etat->findBy(array('nomEtat'=>'Acceptée'));
        return $this->render('@Back/dossier/ListeDossier.html.twig',array('demandeQHs'=>$dossier));

    }
    /**
     * confirmationdemandeQH entities.
     *
     * @Route("confirmation_dossierQH/AZT{id}Z6T", name="confirmationdossierQH")
     * @Method({"GET","POST"})
     */
    public function confirmationDossierQHAction(Request $request,Etat $demandeQh )
    {
        $garantior= $demandeQh->getDemadeQH()->getGarantieOR();
        $em=$this->getDoctrine()->getManager();
        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));
        $modifier=$em->getRepository('DemandeQhBundle:Modification')->findBy(array('etat'=>$demandeQh));



        return $this->render('@Back/dossier/confirmationDossierQh.html.twig',array('demandeQH'=>$demandeQh,
            'photoor'=>$photoor,'modifiers'=>$modifier
        ));
    }


    /**
     * modificationQH entities.
     *
     * @Route("modification", name="modificationbackQh")
     * @Method({"GET","POST"})
     */
    public function modificationQhAction(Request $request1)
    {

        if( $request1->isXmlHttpRequest()){

            $em=$this->getDoctrine()->getManager();

            $t = $request1->request->all();

            $demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('id'=>$t['id_demandeqh']));

            if(($t['montant'])){

                $demandeqh->setMontant($t['montant']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');

            }
            if(($t['mois']))
            {
                $demandeqh->setNombreMois($t['mois']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['motif']))
            {
                $demandeqh->setTypeMotif($t['motif']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }

            if(($t['detail']))
            {
                $demandeqh->setDetailMotif($t['detail']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['valeuror']))
            {
                $garantor = $demandeqh->getGarantieOR();
                $garantor->setValeurAr($t['valeuror']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['nomits'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setNomIts($t['nomits']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['its'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setNumeroIts($t['its']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['moze'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setMoze($t['moze']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['nomits1'])){
                $garant2 = $demandeqh->getGarant2();
                $garant2->setNomIts($t['nomits1']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['its1'])){
                $garant2 = $demandeqh->getGarant2();
                $garant2->setNumeroIts($t['its1']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['moze1'])){
                $garant2 = $demandeqh->getGarant2();
                $garant2->setMoze($t['moze1']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gnom'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setNomcin($t['gnom']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gprenom'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setPrenomcin($t['gprenom']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gne'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setDateNaissance($t['gne']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }

            if(($t['glieu'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setLieu($t['glieu']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gadresse'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setAdresse($t['gadresse']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gville'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setVille($t['gville']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gnationalite'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setNationalite($t['gnationalite']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gtype'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setTypePiece($t['gtype']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gnumpiece'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setNumeroPiece($t['gnumpiece']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gvillepiece'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setVillePiece($t['gvillepiece']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }

            if(($t['gpayspiece'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setPaysPiece($t['gpayspiece']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }

            if(($t['gprofession'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setProfession($t['gprofession']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gtel1'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setTel1($t['gtel1']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gtel2'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setTel2($t['gtel2']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }
            if(($t['gemail'])){
                $garant1 = $demandeqh->getGarant1();
                $garant1->setEmail($t['gemail']);
                $em->persist($demandeqh);
                $em->flush();
                return new Response('Modification effectuer');
            }





        }

    }
    /**
     * validerdosierQH entities.
     *
     * @Route("validation/AZT{id}Z6T", name="validerdossierQh")
     * @Method({"GET","POST"})
     */
    public function validationdossierQhAction(Request $request,Etat $demandeQh)
    {
        $em=$this->getDoctrine()->getManager();
        $demandeQh->setVerification('Valider');
        $em->persist($demandeQh);
        $em->flush();
        $garantior= $demandeQh->getDemadeQH()->getGarantieOR();
        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));
        $modifier=$em->getRepository('DemandeQhBundle:Modification')->findBy(array('etat'=>$demandeQh));



        return $this->render('@Back/dossier/confirmationDossierQh.html.twig',array('demandeQH'=>$demandeQh,
            'photoor'=>$photoor,'modifiers'=>$modifier
        ));
    }
    /**
     * notificationQH entities.
     *
     * @Route("notification", name="notificationQh")
     * @Method({"GET","POST"})
     */
    public function notificationQhAction(Request $request)
    {

        if( $request->isXmlHttpRequest()){

            $em=$this->getDoctrine()->getManager();
            $t1 = $request->request->all(); // tableau des champs POST
            //récuperer les variables POST
            // $t1['nom'] ,   $t1['prenom'] ,   $t1['adresse'] ...
            // puis faire traitement souhaité tel que ajouter les données en base

            // exit;
            $dossier=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('id'=>$t1['id_demandeqh']));
            $dossier->setVerification('A verifier');
            $em->persist($dossier);
            $modification= new Modification();

            if (!empty($t1['notif_detail'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_detail']);
                $modification->setNotif($t1['notif_detail']);
                $em->persist($modification);
                $em->flush();

            }
            if (!empty($t1['notif_gprenomheritier'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gprenomheritier']);
                $modification->setNotif($t1['notif_gprenomheritier']);
                $em->persist($modification);
                $em->flush();
                return new Response('Remarque envoyée');
            }

            if (!empty($t1['notif_montant'])){

                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_montant']);
                $modification->setNotif($t1['notif_montant']);
                $em->persist($modification);
                $em->flush();
            }

            if (!empty($t1['notif_mois'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_mois']);
                $modification->setNotif($t1['notif_mois']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_motif'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_motif']);
                $modification->setNotif($t1['notif_motif']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_valeuror'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_valeuror']);
                $modification->setNotif($t1['notif_valeuror']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_nomits'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_nomits']);
                $modification->setNotif($t1['notif_nomits']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnumits'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnumits']);
                $modification->setNotif($t1['notif_gnumits']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gmoze'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gmoze']);
                $modification->setNotif($t1['notif_gmoze']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_nomits1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_nomits1']);
                $modification->setNotif($t1['notif_nomits1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnumits1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnumits1']);
                $modification->setNotif($t1['notif_gnumits&']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gmoze1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gmoze1']);
                $modification->setNotif($t1['notif_gmoze1 ']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_kalidas'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_kalidas']);
                $modification->setNotif($t1['notif_kalidas']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnom'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnom']);
                $modification->setNotif($t1['notif_gnom']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gprenom'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gprenom']);
                $modification->setNotif($t1['notif_gprenom']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gadresse'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gadresse']);
                $modification->setNotif($t1['notif_gadresse']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gne'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gne']);
                $modification->setNotif($t1['notif_gne']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_glieu'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_glieu']);
                $modification->setNotif($t1['notif_glieu']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gadresse'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gadresse']);
                $modification->setNotif($t1['notif_gadresse']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gville'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gville']);
                $modification->setNotif($t1['notif_gville']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnationalite'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnationalite']);
                $modification->setNotif($t1['notif_gnationalite']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gsexe'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gsexe']);
                $modification->setNotif($t1['notif_gsexe ']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gtype'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gtype']);
                $modification->setNotif($t1['notif_gtype']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnumpiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnumpiece']);
                $modification->setNotif($t1['notif_gnumpiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gdatepiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gdatepiece']);
                $modification->setNotif($t1['notif_gdatepiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gvillepiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gvillepiece']);
                $modification->setNotif($t1['notif_gvillepiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gpayspiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gpayspiece']);
                $modification->setNotif($t1['notif_gpayspiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gprofession'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gprofession']);
                $modification->setNotif($t1['notif_gprofession']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gtel1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gtel1']);
                $modification->setNotif($t1['notif_gtel1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gtel2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gtel2']);
                $modification->setNotif($t1['notif_gtel2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnumcheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnumcheque1']);
                $modification->setNotif($t1['notif_gnumcheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gbanquecheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gbanquecheque1']);
                $modification->setNotif($t1['notif_gbanquecheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gmontantcheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gmontantcheque1']);
                $modification->setNotif($t1['notif_gmontantcheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gdatecheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gdatecheque1']);
                $modification->setNotif($t1['notif_gdatecheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnumcheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnumcheque2']);
                $modification->setNotif($t1['notif_gnumcheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gbanquecheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gbanquecheque2']);
                $modification->setNotif($t1['notif_gbanquecheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gmontantcheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gmontantcheque2']);
                $modification->setNotif($t1['notif_gmontantcheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gdatecheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gdatecheque2']);
                $modification->setNotif($t1['notif_gdatecheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnumcheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnumcheque3']);
                $modification->setNotif($t1['notif_gnumcheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gbanquecheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gbanquecheque3']);
                $modification->setNotif($t1['notif_gbanquecheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gmontantcheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gmontantcheque3']);
                $modification->setNotif($t1['notif_gmontantcheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gdatecheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gdatecheque3']);
                $modification->setNotif($t1['notif_gdatecheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gnomheritier'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnomheritier']);
                $modification->setNotif($t1['notif_gnomheritier']);
                $em->persist($modification);
                $em->flush();
            }



            if (!empty($t1['notif_g1nom'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1nom']);
                $modification->setNotif($t1['notif_g1nom']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1prenom'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1prenom']);
                $modification->setNotif($t1['notif_g1prenom']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1adresse'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1adresse']);
                $modification->setNotif($t1['notif_g1adresse']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1lieu'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1lieu']);
                $modification->setNotif($t1['notif_g1lieu']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1adresse'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1adresse']);
                $modification->setNotif($t1['notif_g1adresse']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1ville'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1ville']);
                $modification->setNotif($t1['notif_g1ville']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1nationalite'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1nationalite']);
                $modification->setNotif($t1['notif_g1nationalite']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1sexe'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1sexe']);
                $modification->setNotif($t1['notif_g1sexe ']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1type'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1type']);
                $modification->setNotif($t1['notif_g1type']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1numpiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1numpiece']);
                $modification->setNotif($t1['notif_g1numpiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1datepiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1datepiece']);
                $modification->setNotif($t1['notif_g1datepiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1villepiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1villepiece']);
                $modification->setNotif($t1['notif_g1villepiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1payspiece'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1payspiece']);
                $modification->setNotif($t1['notif_g1payspiece']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1profession'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1profession']);
                $modification->setNotif($t1['notif_g1profession']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1tel1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1tel1']);
                $modification->setNotif($t1['notif_g1tel1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1tel2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1tel2']);
                $modification->setNotif($t1['notif_g1tel2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1numcheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1numcheque1']);
                $modification->setNotif($t1['notif_g1numcheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1banquecheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1banquecheque1']);
                $modification->setNotif($t1['notif_g1banquecheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1montantcheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1montantcheque1']);
                $modification->setNotif($t1['notif_g1montantcheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1datecheque1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1datecheque1']);
                $modification->setNotif($t1['notif_g1datecheque1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1numcheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1numcheque2']);
                $modification->setNotif($t1['notif_g1numcheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1banquecheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1banquecheque2']);
                $modification->setNotif($t1['notif_g1banquecheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1montantcheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1montantcheque2']);
                $modification->setNotif($t1['notif_g1montantcheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1datecheque2'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1datecheque2']);
                $modification->setNotif($t1['notif_g1datecheque2']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1numcheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1numcheque3']);
                $modification->setNotif($t1['notif_g1numcheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1banquecheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1banquecheque3']);
                $modification->setNotif($t1['notif_g1banquecheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1montantcheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1montantcheque3']);
                $modification->setNotif($t1['notif_g1montantcheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1datecheque3'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1datecheque3']);
                $modification->setNotif($t1['notif_g1datecheque3']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1nomheritier'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1nomheritier']);
                $modification->setNotif($t1['notif_g1nomheritier']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_g1prenomheritier'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_g1prenomheritier']);
                $modification->setNotif($t1['notif_g1prenomheritier']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_safahi'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_safahi']);
                $modification->setNotif($t1['notif_safahi']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_solde'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_solde']);
                $modification->setNotif($t1['notif_solde']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_attestation'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_attestation']);
                $modification->setNotif($t1['notif_attestation']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_chequebarre'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_chequebarre']);
                $modification->setNotif($t1['notif_chequebarre']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_chequebarre1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_chequebarre1']);
                $modification->setNotif($t1['notif_chequebarre1']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_formgarant'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_formgarant']);
                $modification->setNotif($t1['notif_formgarant']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_formgarant1'])){
                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_formgarant1']);
                $modification->setNotif($t1['notif_formgarant1']);
                $em->persist($modification);
                $em->flush();
            }

        }


    }
}
