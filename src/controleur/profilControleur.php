<?php

function profilControleur($twig, $db){
    $form = array();
    if(!isset($_SESSION['login'])) {
        header("Location:index.php?page=connexion");
    }else {
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->findID($_SESSION['login']);
        
        $form['email']=$unUtilisateur['email'];
        $form['nom']=$unUtilisateur['nom'];
        $form['prenom']=$unUtilisateur['prenom'];
        $form['role']=$unUtilisateur['libelle'];
        $form['idRole']=$unUtilisateur['RID'];
        $form['dateEmbauche']=$unUtilisateur['dateEmbauche'];
    }
    echo $twig->render('profil.html.twig', array('form'=>$form));
}

?>