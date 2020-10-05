<?php

namespace FrontBundle\Controller;

use BackBundle\Entity\notif;
use PaieBundle\Entity\Procuration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PaieBundle\Entity\Historique_Paie;
use PersonneBundle\Entity\Personne;

/**
 * procuration controller.
 *
 * @Route("/procuration")
 */
class procurationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    /**
     * Paie controller.
     *
     * @Route("/ajouter", name="procuration_add")
     * @Method({"GET","POST"})
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->getMethod() == 'POST'){

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('id'=>$_POST['textid']));
        $procuration= new Procuration();

        $procuration->setNumeroits($_POST['numero_its']);
        $procuration->setNom($_POST['nom']);
        $procuration->setPersonne($personne);
        $procuration->setPrioriter($_POST['prioriter']);
        $procuration->setRelation($_POST['relation']);

        $em->persist($procuration);
        $em->flush();
        return $this->redirect($this->generateUrl('personne_profil'));


        }

    }
    /**
     * Procuration controller.
     *
     * @Route("/ajouter_procuration", name="procuration_ajouter")
     * @Method({"GET","POST"})
     */
    public function procuration_ajouterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));

           return $this->render('@Front/preocupation/preocupation.html.twig',array('personne'=>$personne));




    }
    /**
     * ProcurationAjax controller.
     *
     * @Route("/ajouter_procurationAjax", name="procuration_ajouterAjax")
     * @Method({"GET","POST"})
     */
    public function procurationAjaxAction(Request $request)
    {

                if( $request->isXmlHttpRequest())
                {
                    $em=$this->getDoctrine()->getManager();
                    $t1 = $request->request->all();

                    $personne = $em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte' => $this->getUser()));

                    $procuration = new Procuration();

                    $procuration->setNumeroits($t1['its']);
                    $procuration->setNom($t1['nom']);
                    $procuration->setPersonne($personne);
                    $procuration->setRelation($t1['lien']);
                    $procuration->setType($t1['type']);
                    $em->persist($procuration);
                    $em->flush();
                    return new Response("ok");

                }



    }
    /**
     * ProcurationaffichagAjax controller.
     *
     * @Route("/affichag_procurationAjax", name="procuration_affichagAjax")
     * @Method{"GET"}
     */
    public function affichageAjaxAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $data=array();
        $personne = $em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte' => $this->getUser()));

            if( $request->isXmlHttpRequest())
            {
                $datas=$em->getRepository('PaieBundle:Procuration')->findBy(array('personne'=>$personne));
                foreach ($datas as $valeur)
                {
                    array_push($data,array(
                        'id'=>$valeur->getId(),
                        'numeroits'=>$valeur->getNumeroits(),
                        'nom'=>$valeur->getNom(),
                        'relation'=>$valeur->getRelation(),
                        'type'=>$valeur->getType()
                    ));
                }
                return new Response(json_encode($data));
            }


    }
    /**
     * NotifaffichagAjax controller.
     *
     * @Route("/affichag_notifAjax", name="notif_affichagAjax")
     * @Method{"GET"}
     */
    public function notifAffichageAjaxAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $data=array();

            $notifs=$em->getRepository('BackBundle:notif')->findBy(array('etat'=>false));
                $output=" ";
                $x="op";
                $compte=0;
                $i=0;
                if ($notifs){

                    foreach ($notifs as $valeur)
                    {
                        $i=$i+1;
                        $output.='<li class="divider"> <a id="listem" href="/procuration/detail_notif/?id='.$valeur->getId().'"><strong>'.$valeur->getLabelle().'</strong><br /><small>'.date_format($valeur->getDate(),'d-m-yy').'</small></a></li><hr/>';

                    }                }else{
                    $output="<i  class='text-danger '><i class='fa fa-info'></i> Vous avez auccun notification</span>";
                }

        array_push($data,array(
            'notification'=>$output,
            'compte'=>$i,

        ));
            return new Response(json_encode($data));

    }

    /**
     * supprimerProcurationAjax controller.
     *
     * @Route("/supprimer_procurationAjax", name="procuration_supprimerAjax")
     * @Method({"GET","POST"})
     */
    public function supprimerAjaxAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        if( $request->isXmlHttpRequest())

        {
            $t1 = $request->request->all();

            $procuration=$em->getRepository('PaieBundle:Procuration')->findOneBy(array('id'=>$t1['id']));
            $em->remove($procuration);
            $em->flush();

            return new Response(json_encode('ok'));
        }


    }
    /**
     * detail notif controller.
     *
     * @Route("/detail_notif/", name="detail_notif")
     * @Method({"GET","POST"})
     */
    public function detailNotifAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $notif=$em->getRepository('BackBundle:notif')->findOneBy(array('id'=>$_GET['id']));
        $dmdRemboursement=$em->getRepository('PaieBundle:Demande_Remboursement')->findOneBy(array('notif'=>$notif));
        $versement=$em->getRepository('PaieBundle:Versement')->findOneBy(array('notif'=>$notif));
        if ($dmdRemboursement){
            return $this->redirectToRoute('demande_confirmation',array('id'=>$dmdRemboursement->getId()));
        }
        if($versement){
            return  $this->redirectToRoute('formulaireVersement',array('id'=>$versement->getId()));
        }


    }
}
