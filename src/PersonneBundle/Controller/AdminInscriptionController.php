<?php

namespace PersonneBundle\Controller;

use AppBundle\Service\MonService;
use PaieBundle\Entity\Compte_Paie;
use PersonneBundle\Entity\Personne;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use PaieBundle\Entity\Procuration;

/**
 * Inscription des Utilisateurs
 *
 * @Route("/admin-user")
 */
class AdminInscriptionController extends Controller
{

    /**
     * Inscription des Utilisateurs
     *
     * @Route("/demande", name="personne_admin_demande")
     */
    public function listeDemandeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository_personne = $em->getRepository('PersonneBundle:Personne');

        $personnes = $repository_personne->createQueryBuilder('personne')
            ->where('personne.mdp IS NOT NULL')
            ->orderBy('personne.dateInscription', 'DESC')
            ->getQuery()->getResult()
        ;

//        $personnes = $repository_personne->findAll();

        return $this->render('@Personne/Admin/liste_demande.html.twig', array(
            'personnes' => $personnes
        ));

    }

    /**
     * PROFIL des Utilisateurs
     *
     * @Route("/{slug}/profil", name="personne_admin_profil")
     */
    public function profilUtilisateurAction(Personne $personne)
    {
        $em = $this->getDoctrine()->getManager();
        $procurations=$em->getRepository('PaieBundle:Procuration')->findBy(array('personne'=>$personne));

        return $this->render('@Personne/Admin/profil.html.twig', array(
            'personne' => $personne,
            'procurations'=> $procurations,
        ));
    }
    /**
     * PROFIL des Utilisateurs
     *
     * @Route("/AZER233{id}33/profil_utilisateur", name="personne_admin_profil_user")
     * @Method("GET")
     */
    public function profilUserAction(Request $request,User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$user));
        $datetime1 = new \DateTime(); // date actuelle
        $datetime2 = $personne->getDateNaissance();
        $age = $datetime1->diff($datetime2, true)->y;
        $procurations=$em->getRepository('PaieBundle:Procuration')->findBy(array('personne'=>$personne));
        return $this->render('@Personne/Admin/profil_user.html.twig', array(
            'personne' => $personne,
            'procurations'=> $procurations,
            'age'=>$age
        ));
    }

    /**
     * PROFIL des Utilisateurs
     *
     * @Route("/{slug}/c/confirme", name="personne_admin_confirmer")
     */
    public function confirmerUtilisateurAction(Personne $personne)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $user->setNom($personne->getNom());
        $user->setPrenom($personne->getPrenom());

        $user->setUsername($personne->getNumeroIts());

        $user->setPlainPassword($personne->getMdp());
        $user->setEmail($personne->getEmail());
        $user->setEmailCanonical($personne->getEmail());
        $user->setRoles(array('ROLE_USER'));
        $user->setEnabled(true);

        $userMager = $this->container->get('fos_user.user_manager');
        $userMager->updateUser($user, true);

        $message = (new \Swift_Message('Demande Accepter'))
            ->setFrom('association101.logiciel@gmail.com')
            ->setTo($personne->getEmail())
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    '@Personne/Email/accepter.html.twig',
                    ['personne' => $personne]
                ),
                'text/html'
            )
        ;

        $mailer = $this->get('swiftmailer.mailer');
        $mailer->send($message);

        $personne->setMdp(null);
        $personne->setUserCompte($user);


        $em->persist($user);
        $em->persist($personne);

        $em->flush();

        return $this->redirectToRoute('personne_admin_demande');
    }

    /**
     * PROFIL des Utilisateurs
     *
     * @Route("/refuser/r/{slug}", name="personne_admin_refuser")
     */
    public function refuserUtilisateurAction(Personne $personne)
    {
        $em = $this->getDoctrine()->getManager();

        $message = (new \Swift_Message('Demande Refusée'))
            ->setFrom('association101.logiciel@gmail.com')
            ->setTo($personne->getEmail())
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    '@Personne/Email/refuser.html.twig',
                    ['personne' => $personne]
                ),
                'text/html'
            )
        ;

        $mailer = $this->get('swiftmailer.mailer');
        $mailer->send($message);

        $em->remove($personne);

        $em->flush();

        return $this->redirectToRoute('personne_admin_demande');
    }




}
