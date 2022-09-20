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
        $repository_etat=$em->getRepository('DemandeQhBundle:DemandeQh');
        $repository_societe=$em->getRepository('DemandeQhBundle:SocieteDemandeQH');
        $demandeQH=$repository_etat->findAll();
        $societedemandeQH=$repository_societe->findAll();
        return $this->render('@Back/demandeQh/ListeDemandeQh.html.twig', array('demandeQHs' => $demandeQH,
            'societedemandeQH' => $societedemandeQH));
    }

    private function sendEmail(DemandeQh  $demande,$email)
    {


        $subject = 'Etat de votre Demande QH';



        $href = $this->generateUrl('listeDemandeQHeffectuer');
        $hote = $_SERVER['HTTP_HOST'];
        $status=$demande->getEtat()->getNomEtat();
        $num=$demande->getNumero();
        $url=$href;
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('rijarija1991@gmail.com')
            ->setTo( $email )
            ->setContentType('text/html')
            ->setBody(
                $this->renderView(
                    "@Personne/Inscription/msgDmdConfirme.html.twig", array(
                    'url' => $url,'status'=>$status,'num'=>$num))
            );

        $this->get('mailer')->send($message);

        return true;
    }
    /**
     * confirmationdemandeQH entities.
     *
     * @Route("reçu_dossier/AZT{id}Z6T", name="reçu_DossierQH")
     * @Method("GET")
     */
    public function reçuDossierQHAction(Request $request,DemandeQh $demandeqh)
    {
        $em=$this->getDoctrine()->getManager();

        $demandeqh->getDossier()->setValide('Dossier reçu');
        $em->flush();
        return $this->redirectToRoute('confirmationdemandeQH',array('id'=>$demandeqh->getId()));

    }
    /**
     * confirmationdemandeQH entities.
     *
     * @Route("confirmation_demandeQH/AZT{id}Z6T", name="confirmationdemandeQH")
     * @Method("GET")
     */
    public function confirmationDemandeQHAction(Request $request,DemandeQh $demandeqh)
    {

        $garantior= $demandeqh->getGarantieOR();
        $em=$this->getDoctrine()->getManager();
        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));




        $garantservice = new GaranService();
        $res= $garantservice->testGarant($demandeqh->getGarant1(),$em,'garant1');
        $res1= $garantservice->testGarant($demandeqh->getGarant2(),$em,'garant2');

        if($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $etat=$demandeqh->getEtat();
             if($_POST['confirmer']=='Valider'){


                 $etat->setNomEtat(etat::ACCEPTER);
                $etat->setMotifFrontRefuser(null);
                $etat->setMotifBackRefuser(null);
                $demandeqh->setUserConfirme($this->getUser());
                 $demandeqh->setDateConfirme(new \DateTime('now'));
                $etat->setMotifAccepter($_POST['motif_accepter']);
                $em->persist($etat);
                $em->persist($demandeqh);
                $em->flush();
                $this->sendEmail($demandeqh,$demandeqh->getPersonne()->getEmail());
                return $this->redirectToRoute('listedemandeQH');

            }
            if($_POST['confirmer']=='Refuser'){

                $demandeqh->getEtat()->setNomEtat(etat::REFUSER);

                $demandeqh->setUserRefuser($this->getUser());
                $etat->setMotifFrontRefuser($_POST['motif_user']);
                $etat->setMotifBackRefuser($_POST['motif_admin']);
                $em->persist($etat);
                $em->persist($demandeqh);
                $em->flush();
                $this->sendEmail($demandeqh,$demandeqh->getPersonne()->getEmail());

                return $this->render('@Back/demandeQh/confirmationDemandeQh.html.twig', array('demandeQH' => $demandeqh,'photoor'=>$photoor,'res'=>$res,'res1'=>$res1
                ));
            }
            if($_POST['confirmer']=='Modifier'){

                $demandeqh->getEtat()->setNomEtat(etat::ACCEPTER_MODIFIER);

                $demandeqh->setUserRefuser(null);
                $demandeqh->getEtat()->setRemarque($_POST['motif']);
                $em->persist($etat);
                $em->persist($demandeqh);
                $em->flush();
                $this->sendEmail($demandeqh,$demandeqh->getPersonne()->getEmail());

                return $this->render('@Back/demandeQh/confirmationDemandeQh.html.twig', array('demandeQH' => $demandeqh,'photoor'=>$photoor,'res'=>$res,'res1'=>$res1
                ));


            }


        }
        return $this->render('@Back/demandeQh/confirmationDemandeQh.html.twig',array('demandeQH'=>$demandeqh,
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
