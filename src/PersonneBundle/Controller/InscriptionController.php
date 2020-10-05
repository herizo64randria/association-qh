<?php

namespace PersonneBundle\Controller;

use AppBundle\Service\MonService;
use PaieBundle\Entity\Compte_Paie;
use PersonneBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\MultipleUpload;
use DemandeQhBundle\Entity\Moze;


/**
 * Inscription des Utilisateurs
 *
 * @Route("/")
 */
class InscriptionController extends Controller
{

    /**
     * Inscription des Utilisateurs
     *
     * @Route("/register", name="personne_inscription")
     */
    public function inscriptionPage1Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $mozes = $em->getRepository('DemandeQhBundle:Moze')->findAll();

        if($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            //test des données
            $types = array('nom', 'prenom', 'nom_its', 'adresse', 'ville', 'num_sabil', 'num_its', 'email1', 'mdp1', 'phone1');
            $vide = 0;

            foreach ($types as $type){
                if(!isset($_POST[$type]) or strlen($_POST[$type]) <= 0) $vide = 1;
            }

            if($vide != 0) {
                return new Response('Vous devez remplir toute les champs. Veuillez réessayer');
            }

            $moze = $em->getRepository('DemandeQhBundle:Moze')->findOneBy(array('id'=>$_POST['moze']));
            $personne = new Personne();
            $uploads= new MultipleUpload();
            $upload = new MonService();
            $tab_cin = array();

            if(isset($_FILES['scancin']))
            {
                if($res = $uploads->uploadFichiers('cin','cin','scancin'))
                {
                    for($i=0;$i<count($res);$i++)
                    {
                        array_push($tab_cin,array(
                            'url' => $res[$i],
                        ));
                    }

                    $personne->setScanCin($tab_cin);
                }
            }

            $personne->setNom($_POST['nom']);
            $personne->setPrenom($_POST['prenom']);
            $personne->setNomIts($_POST['nom_its']);
            $personne->setAdresse($_POST['adresse']);
            $personne->setVille($_POST['ville']);
            $personne->setNumeroSabil($_POST['num_sabil']);
            $personne->setEmail($_POST['email1']);
            $personne->setMdp($_POST['mdp1']);
            $personne->setNum1($_POST['phone1']);
            $personne->setTypePiece($_POST['piece_identite']);
            $personne->setLieu($_POST['lieu_naissance']);
            $personne->setProfession($_POST['profession']);
            $personne->setPaysPiece($_POST['pays_piece']);
            $personne->setNumeroIts($_POST['num_its']);
            $personne->setNumerocin($_POST['numero_cin']);
            $personne->setDelivrer($_POST['delivrer']);
            $personne->setNationalite($_POST['nationalite']);
            $date_naissance = \DateTime::createFromFormat('d/m/Y', $_POST['date_naissance']);
            $personne->setDateNaissance($date_naissance);
            $personne->setMoze($moze);
            $date_cin = \DateTime::createFromFormat('d/m/Y', $_POST['date_cin']);
            $personne->setDateCin($date_cin);
            $personne->setSexe($_POST['sexe']);

            $monservice = new MonService();
            $personne->setSlug($monservice->randomLettre(10));

            if(isset($_POST['phone2'])){
                $personne->setNum2($_POST['phone2']);
            }
            if(isset($_POST['phone3'])){
                $personne->setNum3($_POST['phone3']);
            }
            if($photo = $monservice->uploadFichier('profil', 'photo', 'photo')){
                $personne->setPhoto($photo) ;
            }else{
                return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
            }
            if(isset($_FILES['scan_its']))
            {
                if($scan = $monservice->uploadFichier('carte', 'carte', 'scan_its')){
                    $personne->setScan($scan) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }
           

            $comptePaie = new Compte_Paie();
            $comptePaie->setSlug($monservice->randomLettre(10));

            $personne->setComptePaie($comptePaie);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comptePaie);
            $em->persist($personne);

            $em->flush();

            return $this->render('@Personne/Inscription/confirmation.html.twig');

        }

        return $this->render('@Personne/Inscription/incription.html.twig',array('mozes'=>$mozes));
    }

    /**
     * Inscription des Utilisateurs
     *
     * @Route("/test", name="personne_test")
     */
    public function inscriptionOKAction(Request $request)
    {


        return $this->render('@Personne/Inscription/confirmation.html.twig');
    }


}
