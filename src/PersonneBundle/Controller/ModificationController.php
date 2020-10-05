<?php

namespace PersonneBundle\Controller;

use AppBundle\Service\MonService;
use AppBundle\Service\MultipleUpload;
use PaieBundle\Entity\Compte_Paie;
use PersonneBundle\Entity\Personne;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use PaieBundle\Entity\Procuration;
use UserBundle\Entity\User;

/**
 * modification_Utilisateurs controller
 *
 * @Route("/")
 */
class ModificationController extends Controller
{

    /**
     * personne
     *
     * @Route("/modification", name="modification_profil")
     * @Method({"GET","POST"})
     */
    public function modificationPage1Action(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $repository_personne=$em->getRepository('PersonneBundle:Personne');

        $personne = $repository_personne->findOneBy(array('userCompte'=>$this->getUser()));

        $procurations=$em->getRepository('PaieBundle:Procuration')->findBy(array('personne'=>$personne));
        $mozes = $em->getRepository('DemandeQhBundle:Moze')->findAll();
        $service=new MonService();
        $purcentage=$service->profilComplet($personne,$em);
        if ($request->getMethod() == 'POST') {

            $personne->setNom($_POST['nom']);
            $personne->setPrenom($_POST['prenom']);
            $personne->setNomIts($_POST['nom_its']);
            $personne->setAdresse($_POST['adresse']);
            $personne->setVille($_POST['ville']);
            $personne->setNumeroSabil($_POST['num_sabil']);
            $personne->setEmail($_POST['email1']);
            $personne->setNum1($_POST['phone1']);
            $personne->setNum2($_POST['phone2']);
            $personne->setNum3($_POST['phone3']);
            $personne->setNumeroIts($_POST['num_its']);
            $personne->setLieu($_POST['lieu_naissance']);
            $personne->setProfession($_POST['profession']);
            $personne->setPaysPiece($_POST['pays_piece']);
            $personne->setDelivrer($_POST['delivrer']);
            $personne->setTypePiece($_POST['piece_identite']);
            $moze = $em->getRepository('DemandeQhBundle:Moze')->findOneBy(array('id'=>$_POST['moze']));
            if($moze!=$personne->getMoze()){
                $personne->setMoze($moze);

            }
            $monservice = new MonService();

            if (isset($_POST['phone2'])) {
                $personne->setNum2($_POST['phone2']);
            }
            if (isset($_FILES['photo']) ) {
                if ($photo = $monservice->uploadFichier('profil', 'photo', 'photo')) {
                    $personne->setPhoto($photo);
                }
            }
            if (isset($_FILES['tphoto']) ) {
                if ($photo = $monservice->uploadFichier('profil', 'photo', 'tphoto')) {
                    $personne->setPhoto($photo);
                }
            }
            if (isset($_FILES['scan_its'])) {
                if ($scan = $monservice->uploadFichier('carte', 'carte', 'scan_its')) {
                    $personne->setScan($scan);
                }
            }
            if (isset($_FILES['tscan_its'])) {
                if ($scan = $monservice->uploadFichier('carte', 'carte', 'tscan_its')) {
                    $personne->setScan($scan);
                }
            }
            if (isset($_FILES['scan_cin'])) {
                $tab_cin = array();
                $uploads = new MultipleUpload();
                if ($res = $uploads->uploadFichiers('carte', 'carte', 'scan_cin')) {
                    if(count($res)>1){
                        for ($i = 0; $i < count($res); $i++) {
                            array_push($tab_cin, array(
                                'url' => $res[$i],
                            ));
                        }

                        $personne->setScanCin($tab_cin);
                    }

                }
            }
            if (isset($_FILES['tscan_cin'])) {
                $tab_cin = array();
                $uploads = new MultipleUpload();
                if ($res = $uploads->uploadFichiers('carte', 'carte', 'tscan_cin')) {
                    if(count($res)>1){
                        for ($i = 0; $i < count($res); $i++) {
                            array_push($tab_cin, array(
                                'url' => $res[$i],
                            ));
                        }

                        $personne->setScanCin($tab_cin);
                    }

                }
            }
            $em->persist($personne);

            $em->flush();
            return $this->redirect($this->generateUrl('personne_profil'));

        }

        return $this->render('@Personne/modification/modification.hmtl.twig',
            array('personne'=>$personne,'mozes'=>$mozes,'purcentage'=>$purcentage));
    }
}