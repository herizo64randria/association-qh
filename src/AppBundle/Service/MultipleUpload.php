<?php
/**
 * Created by PhpStorm.
 * User: haja
 * Date: 20/02/2019
 * Time: 06:32
 */

namespace AppBundle\Service;


class MultipleUpload
{
    public function randomLettres($len) {
        $chars = 'ABCDEFGHIJK123456789';
        $randnb = '';
        for ($i = 0; $i < $len; ++$i)
            $randnb .= substr($chars, (mt_rand() % strlen($chars)), 1);
        return $randnb;
    }

    public function uploadFichiers($dossier, $type, $nom) {


        $nbrfichier = count($_FILES[$nom]['name']);
        $tab_nom_bd=array();
        for($i=0;$i<$nbrfichier;$i++) {
            $rand = $this->randomLettres(8);
            $filename = $_FILES[$nom]['name'][$i];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $nom_bd = $dossier . '\\' . $rand . '-' . $type . '.' . $ext;
            $tab_nom_bd[$i]=$nom_bd;

            $resultat = move_uploaded_file($_FILES[$nom]['tmp_name'][$i], 'document/' . $nom_bd);


        }
        if (count($tab_nom_bd)>0){
            return $tab_nom_bd;
        }else{
            return false;
        }

    }
}