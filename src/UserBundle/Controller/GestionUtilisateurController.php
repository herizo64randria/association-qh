<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UserBundle\Entity\User;

class GestionUtilisateurController extends Controller
{
    /**
     * Liste Utilisateur
     *
     * @Route("/liste-user", name="utilisateur_liste")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository_user = $em->getRepository('UserBundle:User');
        $users = $repository_user->findBy(
            array(),
            array('username' => 'asc')
        );


        return $this->render('@User/GestionUser/index.html.twig',
            array('users' => $users)
        );


    }

    /**
     * Nouveau Utilisateur ADMIN
     *
     * @Route("/i/inscription", name="utilisateur_nouveau")
     */
    public function nouveauAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository_user = $em->getRepository('UserBundle:User');

        if($request->getMethod() == 'POST'){
            $user = new User();

            $test_mail = $repository_user->findOneBy(array('email' => $_POST['email']));

            if(! $test_mail){
                $user->setEmail($_POST['email']);
            }else return new Response('Email Existant dans la base de données');

            $user->setNom($_POST['nom']);
            $user->setPrenom($_POST['prenom']);

            $user->setUsername($_POST['username']);

            $user->setPlainPassword($_POST['mdp1']);
            $user->setEmailCanonical($user->getEmail());
            $user->setRoles(array('ROLE_ADMIN'));
            $user->setEnabled(true);

            $userMager = $this->container->get('fos_user.user_manager');
            $userMager->updateUser($user, true);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('utilisateur_liste');
        }

        return $this->render('@User/GestionUser/nouveau.html.twig');

    }

    /**
     * Changer Etat
     *
     * @Route("/changer/{id}/etat", name="utilisateur_change_etat")
     */
    public function changerEtatAction(User $user){
        $em = $this->getDoctrine()->getManager();

        if($user->isEnabled()){
            $user->setEnabled(false);
        }else{
            $user->setEnabled(true);

        }

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('utilisateur_liste');

    }


    /**
     * Modifier Compte
     *
     * @Route("/m/modifier/{id}", name="utilisateur_modifier")
     */
    public function modifierAction(User $user, Request $request){
        $em = $this->getDoctrine()->getManager();

        $repository_user = $em->getRepository('UserBundle:User');

        if($request->getMethod() == 'POST'){

            $user->setNom($_POST['nom']);
            $user->setPrenom($_POST['prenom']);

            if($user->getEmail() != $_POST['email']){
                $test_mail = $repository_user->findOneBy(array('email' => $_POST['email']));

                if(! $test_mail){
                    $user->setEmail($_POST['email']);
                }else return new Response('Email Existant dans la base de données');
            }

            if(! empty($_POST['mdp1'])){
                $user->setPlainPassword($_POST['mdp1']);

                $userMager = $this->container->get('fos_user.user_manager');
                $userMager->updateUser($user, true);


            }

            $em->persist($user);

            $em->flush();

             return $this->redirectToRoute('utilisateur_liste');
        }

        return $this->render('@User/GestionUser/modifier.html.twig', array(
            'user' => $user
        ));


    }


}
