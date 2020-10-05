<?php

namespace DemandeQhBundle\Controller;
use DemandeQhBundle\Entity\Modification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use DemandeQhBundle\Entity\Etat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DemandeQhBundle\Entity\PhotoOr;
use DemandeQhBundle\Entity\DemandeQh;
use AppBundle\Service\MonService;
/**
 * dossierQhBack controller.
 *
 */
class pageQHController extends Controller
{
    /**
     * modificationdossierQH entities.
     *
     * @Route("modification", name="modificationQH")
     * @Method({"GET","POST"})
     */
    public function confirmationDossierQHAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager();

        $msg='';
        $usercompte=$this->getUser();

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$usercompte));

        $demande=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));

        $demandeQh=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demande));

        $garantior= $demandeQh->getDemadeQH()->getGarantieOR();

        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));

        $modifier=$em->getRepository('DemandeQhBundle:Modification')->findBy(array('etat'=>$demandeQh));

        if($request->getMethod() == 'POST')
        {
            $msg = 'Modification effectuer';
            $monservice=new MonService();

            if(($_POST['Nmontant']))
            {
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nmontant')
                    {

                        $entity = $em->merge($modifier);       //   <= ajoute cette ligne
                        $em->remove($entity);

                    }
                }
                $demande->setMontant($_POST['Nmontant']);
                $em->persist($demande);
                $em->flush();



            }
            if(($_POST['Nmois']))
            {
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nmois')
                    {

                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }

                $demande->setNombreMois($_POST['Nmois']);
                $em->persist($demande);
                $em->flush();

            }

            if(($_POST['Nmotif']))
            {
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nmotif')
                    {

                        $entity = $em->merge($modifier);
                        $em->remove($entity);


                    }
                }
                $demande->setTypeMotif($_POST['Nmotif']);
                $em->persist($demande);
                $em->flush();

            }

            if(($_POST['Ndetail']))
            {
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == "Ndetail")
                    {

                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $demande->setDetailMotif($_POST['Ndetail']);
                $em->persist($demande);
                $em->flush();


            }
            if(($_POST['Nvaleuror']))
            {
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == "Nvaleuror")
                    {

                        $entity =$em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $garantor = $demande->getGarantieOR();
                $garantor->setValeurAr($_POST['Nvaleuror']);
                $em->persist($demande);
                $em->flush();

            }
            if(($_POST['Nnomits']))
            {

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nnomits')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setNomIts($_POST['Nnomits']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngnumits'])){
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnumits')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setNumeroIts($_POST['Ngnumits']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngmoze'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngmoze')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setMoze($_POST['Ngmoze']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Nnomits1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nnomits1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }

                $garant2 = $demande->getGarant2();
                $garant2->setNomIts($_POST['Nnomits1']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ngnumits1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnumits1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setNumeroIts($_POST['Ngnumits1']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngmoze1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngmoze1')
                    {
                        break;
                    }
                }
                $entity = $em->merge($modifier);
                $em->remove($entity);
                $garant2 = $demande->getGarant2();
                $garant2->setMoze($_POST['Ngmoze1']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ngnom'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnom')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }

                $garant1 = $demande->getGarant1();
                $garant1->setNomcin($_POST['Ngnom']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngprenom'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngprenom')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setPrenomcin($_POST['Ngprenom']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngne'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngne')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setDateNaissance($_POST['Ngne']);
                $em->persist($garant1);
                $em->flush();

            }

            if(($_POST['Nglieu'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nglieu')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setLieu($_POST['Nglieu']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngadresse'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngadresse')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setAdresse($_POST['Ngadresse']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngville'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngville')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setVille($_POST['Ngville']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngnationalite'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnationalite')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setNationalite($_POST['Ngnationalite']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngtype'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngtype')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setTypePiece($_POST['Ngtype']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngnumpiece'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnumpiece')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setNumeroPiece($_POST['Ngnumpiece']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngvillepiece'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngvillepiece')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setVillePiece($_POST['Ngvillepiece']);
                $em->persist($garant1);
                $em->flush();

            }

            if(($_POST['Ngpayspiece'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngpayspiece')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setPaysPiece($_POST['Ngpayspiece']);
                $em->persist($garant1);
                $em->flush();

            }

            if(($_POST['Ngprofession'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngprofession')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }

                $garant1 = $demande->getGarant1();
                $garant1->setProfession($_POST['Ngprofession']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngtel1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngtel1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setTel1($_POST['Ngtel1']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngtel2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngtel2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setTel2($_POST['Ngtel2']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngemail'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngemail')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngemail']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngnumcheque1'])){

            foreach($modifier as $modifier)
            {
                if($modifier->getFormulaire() == 'Ngnumcheque1')
                {
                    $entity = $em->merge($modifier);
                    $em->remove($entity);
                    break;
                }
            }
            $garant1 = $demande->getGarant1();
            $garant1->setEmail($_POST['Ngnumcheque1']);
            $em->persist($garant1);
            $em->flush();

        }
            if(($_POST['Ngbanquecheque1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngbanquecheque1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngbanquecheque1']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngmontantcheque1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngmontantcheque1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngmontantcheque1']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngdatecheque1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngdatecheque1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngdatecheque1']);
                $em->persist($garant1);
                $em->flush();

            }

            if(($_POST['Ngnumcheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnumcheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngnumcheque2']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngbanquecheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngbanquecheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngbanquecheque2']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngmontantcheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngmontantcheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngmontantcheque2']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngdatecheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngdatecheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngdatecheque2']);
                $em->persist($garant1);
                $em->flush();

            }

            if(($_POST['Ngnumcheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnumcheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngnumcheque3']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngbanquecheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngbanquecheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngbanquecheque3']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngmontantcheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngmontantcheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngmontantcheque3']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngdatecheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngdatecheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setEmail($_POST['Ngdatecheque3']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngnomheritier'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngnomheritier')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setNomheritier1($_POST['Ngnomheritier']);
                $em->persist($garant1);
                $em->flush();

            }
            if(($_POST['Ngprenomheritier'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ngprenomheritier')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant1 = $demande->getGarant1();
                $garant1->setPrenomheritier1($_POST['Ngprenomheritier']);
                $em->persist($garant1);
                $em->flush();

            }















            if(($_POST['Ng1nom'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1nom')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }

                $garant2 = $demande->getGarant2();
                $garant2->setNomcin($_POST['Ng1nom']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1prenom'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1prenom')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setPrenomcin($_POST['Ng1prenom']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1ne'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1ne')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setDateNaissance($_POST['Ng1ne']);
                $em->persist($garant2);
                $em->flush();

            }

            if(($_POST['Ng1lieu'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1lieu')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setLieu($_POST['Ng1lieu']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1adresse'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1adresse')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setAdresse($_POST['Ng1adresse']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1ville'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1ville')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setVille($_POST['Ng1ville']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1nationalite'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1nationalite')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setNationalite($_POST['Ng1nationalite']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1type'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1type')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setTypePiece($_POST['Ng1type']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1numpiece'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1numpiece')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setNumeroPiece($_POST['Ng1numpiece']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1villepiece'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1villepiece')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setVillePiece($_POST['Ng1villepiece']);
                $em->persist($garant2);
                $em->flush();

            }

            if(($_POST['Ng1payspiece'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1payspiece')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setPaysPiece($_POST['Ng1payspiece']);
                $em->persist($garant2);
                $em->flush();

            }

            if(($_POST['Ng1profession'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1profession')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }

                $garant2 = $demande->getGarant2();
                $garant2->setProfession($_POST['Ng1profession']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1tel1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1tel1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setTel1($_POST['Ng1tel1']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1tel2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1tel2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setTel2($_POST['Ng1tel2']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1email'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1email')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1email']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1numcheque1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1numcheque1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1numcheque1']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1banquecheque1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1banquecheque1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1banquecheque1']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1montantcheque1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1montantcheque1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1montantcheque1']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1datecheque1'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1datecheque1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1datecheque1']);
                $em->persist($garant2);
                $em->flush();

            }

            if(($_POST['Ng1numcheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1numcheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1numcheque2']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1banquecheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1banquecheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1banquecheque2']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1montantcheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1montantcheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1montantcheque2']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1datecheque2'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1datecheque2')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1datecheque2']);
                $em->persist($garant2);
                $em->flush();

            }

            if(($_POST['Ng1numcheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1numcheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1numcheque3']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1banquecheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1banquecheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1banquecheque3']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1montantcheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1montantcheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1montantcheque3']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1datecheque3'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1datecheque3')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setEmail($_POST['Ng1datecheque3']);
                $em->persist($garant2);
                $em->flush();

            }

            if(($_POST['Ng1nomheritier'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1nomheritier')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setNomheritier1($_POST['Ng1nomheritier']);
                $em->persist($garant2);
                $em->flush();

            }
            if(($_POST['Ng1prenomheritier'])){

                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Ng1prenomheritier')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);
                        break;
                    }
                }
                $garant2 = $demande->getGarant2();
                $garant2->setPrenomheritier1($_POST['Ng1prenomheritier']);
                $em->persist($garant2);
                $em->flush();

            }



                if($scan = $monservice->uploadFichier('dossier', 'scan','Nsafahi')){
                    $dossier = $personne->getDossierEncours();
                    $dossier->setSafahi($scan);
                    foreach($modifier as $modifier)
                    {
                        if($modifier->getFormulaire() == 'Nsafahi')
                        {
                            $entity = $em->merge($modifier);
                            $em->remove($entity);

                        }
                    }
                    $em->persist($dossier);
                    $em->flush();

                }

            if($scan = $monservice->uploadFichier('dossier', 'scan','Nsolde')){
                $dossier = $personne->getDossierEncours();
                $dossier->setAttestationSoldeCompte($scan);
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nsolde')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $em->persist($dossier);
                $em->flush();

            }
            if($scan = $monservice->uploadFichier('dossier', 'scan','Nattestation')){
                $dossier = $personne->getDossierEncours();
                $dossier->setAttestationCopmteBank($scan);
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nattestation')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $em->persist($dossier);
                $em->flush();

            }
            if($scan = $monservice->uploadFichier('dossier', 'scan','Nformgarant')){
                $dossier = $personne->getDossierEncours();
                $dossier->setFormulaireGarantie($scan);
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nformgarant')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $em->persist($dossier);
                $em->flush();

            }
            if($scan = $monservice->uploadFichier('dossier', 'scan','Nchequebarre')){
                $dossier = $personne->getDossierEncours();
                $dossier->setChequeBare($scan);
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nchequebarre')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $em->persist($dossier);
                $em->flush();

            }
            if($scan = $monservice->uploadFichier('dossier', 'scan','Nformgarant1')){
                $dossier = $personne->getDossierEncours();
                $dossier->setFormulaireGarantie1($scan);
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nformgarant1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $em->persist($dossier);
                $em->flush();

            }
            if($scan = $monservice->uploadFichier('dossier', 'scan','Nchequebarre1')){
                $dossier = $personne->getDossierEncours();
                $dossier->setChequeBare1($scan);
                foreach($modifier as $modifier)
                {
                    if($modifier->getFormulaire() == 'Nchequebarre1')
                    {
                        $entity = $em->merge($modifier);
                        $em->remove($entity);

                    }
                }
                $em->persist($dossier);
                $em->flush();

            }
            return $this->redirectToRoute('modificationQH');


        }
        $nbr=count($modifier);
        return $this->render('@DemandeQh/pageQH/modificationDossierQh.html.twig',array('demandeQH'=>$demandeQh,
            'photoor'=>$photoor,'modifiers'=>$modifier,'msg'=>$msg,'nbr'=>$nbr,'personne'=>$personne
        ));
    }
   /**
    * rectificationdossierQH entities.
    *
    * @Route("rectification", name="rectificationQH")
    * @Method({"GET","POST"})
    */
    public function rectificationQHAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $usercompte=$this->getUser();

        $personne=$em->getRepository('PersonneBundle:Personne')->findOneBy(array('userCompte'=>$usercompte));

        $demande=$em->getRepository('DemandeQhBundle:DemandeQh')->findOneBy(array('numero'=>$personne->getNumeroDemandeQHtemp()));

        $demandeQh=$em->getRepository('DemandeQhBundle:Etat')->findOneBy(array('demadeQH'=>$demande));

        $garantior= $demandeQh->getDemadeQH()->getGarantieOR();

        $photoor=$em->getRepository('DemandeQhBundle:PhotoOr')->findBy(array('garantieor'=>$garantior));

        $modifier=$em->getRepository('DemandeQhBundle:Modification')->findBy(array('etat'=>$demandeQh));

        if(($_POST['Nmontant'])){

            $demande->setMontant($_POST['Nmontant']);
            $em->persist($demande);
            $em->flush();
            return new Response('Modification effectuer');

        }
        /*if(($t['mois']))
        {
            $demandeqh->setNombreMois($t['mois']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['motif']))
        {
            $demandeqh->setTypeMotif($t['motif']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }

        if(($t['detail']))
        {
            $demandeqh->setDetailMotif($t['detail']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['valeuror']))
        {
            $garantor = $demandeqh->getGarantieOR();
            $garantor->setValeurAr($t['valeuror']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['nomits'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setNomIts($t['nomits']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['its'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setNumeroIts($t['its']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['moze'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setMoze($t['moze']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['nomits1'])){
            $garant2 = $demandeqh->getGarant2();
            $garant2->setNomIts($t['nomits1']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['its1'])){
            $garant2 = $demandeqh->getGarant2();
            $garant2->setNumeroIts($t['its1']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['moze1'])){
            $garant2 = $demandeqh->getGarant2();
            $garant2->setMoze($t['moze1']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gnom'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setNomcin($t['gnom']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gprenom'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setPrenomcin($t['gprenom']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gne'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setDateNaissance($t['gne']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }

        if(($t['glieu'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setLieu($t['glieu']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gadresse'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setAdresse($t['gadresse']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gville'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setVille($t['gville']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gnationalite'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setNationalite($t['gnationalite']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gtype'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setTypePiece($t['gtype']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gnumpiece'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setNumeroPiece($t['gnumpiece']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gvillepiece'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setVillePiece($t['gvillepiece']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }

        if(($t['gpayspiece'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setPaysPiece($t['gpayspiece']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }

        if(($t['gprofession'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setProfession($t['gprofession']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gtel1'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setTel1($t['gtel1']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gtel2'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setTel2($t['gtel2']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        if(($t['gemail'])){
            $garant1 = $demandeqh->getGarant1();
            $garant1->setEmail($t['gemail']);
            $em->persist($demandeqh);
            $em->flush();
            return new Response('Modification effectuer');
        }
        return $this->render('@DemandeQh/pageQH/modificationDossierQh.html.twig',array('demandeQH'=>$demandeQh,
            'photoor'=>$photoor,'modifiers'=>$modifier
        ));*/
    }
}
