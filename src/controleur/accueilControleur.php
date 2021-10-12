<?php

function accueilControleur($twig){
    echo $twig->render('accueil.html.twig', array());
}


function contactControleur($twig,$db){
    $formC = array();
    if (isset($_POST['ContactE'])){
        $nomC = $_POST['inputNomC'];
        $inputEmailC = $_POST['inputEmailC'];
        $messageC = $_POST['inputMC'];
        $formC['valideC'] = true;
        $utilisateurC = new Contact($db);
        $execC = $utilisateurC->insertC($inputEmailC, $nomC, $messageC);
        if (!$execC){
            $formC['valide'] = false;
            $formC['message'] = 'Problème d\'insertion dans la table utilisateur';
        }
        $formC['nomC'] = $nomC;
        $formC['emailC'] = $inputEmailC;
        $formC['messageC'] = $messageC;
    }

    echo $twig->render('contact.html.twig', array('formC'=>$formC));
}

?>