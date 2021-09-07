<?php
    function utilisateurControleur($twig, $db){
        $form = array();
        $utilisateur = new Utilisateur($db);
        $liste = $utilisateur->select();
        echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
    }
    
      
?>