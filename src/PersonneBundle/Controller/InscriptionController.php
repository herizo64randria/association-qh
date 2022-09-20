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
use UserBundle\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
           // $types = array('nom', 'prenom', 'nom_its', 'adresse', 'ville', 'num_sabil', 'num_its', 'email1', 'mdp1', 'phone1');
            $types = array('email1','email2', 'mdp2', 'mdp1');

            $vide = 0;

            foreach ($types as $type){
                if(!isset($_POST[$type]) or strlen($_POST[$type]) <= 0) $vide = 1;
            }

            if($vide != 0) {
                return new Response('Vous devez remplir toute les champs. Veuillez réessayer');
            }

/* $moze = $em->getRepository('DemandeQhBundle:Moze')->findOneBy(array('id'=>$_POST['moze']));*/
            $personne = new Personne();
            $uploads= new MultipleUpload();
            $upload = new MonService();
            $tab_cin = array();

           /* if(isset($_FILES['scancin']))
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
            }*/

           /* $personne->setNom($_POST['nom']);
            $personne->setPrenom($_POST['prenom']);
            $personne->setNomIts($_POST['nom_its']);
            $personne->setAdresse($_POST['adresse']);
            $personne->setVille($_POST['ville']);
            $personne->setNumeroSabil($_POST['num_sabil']);*/
            $personne->setEmail($_POST['email1']);
            $personne->setMdp($_POST['mdp1']);
           /* $personne->setNum1($_POST['phone1']);
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
            $personne->setSexe($_POST['sexe']);*/

            $monservice = new MonService();
            $personne->setSlug($monservice->randomLettre(10));

            /*if(isset($_POST['phone2'])){
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
           */

            $comptePaie = new Compte_Paie();
            $comptePaie->setSlug($monservice->randomLettre(10));

            $personne->setComptePaie($comptePaie);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comptePaie);
            $em->persist($personne);


            $em->flush();
/*
            $user = $this->get('fos_user.user_manager')->findUserByEmail($email);
            $url = $this->generateUrl('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);

            $message = \Swift_Message::newInstance()
                ->setSubject('Registration confirmation')
                ->setFrom('rijarija1991@gmail.com')
                ->setTo($email)
                ->setContentType('text/html')
                ->setBody(
                    $this->renderView(
                        "@Personne/Inscription/confirmation.html.twig", array(
                        'user' => $user,
                        'url' => $url))
                )
            ;

            $mailer = $this->get('swiftmailer.mailer');
            $mailer->send($message);*/

           $this->sendConfirmationEmail($personne,$_POST['email1']);
            return $this->render('@Personne/Inscription/message.html.twig');

        }

        return $this->render('@Personne/Inscription/incription.html.twig',array('mozes'=>$mozes));
    }
    /**
     * PROFIL des Utilisateurs
     *
     * @Route("/c/email/confirme/{id}", name="personne1_confirmer")
     */
    public function confirmerUserAction(Request $request ,Personne $personne)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        //$personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('id'=>$personne));
        $user->setNom($personne->getNom());
        $user->setPrenom($personne->getPrenom());

        $user->setUsername('*');

        $user->setPlainPassword($personne->getMdp());
        $user->setEmail($personne->getEmail());
        $user->setEmailCanonical($personne->getEmail());
        $user->setRoles(array('ROLE_USER'));
        $user->setEnabled(true);

       $userMager = $this->container->get('fos_user.user_manager');
        $userMager->updateUser($user, true);

        $personne->setMdp(null);
        $personne->setUserCompte($user);


        $em->persist($user);
        $em->persist($personne);

        $em->flush();

        return $this->redirectToRoute('fos_user_security_login');
    }

    private function sendConfirmationEmail(Personne  $personne,$email)
    {


        $subject = 'Email Confirmation';
        $label = 'Confirm Email';


        $href = $this->generateUrl('personne1_confirmer',array('id'=>$personne->getId()));
        $hote = $_SERVER['HTTP_HOST'];
        $url=$href;
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('rijarija1991@gmail.com')
            ->setTo( $email )
            ->setContentType('text/html')
            ->setBody(
                $this->renderView(
                    "@Personne/Inscription/confirmation.html.twig", array(
                    'url' => $url))
            );

        $this->get('mailer')->send($message);

        return true;
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
