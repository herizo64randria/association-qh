<?php

namespace DemandeQhBundle\Controller;

use AppBundle\Service\ChiffresEnLettres;
use AppBundle\Service\InfoGarantService;
use AppBundle\Service\MonService;
use AppBundle\Service\MultipleUpload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PersonneBundle\Entity\Personne;
use DemandeQhBundle\Entity\DemandeQh;
use DemandeQhBundle\Entity\Garant;

/**
 * garant controller.
 *
 */
class garantController extends Controller
{
    /**
     * ajoutergarant1 entities.
     *
     * @Route("/information_garant1/AZ{id}ZZZ", name="ajouter_garant1")
     * @Method({"GET","POST"})
     */
    public function informationgarant1Action(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        //$demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));
        $mozes = $em->getRepository('DemandeQhBundle:Moze')->findAll();
        $garant=$demandeqh->getGarant1();
        $infogarant = new InfoGarantService();

        if($request->getMethod() == 'POST') {


                $uploads= new MultipleUpload();
                $upload = new MonService();
                //$moze = $em->getRepository('DemandeQhBundle:Moze')->findOneBy(array('id'=>$_POST['moze']));
                $tab_cin = array();

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

                       $garant->setCin($tab_cin);
                   }
            }

            if (isset($_FILES['scanits']))
            {
                if ($res1 = $upload->uploadFichier('carte', 'carte', 'scanits')) {
                    $garant->setScanits($res1);
                }
            }

            if(!empty($_POST['ne']))
            {
                $ne = \DateTime::createFromFormat('d/m/Y',$_POST['ne']);
                $garant->setDateNaissance($ne);
            }

            $garant->setNomcin($_POST['nom']);
            $garant->setPrenomcin($_POST['prenom']);
            $garant->setLieu($_POST['lieu']);
            $garant->setAdresse($_POST['adresse']);
            $garant->setVille($_POST['ville']);
            $garant->setNationalite($_POST['nationalite']);
            $garant->setTypePiece($_POST['type']);
            $garant->setNumeroPiece($_POST['numero']);
            $garant->setSabile($_POST['gsabil']);
            $garant->setPrefixe($_POST['prefixe']);
            if(!empty($_POST['date']))
            {
                $date= \DateTime::createFromFormat('d/m/Y',$_POST['date']);
                $garant->setDatePiece($date);
            }

            $garant->setVillePiece($_POST['villepiece']);
            $garant->setPaysPiece($_POST['pays']);
          //  $garant->setProfession($_POST['profession']);
            $garant->setTel1($_POST['tel1']);
            $garant->setTel2($_POST['tel2']);
            /*$garant->setEmail($_POST['email']);*/
            /*$garant->setNumerocheque1($_POST['numerocheque1']);
            $garant->setMontantcheque1($_POST['montantcheque1']);
            $garant->setBanquecheque1($_POST['banquecheque1']);*/

            if(!empty($_POST['datecheque1']))
            {
                $datecheque1 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque1']);
                $garant->setDatetcheque1($datecheque1);
            }

           /* $garant->setNumerocheque2($_POST['numerocheque2']);
            $garant->setMontantcheque2($_POST['montantcheque2']);
            $garant->setBanquecheque2($_POST['banquecheque2']);*/

            if(!empty($_POST['datecheque2']))
            {
                $datecheque2 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque2']);
                $garant->setDatetcheque2($datecheque2);
            }

            /*$garant->setNumerocheque3($_POST['numerocheque3']);
            $garant->setMontantcheque3($_POST['montantcheque3']);
            $garant->setBanquecheque3($_POST['banquecheque3']);*/

            if(!empty($_POST['datecheque3']))
            {
                $datecheque3 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque3']);
                $garant->setDatetcheque3($datecheque3);
            }

