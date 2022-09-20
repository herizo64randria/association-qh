<?php

namespace DemandeQhBundle\Controller;

use Proxies\__CG__\PaieBundle\Entity\Demande_Remboursement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use PersonneBundle\Entity\Personne;

/**
 * demandeQH controller.
 *
 */
class demandeQHGeneratePDFController extends Controller
{

    /**
     * test Generate PDF
     *
     * @Route("/examination-scellage/pdf", name="formulaireQH")
     * @Method({"GET","POST"})
     */
    public function formulaireQHAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $tfox = $this->get('t_fox_mpdf_port.pdf');

        if (empty($personne->getNumeroDemandeQHtemp())){


            $numeroDemandeQHtemp=$this->recupererNumero();

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
            $personne->setNumeroDemandeQHtemp($numeroDemandeQHtemp);

            $em->persist($personne);
            $em->persist($numDemande);

            $em->flush();

            $html =  $this->render('@DemandeQh/pdf/rehen.html.twig');
            /*$html = $this->render('@DemandeQh/pdf/examination_secellage.html.twig', array(
                'num_demande' => $personne->getNumeroDemandeQHtemp()
            ));*/
        }
        else{

            $html =  $this->render('@DemandeQh/pdf/rehen.html.twig');
            /*$html = $this->render('@DemandeQh/pdf/examination_secellage.html.twig', array(
                'num_demande' => $personne->getNumeroDemandeQHtemp()
            ));*/


        }



        return new \TFox\MpdfPortBundle\Response\PDFResponse($tfox->generatePdf($html));

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
}