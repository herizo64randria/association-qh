<?php

namespace BackBundle\Controller;
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
use DemandeQhBundle\Entity\ConfirmationQH;
/**
 * societedemandeQhBack controller.
 *
 * @Route("/dash/societe/")
 */
class societeDemandeQhController extends Controller
{
    /**
     * societedemandeQH entities.
     *
     * @Route("/detail/AZT3{id}45ER", name="detail_societedemandeQhback")
     */
    public function detailAction(Request $request,SocieteDemandeQH $demandeQH)
    {
        $em = $this->getDoctrine()->getManager();
        $res=array();
        $garant = $em->getRepository('DemandeQhBundle:Garant')->findBy(array('societe_demandeqh'=>$demandeQH));
        $tabgarant = $em->getRepository('DemandeQhBundle:Garant')->findBy(array('societe_demandeqh'=>$demandeQH));
        $listes_confirmation = $em->getRepository('DemandeQhBundle:ConfirmationQH')->findBy(array('societeDemandeQH'=>$demandeQH));
        $confirmation = $em->getRepository('DemandeQhBundle:ConfirmationQH')->findOneBy(array('userConfirme'=>$this->getUser(),'societeDemandeQH'
        =>$demandeQH));

        $rep_oui=0;
        $rep_non=0;
        $nbr_montant=0;
        $montant=0;
        $montant_moyenne=0;
        $chrono=$this->dateDiff($demandeQH->getDateenvoie(),7);
        $day=$chrono['day'];
        $h=$chrono['hour'];
        $min=$chrono['minute'];
            if($listes_confirmation)
            {
                foreach ($listes_confirmation as $liste)//parcourir le table confirmation du demandeQh
                {
                    if($liste->getReponse()=="oui")
                    {
                        $rep_oui=$rep_oui+1;//nombre oui

                        if($liste->getMontant()>0)// determiner si l'admin a mis une montant
                        {
                            $nbr_montant=$nbr_montant+1;//nombre montant

                            $montant=$montant+$liste->getMontant();
                            $montant_moyenne=$montant/$nbr_montant;//moyen de monant

                        }


                    }
                    else
                    {
                        $rep_non=$rep_non+1;//nombre non
                    }
                    $chrono=$this->dateDiff($demandeQH->getDateenvoie(),7);
                    if($demandeQH->getEtat()->getNometat()=="En attente de confirmation")
                    {
                        if($chrono['day'] < 0)
                        {
                            if($rep_oui<$rep_non)
                            {
                                $etat=$demandeQH->getEtat();

                                $etat->setNometat('Demande Refuser');
                            }
                            else
                            {
                                $etat=$demandeQH->getEtat();
                                $etat->setNometat('Demande Accepter');

                                if($montant_moyenne > 0)
                                {
                                    $demandeQH->setMontant($montant_moyenne);
                                }
                            }
                            $em->persist($etat);
                            $em->flush();
                        }
                    }

                }
            }



            if($request->getMethod()== 'POST') {

                $confirmation = new ConfirmationQH();
                $confirmation->setReponse($_POST["reponse"]);
                if($_POST['montant'])
                {
                    $confirmation->setMontant($_POST["montant"]);
                }
                $confirmation->setUserConfirme($this->getUser());
                $confirmation->setSocieteDemandeQH($demandeQH);
                $em->persist($confirmation);
                $em->flush();
                return $this->redirectToRoute('detail_societedemandeQhback',array('id'=>$demandeQH->getId()));
            }

        return $this->render('@Back/societe/confirmation_societedemandeQH.html.twig',array('demandeQH'=>$demandeQH,
            'garants'=>$garant,'confirmation'=>$confirmation,'confirmations'=>$listes_confirmation,
            'oui'=>$rep_oui,'non'=>$rep_non,'montant'=>$montant_moyenne,'min'=>$min,'h'=>$h,'day'=>$day));
    }
    //Fonction chrono
    public function dateDiff($date,$x)
    {
        $date2=time();
        date_modify($date,"+$x days");
        $date=date_format($date,"Y/m/d");
        $date1 = strtotime($date);
        $diff = $date1 - $date2;
        $retour = array();
        $tmp = $diff;
        $retour['debut'] = $date;
        $retour['second'] = $tmp % 60;
        $tmp = floor( ($tmp - $retour['second']) /60 );
        $retour['minute'] = $tmp % 60;
        $tmp = floor( ($tmp - $retour['minute'])/60 );
        $retour['hour'] = $tmp % 24;

        $tmp = floor( ($tmp - $retour['hour'])  /24 );
        $retour['day'] = $tmp;

        return $retour;
    }

    /**
     * societedemandeQH entities.
     *
     * @Route("/confirme-manuelle/AZT3{id}12ER", name="confirmation_manuelle")
     */
    public function confirmation_manuelleAction(Request $request,SocieteDemandeQH $demandeQH)
    {
        $em = $this->getDoctrine()->getManager();
        $tabgarant = $em->getRepository('DemandeQhBundle:Garant')->findBy(array('societe_demandeqh'=>$demandeQH));
        $listes_confirmation = $em->getRepository('DemandeQhBundle:ConfirmationQH')->findBy(array('societeDemandeQH'=>$demandeQH));

        $rep_oui=0;
        $rep_non=0;
        $nbr_montant=0;
        $montant=0;
        $montant_moyenne=0;

        if($listes_confirmation)
        {
            foreach ($listes_confirmation as $liste)//parcourir le table confirmation du demandeQh
            {
                if($liste->getReponse()=="oui")
                {
                    $rep_oui=$rep_oui+1;//nombre oui

                    if($liste->getMontant()>0)// determiner si l'admin a mis une montant
                    {
                        $nbr_montant=$nbr_montant+1;//nombre montant

                        $montant=$montant+$liste->getMontant();
                        $montant_moyenne=$montant/$nbr_montant;//moyen de monant

                    }


                }
                else
                {
                    $rep_non=$rep_non+1;//nombre non
                }
                $chrono=$this->dateDiff($demandeQH->getDateenvoie(),7);

                    if($chrono['day'] )
                    {
                        if($rep_oui<$rep_non)
                        {
                            $etat=$demandeQH->getEtat();

                            $etat->setNometat('Demande Refuser');
                        }
                        else
                        {
                            $etat=$demandeQH->getEtat();
                            $etat->setNometat('Demande Accepter');

                            if($montant_moyenne > 0)
                            {
                                $demandeQH->setMontant($montant_moyenne);
                            }
                        }
                        $em->persist($etat);
                        $em->flush();
                    }

            }
        }

            return $this->redirectToRoute('detail_societedemandeQhback',array('id'=>$demandeQH->getId()));

}
}
