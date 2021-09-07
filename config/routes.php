<?php

function getPage($db){

    $lesPages['commentaire'] = "commentaireControleur";
    $lesPages['commentairemod'] = "commentaireModifControleur";


    $lesPages['accueil'] = "accueilControleur";
    $lesPages['vente'] = "venteControleur";
    $lesPages['inscrire'] = "inscrireControleur";
    $lesPages['contact'] = "contactControleur";
    $lesPages['maintenance'] = "maintenanceControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['utilisateur'] = "utilisateurControleur";
    $lesPages['type'] = "typeControleur";
    $lesPages['utilisateurmod'] = "utilisateurModifControleur";
    $lesPages['produitajout'] = "produitAjoutControleur";
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