<?php

namespace CompteGroupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * grpdemande controller.
 *
 */
class DemandeQHController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
