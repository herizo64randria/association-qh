<?php

namespace CompteAssociationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use CompteAssociationBundle\Entity\Association;
use AppBundle\Service\MonService;
use PaieBundle\Entity\Compte_Paie;
use CompteAssociationBundle\Entity\MembreAssoc;

class AssociationController extends Controller
{
    /**
     * Association entities.
     *
     * @Route("/creer-association", name="add_association")
     * @Method({"GET","POST"})
     */
    public function addAssociationAction(Request $request)
    {
        if($request->getMethod() == 'POST'){

            $association = new Association();
            $monservice = new MonService();
            $association->setDateassociation(new \DateTime());
            $association->setNomassociation($_POST['nomassoc']);
            $association->setUserCreer($this->getUser());
            $association->setDescription($_POST['desc']);
            if(isset($_FILES['photo']))
            {
                if($photo = $monservice->uploadFichier('profil', 'assoc', 'photo')){
                    $association->setPhoto($photo) ;
                }else{
                    return new Response('Erreur! Erreur dans le téléchargement de l\'images..');
                }
            }

            $comptePaie = new Compte_Paie();
            $membreassoc = new MembreAssoc();
            $comptePaie->setSlug($monservice->randomLettre(10));
            $association->setComptePaie($comptePaie);
            $em = $this->getDoctrine()->getManager();
            $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
            $membreassoc->setAssociation($association);
            $membreassoc->setDatemembreassoc(new \DateTime());
            $membreassoc->setPersonne($personne);
            $em->persist($comptePaie);
            $em->persist($association);
            $em->persist($membreassoc);

            $em->flush();
            return $this->redirectToRoute('accueil_association');
        }
        return $this->render('@CompteAssociation/association/CreerAssociation.html.twig');
    }
    /**
     * Association entities.
     *
     * @Route("/accueil-association/ADCBTS34DF23{id}FG3TYA", name="accueil_association")
     * @Method({"GET","POST"})
     */
    public function accueilAssociationAction(Request $request,Association $association)
    {
        return $this->render('@CompteAssociation/association/AccueilAssociation.html.twig',array('association'=>$association));
    }
    /**
     * Association controller.
     *
     * @Route("/liste-association", name="liste-association")
     * @Method{"GET"}
     */
    public function listAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));
        $data=$em->getRepository('CompteAssociationBundle:MembreAssoc')->findBy(array('personne'=>$personne));
        return $this->render('@CompteAssociation/association/ListeAssociation.html.twig',array('membres'=>$data));
    }

    /**
     * AssociationaffichagAjax controller.
     *
     * @Route("/affichag_membreassocAjax", name="membreassoc_affichagAjax")
     * @Method{"GET"}
     */
    public function affichageassocAjaxAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {
            $em=$this->getDoctrine()->getManager();

            $personne = $em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$this->getUser()));

            $datas=$em->getRepository('CompteGroupeBundle:Membre')->findBy(array('personne'=>$personne));
            $nombre = count($datas);
            return new Response($nombre);
        }


    }

}