            /*$garant->setNomheritier1($_POST['nomheritier']);
            $garant->setPrenomheritier1($_POST['prenomheritier']);*/
            $garant->setSexe($_POST['sexe']);
            $em->persist($garant);
            $em->flush();
//            return $this->redirectToRoute('ajouter_dossier_garant1');
            return $this->redirectToRoute('ajouter_garant2',array('id'=>$demandeqh->getId()));

        }

        if($infogarant->testInfo($garant)==true){
            //return $this->redirectToRoute('ajouter_garant2',array('id'=>$demandeqh->getId()));
            return $this->render('@DemandeQh/garant/garant1.html.twig',array('demandeqh'=>$demandeqh,
                'garant'=>$garant));

        }
        else
          {

        return $this->render('@DemandeQh/garant/garant1.html.twig',array('demandeqh'=>$demandeqh,
            'garant'=>$garant));
          }

    }
    /**
     * ajoutergarant2 entities.
     *
     * @Route("/information_garant2/AZ24{id}45z", name="ajouter_garant2")
     * @Method({"GET","POST"})
     */
    public function informationgarant2Action(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
       // $personne=$em->getRepository('PersonneBunde:Personne')->findOneBy(array('userCompte'=>$user));

        $garant1=$demandeqh->getGarant1();
        $garant=$demandeqh->getGarant2();


        if($request->getMethod()== 'POST') {

            $infogarant = new InfoGarantService();

           /* if($garant1->getId()!=0 and $garant1->getNomcin()==null or $garant1->getPrenomcin()==null or $garant1->getDateNaissance()==null or
                $garant1->getLieu()==null or $garant1->getAdresse()==null or $garant1->getVille()==null or
                $garant1->getNationalite()==null or $garant1->getTypePiece()==null or $garant1->getNumeroPiece()==null
                or $garant1->getDatePiece()==null or $garant1->getVillePiece()==null or $garant1->getPaysPiece()==null
                or $garant1->getProfession()==null or $garant1->getTel1()==null or $garant1->getEmail()==null
                or $garant1->getNumerocheque1()==null or $garant1->getBanquecheque1()==null  or $garant1->getMontantcheque1()==null
                or $garant1->getDatetcheque1()==null  or $garant1->getNumerocheque2()==null or $garant1->getBanquecheque2()==null  or $garant1->getMontantcheque2()==null
                or $garant1->getDatetcheque2()==null  or $garant1->getNumerocheque3()==null or $garant1->getBanquecheque3()==null  or $garant1->getMontantcheque3()==null
                or $garant1->getDatetcheque3()==null or $garant1->getNomheritier1()==null or $garant1->getPrenomheritier1()==null
            ){
                return $this->redirectToRoute('ajouter_garant1');
            }*/

            $uploads= new MultipleUpload();
            $upload = new MonService();
            $tab_cin = array();

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

                    $garant->setCin($tab_cin);
                }
            }

            if (isset($_FILES['scanits'])) {
                if ($res1 = $upload->uploadFichier('carte', 'carte', 'scanits')) {
                    $garant->setScanits($res1);
                }
            }

            if(!empty($_POST['ne']))
                {
                    $ne = \DateTime::createFromFormat('d/m/Y',$_POST['ne']);
                   $garant->setDateNaissance($ne);
                }
                $garant->setNomcin($_POST['nom']);
                $garant->setPrenomcin($_POST['prenom']);
                $garant->setLieu($_POST['lieu']);
                $garant->setAdresse($_POST['adresse']);
                $garant->setVille($_POST['ville']);
                $garant->setNationalite($_POST['nationalite']);
                $garant->setTypePiece($_POST['type']);
                $garant->setNumeroPiece($_POST['numero']);
                $garant->setPrefixe($_POST['prefixe']);
                $garant->setSabile($_POST['gsabil']);
                if(!empty($_POST['date']))
                {
                    $date= \DateTime::createFromFormat('d/m/Y',$_POST['date']);
                     $garant->setDatePiece($date);
                }
                $garant->setVillePiece($_POST['villepiece']);
                $garant->setPaysPiece($_POST['pays']);
              // $garant->setProfession($_POST['profession']);
                $garant->setTel1($_POST['tel1']);
                $garant->setTel2($_POST['tel2']);
                /*$garant->setNumerocheque1($_POST['numerocheque1']);
                $garant->setMontantcheque1($_POST['montantcheque1']);
                $garant->setBanquecheque1($_POST['banquecheque1']);*/

                if(!empty($_POST['datecheque1']))
                {
                    $datecheque1 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque1']);
                   $garant->setDatetcheque1($datecheque1);
                }

              /*  $garant->setNumerocheque2($_POST['numerocheque2']);
                $garant->setMontantcheque2($_POST['montantcheque2']);
                $garant->setBanquecheque2($_POST['banquecheque2']);*/

                if(!empty($_POST['datecheque2']))
                {
                    $datecheque2 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque2']);
                    $garant->setDatetcheque2($datecheque2);
                }


              /*  $garant->setNumerocheque3($_POST['numerocheque3']);
                $garant->setMontantcheque3($_POST['montantcheque3']);
                $garant->setBanquecheque3($_POST['banquecheque3']);*/

                if(!empty($_POST['datecheque3']))
                {
                    $datecheque3 = \DateTime::createFromFormat('d/m/Y',$_POST['datecheque3']);
                    $garant->setDatetcheque3($datecheque3);
                }

               /* $garant->setEmail($_POST['email']);
                $garant->setNomheritier1($_POST['nomheritier']);
                $garant->setPrenomheritier1($_POST['prenomheritier']);*/
                $garant->setSexe($_POST['sexe']);
                $em->persist($garant);
                $em->flush();

                if(($infogarant->testInfo($garant)==true) and ($infogarant->testInfo($garant1)==true) )
                {
                    return $this->redirectToRoute('formulairegarant',array('id'=>$demandeqh->getId()));

                }
                 else
                {

                    return $this->redirectToRoute('pagetestgarant',array('id'=>$demandeqh->getId()));
                }

        }

        if($garant->getId()==0 or $garant->getNomcin()==null or $garant->getPrenomcin()==null or $garant->getDateNaissance()==null or
            $garant->getLieu()==null or $garant->getAdresse()==null or $garant->getVille()==null or
            $garant->getNationalite()==null or $garant->getTypePiece()==null or $garant->getNumeroPiece()==null
            or $garant->getDatePiece()==null or $garant->getVillePiece()==null or $garant->getPaysPiece()==null
            or $garant->getProfession()==null or $garant->getTel1()==null or $garant->getEmail()==null
            or $garant->getNumerocheque1()==null or $garant->getBanquecheque1()==null  or $garant->getMontantcheque1()==null
            or $garant->getDatetcheque1()==null  or $garant->getNumerocheque2()==null or $garant->getBanquecheque2()==null  or $garant->getMontantcheque2()==null
            or $garant->getDatetcheque2()==null  or $garant->getNumerocheque3()==null or $garant->getBanquecheque3()==null  or $garant->getMontantcheque3()==null
            or $garant->getDatetcheque3()==null or $garant->getNomheritier1()==null or $garant->getPrenomheritier1()==null
        ){
            return $this->render('@DemandeQh/garant/garant2.html.twig',array('demandeqh'=>$demandeqh,
                'garant'=>$garant
            ));
        }
        else{
            return $this->redirectToRoute('formulairegarant');
        }
    }

    /**
     * pagetestGarant
     *
     * @Route("/page_information/{id}", name="pagetestgarant")
     *
     */
    public function pagetestGarantQHAction(DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $infogarant = new InfoGarantService();

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
       // $demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));
        $garant1=$em->getRepository('DemandeQhBundle:Garant')->findOneBy(array('id'=>$demandeqh->getGarant1()));
        $garant2=$em->getRepository('DemandeQhBundle:Garant')->findOneBy(array('id'=>$demandeqh->getGarant2()));
        $info1=$infogarant->testInfo($garant1);
        $info2=$infogarant->testInfo($garant2);
        return $this->render('@DemandeQh/garant/pageTestGarant.html.twig',
            array('demandeqh'=>$demandeqh,'garant'=>$garant1,'garant1'=>$garant2,'info1'=>$info1,'info2'=>$info2,));

    }
    /**
     * garant Generate PDF
     *
     * @Route("/telechargement-engagement/pdf/{id}", name="formulairegarant")
     *
     */
    public function formulaireGaarantQHAction(DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $infogarant = new InfoGarantService();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $garant1=$em->getRepository('DemandeQhBundle:Garant')->findOneBy(array('id'=>$demandeqh->getGarant1()));
        $garant2=$em->getRepository('DemandeQhBundle:Garant')->findOneBy(array('id'=>$demandeqh->getGarant2()));
        $info1=$infogarant->testInfo($garant1);
        if($info1==false)
        {
            return $this->redirectToRoute('ajouter_garant1');
        }
        else
        {
            return $this->render('@DemandeQh/garant/acteEngagement.html.twig',array('demandeqh'=>$demandeqh));
        }


    }

    /**
     * garant Generate PDF
     *
     * @Route("/acte-engagement-caution-garant1/pdf/12ZS12{id}AZSD", name="garant1")
     * @Method({"GET","POST"})
     */
    public function garant1_engagementAction(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        //$demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));
        $garant1=$demandeqh->getGarant1();
        $tfox = $this->get('t_fox_mpdf_port.pdf');
        $chiffreEnLettre = new ChiffresEnLettres();

        $sommeLettre = $chiffreEnLettre->Conversion($demandeqh->getMontant());
/*
            $html = $this->render('@DemandeQh/pdf/engagement_G1.html.twig', array(
                'num_demande' => $demandeqh->getNumero(),
                'garant1'=>$garant1,
                'personne'=>$personne,
                'demandeqh'=>$demandeqh
            ));*/

            return $this->render('@DemandeQh/pdf/g1.html.twig',array(
                'num_demande' => $demandeqh->getNumero(),
                'garant'=>$garant1,
                'personne'=>$personne,
                'demandeqh'=>$demandeqh,
                'lettre'=>$sommeLettre
            ));

//        return $html;
        return new \TFox\MpdfPortBundle\Response\PDFResponse($tfox->generatePdf($html));

    }
    /**
     * garant Generate PDF
     *
     * @Route("/acte-engagement-caution-garant2/pdf/AZRD1{id}3AZ", name="garant2")
     * @Method({"GET","POST"})
     */
    public function garant2_engagementAction(Request $request,DemandeQh $demandeqh)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
       // $demandeqh=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));
        $garant2=$demandeqh->getGarant2();
        $tfox = $this->get('t_fox_mpdf_port.pdf');

        $chiffreEnLettre = new ChiffresEnLettres();

        $sommeLettre = $chiffreEnLettre->Conversion($demandeqh->getMontant());
       /* $html = $this->render('@DemandeQh/pdf/engagement_G2.html.twig', array(
            'num_demande' => $demandeqh->getNumero(),
            'garant1'=>$garant2,
            'personne'=>$personne,
            'demandeqh'=>$demandeqh
        ));*/

        return $this->render('@DemandeQh/pdf/g1.html.twig',array(
            'num_demande' => $demandeqh->getNumero(),
            'garant'=>$garant2,
            'personne'=>$personne,
            'demandeqh'=>$demandeqh,
            'lettre'=>$sommeLettre
        ));

//        return $html;
        return new \TFox\MpdfPortBundle\Response\PDFResponse($tfox->generatePdf($html));
    }
}
