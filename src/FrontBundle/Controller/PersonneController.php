<?php

namespace FrontBundle\Controller;

use BackBundle\Entity\notif;
use FrontBundle\Entity\Invitation;
use PaieBundle\Entity\Notification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PaieBundle\Entity\Historique_Paie;
use PersonneBundle\Entity\Personne;
use PaieBundle\Entity\Procuration;
use AppBundle\Service\MonService;


/**
 * Paie controller.
 *
 * @Route("/")
 */
class PersonneController extends Controller
{

    /**
     * Personne controller.
     *
     * @Route("/ajax/invite1", name="addajax_invite1")
     */
    public function addInvite1AjaxAction(Request $request)
    {

        if( $request->isXmlHttpRequest())
        { if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https";
        else
            $url = "http";

            // Ajoutez // à l'URL.
            $url .= "://";

            // Ajoutez l'hôte (nom de domaine, ip) à l'URL.
            $url .= $_SERVER['HTTP_HOST'];
            // $url .= $_SERVER['REQUEST_URI'];
            $em=$this->getDoctrine()->getManager();
            $t1 = $request->request->all();
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('numeroIts'=>$_POST['its']));
            $output='
<div class="col-12"><p><b>Nom et prénom :</b> '.$personne->getNom()." ".$personne->getPrenom().'</p><p> <b>Date de naissance :</b>'. date_format($personne->getDateNaissance(),"d-m-yy").
                '<div  style="display: inline-block"></p><p><b>Contact :</b>'.$personne->getNum1()."/".$personne->getNum2()
                .'<p/><p><b>Adresse :</b>'.$personne->getAdresse().'</p><p><b>Email:</b>'.$personne->getEmail().'</p>
</div></div></div>';

            return new Response($output);

        }

    }

    /**
     * Personne controller.
     *
     * @Route("/ajax/cheque", name="afficheajax_cheque")
     */
    public function addChequeAjaxAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $histo_caisse=$em->getRepository('BackBundle:Historique_Caisse')->find($_GET['id']);
        $cheque=$histo_caisse->getCheque();
        $out='<input name="id" type="hidden" value="'.$histo_caisse->getId().'"><p><b>Banque :</b>'. $cheque->getBanque() .'</p>
        <p><b>Numéro chèque :</b>'.$cheque->getNumero().'</p><p><b>Libelle :</b>'.$cheque->getLibelle().'</p><p><b>Montant :</b>'.number_format($histo_caisse->getMontant(),'2',',',' ').' Ar</p>
        <p>
        <div style="text-align:center;float:right;margin-top:-150px;"><img style="width:150px;height: 150px;" src="../document/'
            .$cheque->getScanUrl().'" /><br><b>Scan chèque </b> </div></p>';
        return new Response($out);

    }
    /**
     * Personne controller.
     *
     * @Route("/ajax/invite", name="addajax_invite")
     */
    public function addInviteAjaxAction(Request $request)
    {

        if( $request->isXmlHttpRequest())
        { if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        {$url = "https";}
        else{
            $url = "http";

            // Ajoutez // à l'URL.
            $url .= "://";

            // Ajoutez l'hôte (nom de domaine, ip) à l'URL.
            $url .= $_SERVER['HTTP_HOST'];
            // $url .= $_SERVER['REQUEST_URI'];
            $em=$this->getDoctrine()->getManager();
            $t1 = $request->request->all();
            $personneEncours=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('numeroIts'=>$t1['its']));

            if ($personne){
                if ($personne==$personneEncours){
                    $output="<div class=\"alert alert-danger\">Impossible d'envoyé une demande de suivie de votre propre compte</div>";
                }else{
                    $output='<div class="row"><div class="col-4"><img style="margin:5px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);width:150px;height:150px" src="'.$url.'/document/'.$personne->getPhoto().'"/></div>

<div class="col-8"><p><b>Nom et prénom :</b> '.$personne->getNom()." ".$personne->getPrenom().'</p><p> <b>Date de naissance :</b>'. date_format($personne->getDateNaissance(),"d-m-yy").
                        '<div  style="display: inline-block"></p><p><b>Contact :</b>'.$personne->getNum1()."/".$personne->getNum2()
                        .'<p/><p><b>Adresse :</b>'.$personne->getAdresse().'</p><p><b>Email:</b>'.$personne->getEmail().'</p>
</div></div>

                <a class="btn btn-lg btn-info" href="/send-invite/'.$personne->getId().'"><i class="fa fa-group"></i> Envoyé une invitation</a></div>';
                }

            }else{
                $output="<div class=\"alert alert-danger\">Aucun resultat</div>";

            }


            return new Response($output);
        }


        }

    }
    /**
     * Personne controller.
     *
     * @Route("/refuser-invite)", name="refuser_invite")
     */
    public function refuserInviteAction(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $t1 = $request->request->all();
            $em=$this->getDoctrine()->getManager();
            $invitation=$em->getRepository('FrontBundle:Invitation')
                ->findOneBy(array('id'=>$t1['id']));
            $em->remove($invitation);
            $em->flush();
            return new Response('ok');
        }
    }
    /**
     * Personne controller.
     *
     * @Route("/confirme-invite)", name="confirme_invite")
     */
    public function ConfirmeInviteAction(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $t1 = $request->request->all();
            $em=$this->getDoctrine()->getManager();
            $invitation=$em->getRepository('FrontBundle:Invitation')
                ->findOneBy(array('id'=>$t1['id']));
            $userCreer=$invitation->getUserCreer();
            $userInviter=$invitation->getUserInviter();
            $userCreer->addInviter1($userInviter);
            $userCreer->addPersonne1($userCreer);
            $invitation->setEtat(true);
            $invite= new Invitation();
            $invite->setDate(new \DateTime());
            $invite->setUserCreer($userInviter);
            $invite->setUserInviter($userCreer);
            $invite->setEtat(true);
            $invite->setLibelle( $userInviter->getNom()." ". $userInviter->getPrenom()." vous envoie une invitation pour voir votre compte (autoùmatique).");

            $userInviter->addPersonne1($userInviter);
            $userInviter->addInviter1($userCreer);
            $em->persist($invite);
            $em->flush();
            return new Response($userInviter->getNom());
        }

    }

    /**
     * Personne controller.
     *
     * @Route("/confirmeback-invite)", name="confirmeback_invite")
     */
    public function ConfirmebackInviteAction(Request $request)
    {
        if($request->isXmlHttpRequest()){

            $em=$this->getDoctrine()->getManager();
            $personne=$em->getRepository('PersonneBundle:Personne')
                ->findOneBy(array('numeroIts'=>$_GET['personne']));
            $inviter=$em->getRepository('PersonneBundle:Personne')
                ->findOneBy(array('numeroIts'=>$_GET['its']));
            $comparePersonne=$em->getRepository('PersonneBundle:Personne')->find($inviter);
           if ($comparePersonne){
               return new Response("Personne déja suivie");
           }
            $personne->addInviter1($inviter);
            $personne->addPersonne1($personne);

            $inviter->addPersonne1($inviter);
            $inviter->addInviter1($personne);
            $em->persist($personne);
            $em->persist($inviter);
            $em->flush();
            return new Response("Ajout de suivie avec succès");
        }

    }
    /**
     * Personne controller.
     *
     * @Route("/send-invite/{id}", name="send_invite")
     */
    public function sendInviteAction(Request $request,Personne $personneInvite)
    {
        $em=$this->getDoctrine()->getManager();
        $personneInvite=$em->getRepository('PersonneBundle:Personne')->find($personneInvite);
        $personneEncour=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
        $invite1=$em->getRepository('FrontBundle:Invitation')->findOneBy(array('userCreer'=>$personneEncour,'userInviter'=>$personneInvite));
        $invite2=$em->getRepository('FrontBundle:Invitation')->findOneBy(array('userCreer'=>$personneInvite,'userInviter'=>$personneEncour));
        $invite="";

        if($invite1){
            $invite=$invite1;
        }
        if($invite2){
            $invite=$invite2;
        }
        // return new Response($personneEncour->getInviter1());
        if( $invite){
            $msg="Vous avez déja suivie cette personne";
        }
        else{
            $invite= new Invitation();
            $invite->setDate(new \DateTime());
            $invite->setUserCreer($personneEncour);
            $invite->setUserInviter($personneInvite);
            $invite->setEtat(false);
            $invite->setLibelle( $personneEncour->getNom()." ". $personneEncour->getPrenom()." vous envoie une invitation pour voir votre compte .");

            $em->persist($invite);
            $em->flush();
            $msg="Votre invitation est bien envoyé";

        }

        return $this->render('@Front/invitation/add_invitation.html.twig',array('personne'=>$personneEncour,'msg'=>$msg));

    }
    /**
     * NotifaffichagAjax controller.
     *
     * @Route("/affichag_notif_InviteAjax", name="notifInvite_affichagAjax")
     * @Method{"GET"}
     */
    public function notifInviteAffichageAjaxAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
        $data=array();

        $notifs=$em->getRepository('FrontBundle:Invitation')->findBy(array('etat'=>false,'userInviter'=>$personne));
        $output=" ";

        $compte=0;
        $i=0;
        if ($notifs){

            foreach ($notifs as $valeur)
            {
                $i=$i+1;
                $output.='<li  class="divider"><strong>'.$valeur->getLibelle().'</strong><br /><small style="margin-left: 20px;"> '.date_format($valeur->getDate(),'d-m-yy').'</small><br>
                <a class="btn btn-lg btn-success" data-id="'.$valeur->getId().'" onclick="confirmer(confirme'.$i.')" href="void:javascript(0);" id="confirme'.$i.'" >Confirmer</a> 
                <a class="btn btn-lg btn-danger" data-id="'.$valeur->getId().'"  onclick="refuser(refuse'.$i.')"  href="void:javascript(0);" id="refuse'.$i.'" >Refuser</a>
                </li><hr/>';

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
     * Personne controller.
     *
     * @Route("/profil/FCDA{id}47FDS", name="add_invite")
     */
    public function addInviteAction(Request $request,Personne $personne)
    {

        $msg="";
        return $this->render('@Front/invitation/add_invitation.html.twig',array('personne'=>$personne,'msg'=>$msg));

    }
    /**
     * Personne controller.
     *
     * @Route("/profil", name="personne_profil")
     */
    public function profilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usercompte = $this->getUser();

        if($usercompte->ifRole('ROLE_ADMIN')){
            return $this->redirectToRoute('paie_liste1');
        }

        $repository_personne=$em->getRepository('PersonneBundle:Personne');
        $personne = $repository_personne->findOneBy(array('userCompte'=>$usercompte));
        $service=new MonService();
        $purcentage=$service->profilComplet($personne,$em);
        $cin=$personne->getScanCin();
        $procurations=$em->getRepository('PaieBundle:Procuration')->findBy(array('personne'=>$personne));
        //return new Response($purcentage);
        return $this->render('@Front/Personne/profil.html.twig', array(
            'personne' => $personne,
            'procurations'=>$procurations,
            'cins'=>$cin,
            'purcentage'=>$purcentage,
        )
        );
    }
    /**
     * Personne controller.
     *
     * @Route("/heritage/{id}", name="lettre_heritage")
     */
    public function heiritageAction(Personne $personne)
    {
        $em=$this->getDoctrine()->getManager();
      /*  $repository_personne=$em->getRepository('PersonneBundle:Personne');
        $personne = $repository_personne->findOneBy(array('userCompte'=>$this->getUser()));*/
        $repository_heritier=$em->getRepository('PaieBundle:Procuration');
        $heritier =$repository_heritier->findBy(array('type'=>'heritier','personne'=>$personne));
        $tfox = $this->get('t_fox_mpdf_port.pdf');


        $html = $this->render('@Front/heritier/heritier.html.twig',array('personne'=>$personne,'heritier'=>$heritier));

        return new \TFox\MpdfPortBundle\Response\PDFResponse($tfox->generatePdf($html));
    }

}
