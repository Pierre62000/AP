<?php

function getPage($db){

    $lesPages['accueil'] = "accueilControleur";
    $lesPages['inscrire'] = "inscrireControleur";
    $lesPages['contact'] = "contactControleur";
    $lesPages['maintenance'] = "maintenanceControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['utilisateur'] = "utilisateurControleur";
    $lesPages['profil'] = "profilControleur";
    $lesPages['utilisateurmod'] = "utilisateurModifControleur";
    $lesPages['twofactor'] = "twofactorControleur";


    if ($db!=null){
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 'connexion';
        }
        if (isset($lesPages[$page])){
            $contenu = $lesPages[$page];
        }
        else{
            $contenu = $lesPages['accueil'];
        }
        return $contenu;
    }
    else{
        $contenu = $lesPages['maintenance'];
    }
}

?>