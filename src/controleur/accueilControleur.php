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

function inscrireControleur($twig,$db){
    $form = array();
    if (isset($_POST['btInscrire'])){
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputPassword2 =$_POST['inputPassword2'];
        $nom = $_POST['inputNom'];
        $prenom =$_POST['inputPrenom'];
        $role = $_POST['role'];
        $form['valide'] = true;
        if ($inputPassword!=$inputPassword2){
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        }
        else {
            $utilisateur = new Utilisateur($db);
            $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $nom, $prenom);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
            }
        }
        $form['nom'] = $nom;
        $form['prenom'] = $prenom;
        $form['email'] = $inputEmail;
        $form['role'] = $role;
    }

    echo $twig->render('inscrire.html.twig', array('form'=>$form));
}

function connexionControleur($twig, $db){
    $form = array();
    if (isset($_POST['btConnecter'])){
        $form['valide'] = true;
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->connect($inputEmail);
        if ($unUtilisateur!=null){
            if(!password_verify($inputPassword,$unUtilisateur['mdp'])){
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
        }
        else{
            $_SESSION['login'] = $inputEmail;
            $_SESSION['role'] = $unUtilisateur['idRole'];
            header("Location:index.php");
        }
    }
        else{
            $form['valide'] = false;
            $form['message'] = 'Login ou mot de passe incorrect';
        }
    }
    echo $twig->render('connexion.html.twig', array('form'=>$form));
}

function deconnexionControleur($twig, $db){
    session_unset();
    session_destroy();
    header("Location:index.php");    
}

?>