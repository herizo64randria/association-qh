<?php

namespace UserBundle\Controller;

use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RegistrationController extends Controller{

    public function sendConfirmationEmailMessage(User $user)
    {
    
        $confirmationToken = $user->getConfirmationToken();
        $username = $user->getUsername();
    
        $subject = 'Account activation';
        $email = $user->getEmail();
    
        $renderedTemplate = $this->templating->render('AppBundle:Emails:registration.html.twig', array(
            'username' => $username,
            'confirmationToken' => $confirmationToken
        ));
    
        $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(MAILER_FROM)
                ->setReplyTo(MAILER_FROM)
                ->setTo($email)
                ->setBody($renderedTemplate, "text/html");
    
        $this->mailer->send($message);
    
    }
    
    /**
    * @Route("user/activate/{token}")
    */
    public function confirmAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:User');
    
        $user = $repository->findUserByConfirmationToken($token);
    
        if (!$user)
        {
            throw $this->createNotFoundException('We couldn\'t find an account for that confirmation token');
        }
    
        $user->setConfirmationToken(null);
        $user->setEnabled(true);
    
        $em->persist($user);
        $em->flush();
    
        return $this->redirectToRoute('user_registration_confirmed');
    }
    
    public function registerAction(Request $request)
    {
        /* All the logic goes here: form validation, creating new user */
        /* $user is created user */
        sendConfirmationEmailMessage($user);
    }



}

