<?php

namespace CompteGroupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CompteGroupeBundle:Default:index.html.twig');
    }
}
