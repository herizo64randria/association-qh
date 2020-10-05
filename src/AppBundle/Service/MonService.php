<?php
/**
 * Created by PhpStorm.
 * User: Allin RAMANAMPISOA
 * Date: 31/01/2019
 * Time: 15:50
 */

namespace AppBundle\Service;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerDecorator;
use PersonneBundle\Entity\Personne;
use Symfony\Component\HttpFoundation\Response;


class MonService
{
    public function randomLettre($len) {
        $chars = 'ABCDEFGHIJK123456789';
        $randnb = '';
        for ($i = 0; $i < $len; ++$i)
            $randnb .= substr($chars, (mt_rand() % strlen($chars)), 1);
        return $randnb;
    }
    public function profilComplet(Personne $personne,ObjectManager $em){

        $procuration=$em->getRepository('PaieBundle:Procuration')->findBy(array('type'=>'procuration','personne'=>$personne));
        $heritier=$em->getRepository('PaieBundle:Procuration')->findBy(array('type'=>'heritier','personne'=>$personne));
       $valP="";
       $valH="";

          if($procuration){
              $valP="p";
          }
          if($heritier){
                $valH="h";
          }
            $data=array();
            $data[]=$personne->getNom();
            $data[]=$personne->getPrenom();
            $data[]=$personne->getAdresse();
            $data[]=$personne->getDateNaissance();
            $data[]=$personne->getDateCin();
            $data[]=$personne->getEmail();
            $data[]=$personne->getLieu();
            //$data[]=$personne->getMoze();
            $data[]=$personne->getNationalite();
            $data[]=$personne->getNomIts();
            $data[]=$personne->getNum1();
            $data[]=$personne->getNum2();
            $data[]=$personne->getNumerocin();
            $data[]=$personne->getNumeroIts();
            $data[]=$personne->getNationalite();
            $data[]=$personne->getProfession();
            $data[]=$personne->getNumeroSabil();
            $data[]=$personne->getPaysPiece();
            $data[]=$personne->getTypePiece();
            $data[]=$personne->getVille();
            $data[]=$personne->getScanCin();
            $data[]=$personne->getScan();
            $data[]=$personne->getPhoto();
            $data[]=$personne->getMoze();
            $data[]=$valP;
            $data[]=$valH;

            $purcentage=0;
            foreach ($data as $val){
                if(!empty($val)){
                    $purcentage=$purcentage+1;
                }
            }

            $res=($purcentage/count($data))*100;

        return $res;
    }

    public function uploadFichier($dossier, $type, $nom) {
        $rand = $this->randomLettre(7);

        $filename = $_FILES[$nom]['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $nom_bd = $dossier.'\\'.$rand.'-'.$type.'.'.$ext;

        $resultat = move_uploaded_file($_FILES[$nom]['tmp_name'],'document/'.$nom_bd);

        if ($resultat){
            return $nom_bd;
        }else{
            return false;
        }
    }

    public function asLetters($number) {
        $convert = explode('.', $number);
        $num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
            'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');

        $num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
            60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');

        if (isset($convert[1]) && $convert[1] != '') {
            return self::asLetters($convert[0]).' virgule '.self::asLetters($convert[1]);
        }
        if ($number < 0) return 'moins '.self::asLetters(-$number);
        if ($number < 17) {
            return $num[17][$number];
        }
        elseif ($number < 20) {
            return 'dix-'.self::asLetters($number-10);
        }
        elseif ($number < 100) {
            if ($number%10 == 0) {
                return $num[100][$number];
            }
            elseif (substr($number, -1) == 1) {
                if( ((int)($number/10)*10)<70 ){
                    return self::asLetters((int)($number/10)*10).'-et-un';
                }
                elseif ($number == 71) {
                    return 'soixante-et-onze';
                }
                elseif ($number == 81) {
                    return 'quatre-vingt-un';
                }
                elseif ($number == 91) {
                    return 'quatre-vingt-onze';
                }
            }
            elseif ($number < 70) {
                return self::asLetters($number-$number%10).'-'.self::asLetters($number%10);
            }
            elseif ($number < 80) {
                return self::asLetters(60).'-'.self::asLetters($number%20);
            }
            else {
                return self::asLetters(80).'-'.self::asLetters($number%20);
            }
        }
        elseif ($number == 100) {
            return 'cent';
        }
        elseif ($number < 200) {
            return self::asLetters(100).' '.self::asLetters($number%100);
        }
        elseif ($number < 1000) {
            return self::asLetters((int)($number/100)).' '.self::asLetters(100).($number%100 > 0 ? ' '.self::asLetters($number%100): '');
        }
        elseif ($number == 1000){
            return 'mille';
        }
        elseif ($number < 2000) {
            return self::asLetters(1000).' '.self::asLetters($number%1000).' ';
        }
        elseif ($number < 1000000) {
            return self::asLetters((int)($number/1000)).' '.self::asLetters(1000).($number%1000 > 0 ? ' '.self::asLetters($number%1000): '');
        }
        elseif ($number == 1000000) {
            return 'millions';
        }
        elseif ($number < 2000000) {
            return self::asLetters(1000000).' '.self::asLetters($number%1000000);
        }
        elseif ($number < 1000000000) {
            return self::asLetters((int)($number/1000000)).' '.self::asLetters(1000000).($number%1000000 > 0 ? ' '.self::asLetters($number%1000000): '');
        }
    }
}