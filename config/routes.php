<?php

function getPage($db){

    $lesPages['accueil'] = "accueilControleur";
    $lesPages['inscrire'] = "inscrireControleur";
    $lesPages['contact'] = "contactControleur";
    $lesPages['maintenance'] = "maintenanceControleur";
    $lesPages['fiche'] = "ficheControleur";
    $lesPages['ajoutfiche'] = "ajoutficheControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['utilisateur'] = "utilisateurControleur";
    $lesPages['type'] = "typeControleur";
    $lesPages['utilisateurmodif'] = "utilisateurModifControleur";
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
            $contenu = $lesPages['connexion'];
        }
        return $contenu;
    }
    else{
        $contenu = $lesPages['maintenance'];
    }
}
    
?>