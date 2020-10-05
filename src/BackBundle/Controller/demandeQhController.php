<?php

namespace BackBundle\Controller;

use AppBundle\Service\GaranService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use DemandeQhBundle\Entity\Etat;
use DemandeQhBundle\Entity\SocieteDemandeQH;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DemandeQhBundle\Entity\PhotoOr;
use DemandeQhBundle\Entity\DemandeQh;
use AppBundle\Service\MonService;
use DemandeQhBundle\Entity\Modification;
/**
 * demandeQhBack controller.
 *
 * @Route("/dash/demandeQH/")
 */
class demandeQhController extends Controller
{
    /**
     * listedemandeQH entities.
     *
     * @Route(" ", name="listedemandeQH")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $repository_etat=$em->getRepository('DemandeQhBundle:Etat');
        $repository_societe=$em->getRepository('DemandeQhBundle:SocieteDemandeQH');
        $demandeQH=$repository_etat->findAll();
        $societedemandeQH=$repository_societe->findAll();
        return $this->render('@Back/demandeQh/ListeDemandeQh.html.twig', array('demandeQHs' => $demandeQH,
            'societedemandeQH' => $societedemandeQH));
    }


    /**
     * confirmationdemandeQH entities.
     *
     * @Route("confirmation_demandeQH/AZT{id}Z6T", name="confirmationdemandeQH")
     * @Method("GET")
     */
    public function confirmationDemandeQHAction(Request $request,Etat $etat)
    {

        $garantior= $etat->getDemadeQH()->getGarantieOR();
        $em=$this->getDoctrine()->getManager();
        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));

        $demandeqh = $etat->getDemadeQH();


        $garantservice = new GaranService();
        $res= $garantservice->testGarant($demandeqh->getGarant1(),$em,'garant1');
        $res1= $garantservice->testGarant($demandeqh->getGarant2(),$em,'garant2');

        if($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
             if($_POST['confirmer']=='Valider'){

                $etat->setNomEtat('Acceptée');
                $etat->setMotifFrontRefuser(null);
                $etat->setMotifBackRefuser(null);
                $demandeqh = $etat->getDemadeQH();
                $demandeqh->setUserConfirme($this->getUser());
                $etat->setMotifAccepter($_POST['motif_accepter']);
                $em->persist($etat);
                $em->persist($demandeqh);
                $em->flush();
                return $this->redirectToRoute('listedemandeQH');

            }
            if($_POST['confirmer']=='Refuser'){

                $etat->setNomEtat('Refuser');
                $etat->setMotifAccepter(null);
                $demandeqh = $etat->getDemadeQH();
                $demandeqh->setUserRefuser($this->getUser());
                $etat->setMotifFrontRefuser($_POST['motif_user']);
                $etat->setMotifBackRefuser($_POST['motif_admin']);
                $em->persist($etat);
                $em->persist($demandeqh);
                $em->flush();
                return $this->render('@Back/demandeQh/confirmationDemandeQh.html.twig', array('demandeQH' => $etat,'photoor'=>$photoor
                ));
            }
            if($_POST['confirmer']=='Modifier'){

                $etat->setNomEtat('Acceptée');
                $etat->getDemadeQH()->setMontant($_POST['montant']);
                $etat->getDemadeQH()->setTypeMotif($_POST['mois']);
                $etat->setMotifAccepter($_POST['motif_accepter']);
                $etat->getDemadeQH()->setUserRefuser(null);
                $em->persist($etat);
                $em->flush();
               return $this->render('@Back/demandeQh/confirmationDemandeQh.html.twig', array('demandeQH' => $etat,'photoor'=>$photoor
                ));


            }


        }
        return $this->render('@Back/demandeQh/confirmationDemandeQh.html.twig',array('demandeQH'=>$etat,
            'photoor'=>$photoor,'res'=>$res,'res1'=>$res1
            ));
    }
    /**
     * accepterdemandeQH entities.
     *
     * @Route("accepter_demandeQH/AZT{id}Z6T", name="accepterdemandeQH")
     * @Method({"GET","POST"})
     */
    public function accepterDemandeQHAction(Request $request)
    {
        if($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $etat = $em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('id' => $_POST['id_etat']));
            $etat->setNomEtat('Acceptée');
            $etat->setMotifFrontRefuser(null);
            $etat->setMotifBackRefuser(null);
            $demandeqh = $etat->getDemadeQH();
            $demandeqh->setUserconfirme($this->getUser());
            $etat->setMotifAccepter($_POST['motif_accepter']);
            $em->persist($etat);
            $em->persist($demandeqh);
            $em->flush();
            return $this->render('@Back/demandeQh/confirmationDemandeQh.html.twig', array('demandeQH' => $etat
            ));
        }
    }
    /**
     * notificationQHfront entities.
     *
     * @Route("notification1", name="notification1Qh")
     * @Method({"GET","POST"})
     */
    public function notification1QhAction(Request $request)
    {

        if( $request->isXmlHttpRequest()){

            $em=$this->getDoctrine()->getManager();
            $t1 = $request->request->all(); // tableau des champs POST
            //récuperer les variables POST
            // $t1['nom'] ,   $t1['prenom'] ,   $t1['adresse'] ...
            // puis faire traitement souhaité tel que ajouter les données en base

            // exit;
            $dossier=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('id'=>$t1['id_demandeqh']));

            $modification= new Modification();


            if (!empty($t1['notif_montant'])){

                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_montant']);
                $modification->setNotif($t1['notif_montant']);
                $em->persist($modification);
                $em->flush();
            }

            if (!empty($t1['notif_gnumits'])){

                $modification= new Modification();
                $modification->setEtat($dossier);
                $modification->setFormulaire('Nnomits');
                $modification->setNotif('!!');

                $em->persist($modification);

                $modification= new Modification();
                $modification->setEtat($dossier);
                $modification->setFormulaire('Ngmoze');
                $modification->setNotif('!!');
                $em->persist($modification);

                $modification->setEtat($dossier);
                $modification->setFormulaire($t1['check_gnumits']);
                $modification->setNotif($t1['notif_gnumits']);
                $em->persist($modification);
                $em->flush();
            }
            if (!empty($t1['notif_gmoze'])){



                $modification= new Modification();
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


        }


    }
}
