<?php

namespace FrontBundle\Controller;
use AppBundle\Service\MonService;
use AppBundle\Service\MultipleUpload;
use FrontBundle\FrontBundle;
use BackBundle\Entity\notif;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use PaieBundle\Entity\Compte_Hussen;
use PersonneBundle\Entity\Personne;
use PaieBundle\Entity\Versement;
use PaieBundle\Entity\Historique_Paie;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Versement controller.
 *
 * @Route("/compte-hussein-scheme/versement")
 */
class versementController extends Controller
{
    /**
     * Versement_liste controller.
     *
     * @Route("/vos-versements", name="versement_liste")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $usercompte=$this->getUser();
        $repository_personne=$em->getRepository('PersonneBundle:Personne');
        $personne=$repository_personne->findOneBy(array('userCompte'=>$usercompte));
        $repository_versement=$em->getRepository('PaieBundle:Versement');
        $versements=$repository_versement->findBy(array('personne'=>$personne));
        return $this->render('@Front/versement/versement_liste.html.twig',array('versements' => $versements,'personne'=>$personne));
    }
    /**
     * Versement_ajouter entities.
     *
     * @Route("/n/ajouter", name="versement_ajouter")
     * @Method({"GET","POST"})
     */
    public function addAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $usercompte=$this->getUser();
        $repository_personne=$em->getRepository('PersonneBundle:Personne');
        $personne=$repository_personne->findOneBy(array('userCompte'=>$usercompte));
        $numero_compte=$em->getRepository('PaieBundle:Compte_Hussen')->findAll();
        $procurations = $em->getRepository('PaieBundle:Procuration')->findBy(array('type'=>'procuration','personne'=>$personne));

        if($request->getMethod()=='POST'){

            $usercompte=$this->getUser();
            $repository_personne=$em->getRepository('PersonneBundle:Personne');
            $personne=$repository_personne->findOneBy(array('userCompte'=>$usercompte));
            $compte_hussen=$em->getRepository('PaieBundle:Compte_Hussen')->findOneBy(array('id'=>$_POST['numero_compte']));
            $versement=new Versement();

            $date = \DateTime::createFromFormat('d/m/Y', $_POST['date_versement']);
            $versement->setDate($date);
            $versement->setPersonne($personne);
            $versement->setUserCreer($usercompte);
            $versement->setUserConfirme(null);
            $versement->setUserRefuse(null);
            $versement->setEtat('En attente de confirmation');
            $versement->setPaiement($_POST['paiement']);

            if(isset($_FILES['fichier_cheque']))
            {
                $tab_bordereau =array();
                $monservice= new MultipleUpload();
                if($borderau = $monservice->uploadFichiers('fichier', 'cheque', 'fichier_cheque'))
                {
                    for($i=0;$i<count($borderau);$i++)
                    {
                        array_push($tab_bordereau,array(
                            'url' => $borderau[$i],
                        ));
                    }

                    $versement->setBorderauUrl($tab_bordereau);
                }
            }
            if (isset($_POST['procuration'])){
                $procuration=$em->getRepository('PaieBundle:Procuration')->findOneBy(array('nom'=>$_POST['listProcuration'],'type'=>'procuration'));
                $versement->setProcuration($procuration);
            }

            $versement->setCompteHussen($compte_hussen);
            $versement->setMontant($_POST['montant']);
            $notif= new notif();
            $notif->setDate(new \DateTime());
            $notif->setLabelle('Versement notifiée par:'.$versement->getPersonne()->getNom()." ".$versement->getPersonne()->getPrenom());
            $notif->setEtat(false);
            $versement->setNotif($notif);
            $em->persist($notif);
            $em->persist($versement);

            $compte_Paie = $personne->getComptePaie();
            $historique_paie = new Historique_Paie();
            $historique_paie->setComptePaie($compte_Paie);
            $historique_paie->setVersement($versement);
            $date = \DateTime::createFromFormat('d/m/Y', $_POST['date_versement']);
            $historique_paie->setDate($date);
            if (isset($_POST['procuration'])){
                $historique_paie->setLibelle('Demande de versement par ' .$procuration->getNom().'('.number_format($versement->getMontant(),'2',',',' ').')');

            }else{
                $historique_paie->setLibelle('Demande de versement ('.number_format($versement->getMontant(),'2',',',' ').')');
            }
            $historique_paie->setMontant($versement->getMontant());
            $historique_paie->setType('0');
            $em->persist($historique_paie);
            $em->flush();
            return $this->redirect($this->generateUrl('versement_liste'));
        }
        return $this->render('@Front/versement/versement_ajouter.html.twig',array('numero_compte'=>$numero_compte,
            'personne'=>$personne,'procurations'=>$procurations));

    }
}
