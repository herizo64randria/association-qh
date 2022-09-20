<?php

namespace DemandeQhBundle\Controller;

use AppBundle\Service\MonService;
use AppBundle\Service\MultipleUpload;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
use DemandeQhBundle\Entity\Modification;

/**
 * demandeQH controller.
 *
 */
class demandeQHController extends Controller
{
    /**
     * demandeQH entities.
     *
     * @Route("/", name="nouvelle_demandeQH")
     */
    public function demandeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $demandeQH=$em->getRepository('DemandeQhBundle:DemandeQh')->findBy(array('numero'=>'0110/QH'));
        $nbr=count($demandeQH);
       // $etat=$demandeQH->getEtat();

        if($demandeQH){
           // return $this->redirectToRoute('listeDemandeQHeffectuer');
            return $this->render('@DemandeQh/demande/download.html.twig',array('personne'=>$personne,
                'nbr'=>$nbr
            ));

        }else{

            if($request->getMethod() == 'POST'){

                $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
                $demandeQH=$em->getRepository('DemandeQhBundle:DemandeQh')->findBy(array('numero'=>'0110/QH'));
                $nbr=count($demandeQH);
                return $this->render('@DemandeQh/demande/download.html.twig',array('personne'=>$personne,
                    'nbr'=>$nbr));
            }

            return $this->render('@DemandeQh/demande/download.html.twig',array('personne'=>$personne,
                'nbr'=>$nbr
            ));
        }

    }
    /**
     * AddDemandeQH entities.
     *
     * @Route("/ajout-demandeQH", name="addDemandeQH")
     */
    public function AddDemandeQHAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $monservice=new MonService();
        $mozes=$em->getRepository('DemandeQhBundle:Moze')->findAll();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        if($request->getMethod() == 'POST') {
            $repository_numDemande = $em->getRepository('DemandeQhBundle:NumeroQH_demande');
            $numRetour = '';
            $qNumDemande = $repository_numDemande->findOneBy(array('id'=>1));
            $numDemande = $qNumDemande;
            $intNextNum = $numDemande->getIntnumeroQH() + 1;
            $nextNum = $intNextNum;
            $numeroqh_demande=$this->recupererNumero();

            $numDemande->setIntnumeroQH($intNextNum);

            if(strlen($intNextNum) == 1){
                $nextNum = '000'.$intNextNum;
            }

            if(strlen($intNextNum) == 2){
                $nextNum = '00'.$intNextNum;
            }

            if(strlen($intNextNum) == 3){
                $nextNum = '0'.$intNextNum;
            }
            $numDemande->setNumeroQH($nextNum);
            $Tquestion='';
            $demandeQH=new DemandeQh();
            $demandeQH->setDate(new \DateTime());
            $demandeQH->setMontant($_POST['montant']);
            $demandeQH->setNombreMois($_POST['mois']);
            $demandeQH->setPersonne($personne);
            $demandeQH->setNumero($numeroqh_demande);
                foreach ( $_POST['question'] as $key=>$question){
                    if(!empty($question)){
                        $Tquestion=$Tquestion.$question.', ';
                    }

                }
                if(!empty($_POST['other'])){
                    $Tquestion=$Tquestion.$_POST['other'];

                }
                $demandeQH->setTypeMotif($Tquestion);


            if(!empty($_POST['or'])){
                $garantieOR=new GarantieOr();
                $garantieOR->setValeurAr($_POST['or']);
                $demandeQH->setGarantieOR($garantieOR);
                $em->persist($garantieOR);
            }

            $demandeQH->setGarant1(null);
            $demandeQH->setGarant2(null);
            $demandeQH->setDetailMotif($_POST['motif']);

             $etat=new Etat();
             $etat->setNomEtat(Etat::ATTENTE);
             $demandeQH->setEtat($etat);
             $em->persist($etat);
            $em->persist($demandeQH);
            $em->flush();
            return $this->redirectToRoute('addGarantQH',array('id'=>$demandeQH->getId()));
            //return $this->redirect($this->generateUrl('attenteQH'),array('id'=>$demandeQH->getId()));
        }
        return $this->render('@DemandeQh/demande/demande.html.twig',array('mozes'=>$mozes,'personne'=>$personne));

    }
    /**
     * editDemandeQH entities.
     *
     * @Route("/modifier-demandeQH/{id}", name="editDemandeQH")
     */
    public function editDemandeQHQHAction(Request $request,DemandeQh $demandeQH)
    {
        if($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $demandeQH->setMontant($_POST['montant']);
            $demandeQH->setNombreMois($_POST['mois']);
            $demandeQH->setDetailMotif($_POST['motif']);
            $demandeQH->getEtat()->setNomEtat(Etat::ATTENTE);
            if(!empty($_POST['or'])){
                $garantieOR=$demandeQH->getGarantieOR();
                $garantieOR->setValeurAr($_POST['or']);

            }
            $demandeQH->getEtat()->setNomEtat(Etat::ATTENTE);
            $em->flush();
            return $this->redirectToRoute('detailDemandeQH',array('id'=> $demandeQH->getId()));
        }
       return $this->render('@DemandeQh/demande/editDemandeQH.html.twig', array('demandeQh' =>$demandeQH ));

    }
    /**
     * editGarantQH entities.
     *
     * @Route("/modifier-garantQH/{id}", name="editGarantQH")
     */
    public function editGarantQHQHAction(Request $request,DemandeQh $demandeQH)
    {
        $em = $this->getDoctrine()->getManager();
        $mozes=$em->getRepository('DemandeQhBundle:Moze')->findAll();
        if($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $garant1=$demandeQH->getGarant1();
            $garant2=$demandeQH->getGarant2();
            $garant1->SetNomIts($_POST['nitsgarant1']);
            $garant1->setNumeroIts($_POST['itsgarant1']);
            $garant1->setMoze($_POST['mozegarant1']);

            $garant2->SetNomIts($_POST['nitsgarant2']);
            $garant2->setNumeroIts($_POST['itsgarant2']);
            $garant2->setMoze($_POST['mozegarant2']);
            $demandeQH->getEtat()->setNomEtat(Etat::ATTENTE);

            $em->flush();
            return $this->redirectToRoute('detailDemandeQH',array('id'=> $demandeQH->getId()));
        }
        return $this->render('@DemandeQh/demande/editGarant.html.twig', array('demandeQh' =>$demandeQH,'mozes'=>$mozes ));

    }
    /**
     * AddGarantQH entities.
     *
     * @Route("/ajout-garantQH/{id}", name="addGarantQH")
     */
    public function AddGarantQHAction(Request $request,DemandeQh $demande)
    {
        $em = $this->getDoctrine()->getManager();
        $monservice=new MonService();
        $mozes=$em->getRepository('DemandeQhBundle:Moze')->findAll();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        if($request->getMethod() == 'POST') {
            $garant1=new Garant();
            $garant2=new Garant();
            $garant1->SetNomIts($_POST['nitsgarant1']);
            $garant1->setNumeroIts($_POST['itsgarant1']);
            $garant1->setMoze($_POST['mozegarant1']);

            $garant2->SetNomIts($_POST['nitsgarant2']);
            $garant2->setNumeroIts($_POST['itsgarant2']);
            $garant2->setMoze($_POST['mozegarant2']);
            $em->persist($garant1);
            $em->persist($garant2);
            $demande->setGarant1($garant1);
            $demande->setGarant2($garant2);
            $em->flush();
            return  $this->redirectToRoute('listeDemandeQHeffectuer');
        }


            return $this->render('@DemandeQh/demande/garant.html.twig',array('demande'=>$demande));

    }
    /**
     * formulaireQH entities.
     *
     * @Route("/formulaire-QH", name="FenetreQH")
     */
    public function formulaireQHAction(Request $request)
    {

        $numeroqh_demande=$this->recupererNumero();
        $em = $this->getDoctrine()->getManager();
        $monservice=new MonService();
        $mozes=$em->getRepository('DemandeQhBundle:Moze')->findAll();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        if($request->getMethod() == 'POST'){



            $user=$this->getUser();
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));

            $repository_numDemande = $em->getRepository('DemandeQhBundle:NumeroQH_demande');
            $numRetour = '';
            $qNumDemande = $repository_numDemande->findOneBy(array('id'=>1));
            $numDemande = $qNumDemande;
            $intNextNum = $numDemande->getIntnumeroQH() + 1;
            $nextNum = $intNextNum;
            $numeroqh_demande=$this->recupererNumero();

            if(strlen($intNextNum) == 1){
                $nextNum = '000'.$intNextNum;
            }

            if(strlen($intNextNum) == 2){
                $nextNum = '00'.$intNextNum;
            }

            if(strlen($intNextNum) == 3){
                $nextNum = '0'.$intNextNum;
            }

            $user=$this->getUser();
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));

            $demandeQH=new DemandeQh();
            $garant1=new Garant();
            $garant2=new Garant();
            $etat=new Etat();
            $garantieOR=new GarantieOr();

            $upload=new MultipleUpload();
            $nbr=$upload->uploadFichiers('kalidas','photo','photos');

            $garant1->SetNomIts($_POST['nomits']);
            $garant1->setNumeroIts($_POST['its']);
            $garant1->setMoze($_POST['moza']);

            $garant2->SetNomIts($_POST['nomits1']);
            $garant2->setNumeroIts($_POST['its1']);
            $garant2->setMoze($_POST['moza1']);


            $garantieOR->setValeurAr($_POST['or']);

            if($scan = $monservice->uploadFichier('kalidas', 'scan','scan_kalidas')){
                $garantieOR->setScanKalidas($scan) ;
            }else{
                return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
            }
            if($nbr){
                for($i=0;$i<count($nbr);$i++){
                    $photo=new PhotoOr();
                    $photo->setUrl($nbr[$i]);
                    $photo->setGarantieor($garantieOR);
                    $em->persist($photo);
                }
            }else{
                return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
            }

            $demandeQH->setPersonne($personne);
            $demandeQH->SetSiAncienDemande($_POST['rep_antecedent']);
            $demandeQH->SetSiAncienDemandeEtat($_POST['etat']);
            $demandeQH->setMontant($_POST['montant']);
            $demandeQH->setNombreMois($_POST['mois']);
            $demandeQH->setTypeMotif($_POST['motif']);
            $demandeQH->setDetailMotif($_POST['detail']);
            $demandeQH->setGarant1($garant1);
            $demandeQH->setGarant2($garant2);
            $demandeQH->setGarantieOR($garantieOR);
            $demandeQH->setPersonne($personne);
            $demandeQH->setNumero($personne->getNumeroDemandeQHtemp());
            $demandeQH->setAnnee1($_POST['annee1']);
            $demandeQH->setMontant1($_POST['montant1']);
            $demandeQH->setAnnee2($_POST['annee2']);
            $demandeQH->setMontant2($_POST['montant2']);
            $demandeQH->setAnnee3($_POST['annee3']);
            $demandeQH->setMontant3($_POST['montant3']);
            $demandeQH->setUserConfirme(null);

            $etat->setDemadeQH($demandeQH);
            $etat->setNomEtat('En attente de confirmation');
            $etat->setVerification('En attente de verification');
            $em->persist($etat);
            $em->persist($garant1);
            $em->persist($garant2);
            $em->persist($garantieOR);
            $em->persist($demandeQH);
            $em->flush();

            return $this->redirect($this->generateUrl('attenteQH'));
        }
        return $this->render('@DemandeQh/demande/new.html.twig',array('mozes'=>$mozes,'numeroqh'=>$numeroqh_demande,'personne'=>$personne));
    }
    /* Fonction Recuperer Numero_demande QH */
    public function recupererNumero(){

        $em = $this->getDoctrine()->getManager();

        $repository_numDemande = $em->getRepository('DemandeQhBundle:NumeroQH_demande');

        $numRetour = '';

        $qNumDemande = $repository_numDemande->findOneBy(array('id'=>1));

        $numDemande = $qNumDemande;

        $dateJour  = new \DateTime();

        $numRetour = $numDemande->getNumeroQH().'/QH';

        return $numRetour;

    }
    /**
     * attente de demande entities.
     *
     * @Route("/attente_demande", name="attenteQH")
     */
    public function attenteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $demandeQH=$em->getRepository('DemandeQhBundle:DemandeQh')->findoneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));
        $etat=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demandeQH));

       /* if ($demandeQH)
        {*/
            if($etat->getNomEtat()=='En attente de confirmation')
            {
                return $this->render('@DemandeQh/demande/attenteDemandeQH.html.twig');
            }

            if($etat->getNomEtat()=='Refuser')
            {
                return $this->render('@DemandeQh/demande/refuserDemandeQH.html.twig',array('etat'=>$etat));
            }

            if($etat->getNomEtat()=='Acceptée')
            {
                return $this->render('@DemandeQh/demande/accepterDemandeQh.html.twig',array('etat'=>$etat));
            }

        /* }else
         {
             return $this->redirectToRoute('contratdossier');
        }*/



    }
    /**
     * retourde demande entities.
     *
     * @Route("/retour_demandeQH", name="retourQH")
     */
    public function retourAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $personne->setNumeroDemandeQHtemp('');
        $em->persist($personne);

        $em->flush();
        return $this->redirectToRoute('nouvelle_demandeQH');

    }
    /**
     * demandeQHeffectuer entities.
     *
     * @Route(" list_demande_effectuer", name="listeDemandeQHeffectuer")
     */
    public function demandeQHeffectuerAction()
    {
        $em=$this->getDoctrine()->getManager();

        $usercompte=$this->getUser();

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$usercompte));

        $demandeQH=$em->getRepository('DemandeQhBundle:DemandeQh')->findBy(array('personne'=>$personne));



        return $this->render('@DemandeQh/demande/demandeQHeffectuer.html.twig', array('demandeQHs' =>$demandeQH ));
    }

    /**
     * etat de demande entities.
     *
     * @Route("/etat_demande/QRT12{id}4AZR", name="etatQH")
     */
    public function etatAction(Request $request,DemandeQh $demandeQh)
    {
        $em = $this->getDoctrine()->getManager();

        $etat=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demandeQh));

        /* if ($demandeQH)
         {*/
        if($etat->getVerification()=='Valider')
        {
            return $this->redirectToRoute('dossierattent');
        }
        else
            {
            if($etat->getNomEtat()=='En attente de confirmation')
            {
                return $this->render('@DemandeQh/demande/attenteDemandeQH.html.twig',array('etat'=>$etat));
            }

            if($etat->getNomEtat()=='Refuser')
            {
                return $this->render('@DemandeQh/demande/refuserDemandeQH.html.twig',array('etat'=>$etat));
            }

            if($etat->getNomEtat()=='Acceptée')
            {
                return $this->render('@DemandeQh/demande/accepterDemandeQh.html.twig',array('etat'=>$etat));
            }

        }

        /* }else
         {
             return $this->redirectToRoute('contratdossier');
        }*/



    }
    /**
     * detaildemandeQHeffectuer entities.
     *
     * @Route(" detail_demande_effectuer/AZER12-{id}344E", name="detailDemandeQHeffectuer")
     */
    public function detailDemandeQHeffectuerAction(Request $request, DemandeQh $paramDemandeQh)
    {
        $em=$this->getDoctrine()->getManager();


        $etat=$em->getRepository('DemandeQhBundle:Etat')->findBy(array('demadeQH'=>$paramDemandeQh));

        return $this->render('@DemandeQh/demande/demandeQHeffectuer.html.twig', array('demandeQHs' =>$etat ));
    }
    /**
     * detaildemandeQH  entities.
     *
     * @Route(" detail_demandeQH/AZEeR12-{id}344E", name="detailDemandeQH")
     */
    public function detailDemandeQAction(Request $request, DemandeQh $param)
    {
        $em=$this->getDoctrine()->getManager();
        if($param->getEtat()->getNomEtat()=='Demande accépté'){
            return $this->redirectToRoute('infoDemandeQH',array('id'=>$param->getId()));

        }else{
            return $this->render('@DemandeQh/demande/detailDemandeQh.html.twig', array('demandeQH' =>$param ));
        }


    }
    /**
     * detaildemandeQH  entities.
     *
     * @Route(" info_garant_demandeQH/AS78{id}568", name="infoDemandeQH")
     */
    public function infoDemandeQAction(Request $request,DemandeQh $demandeQh)
    {
        $em=$this->getDoctrine()->getManager();

            return $this->render('@DemandeQh/demande/infogarant.html.twig',array('DemandeQh'=>$demandeQh));


    }
}