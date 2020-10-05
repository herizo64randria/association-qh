<?php

namespace PersonneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Personne/Accueil/accueil.html.twig');
    }


}
