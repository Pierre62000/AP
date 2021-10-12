<?php
    function utilisateurControleur($twig, $db){
        $form = array();
        $utilisateur = new Utilisateur($db);
        $liste = $utilisateur->select();
        echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
    }
    
    function inscrireControleur($twig,$db){
        $form = array();
        if(isset($_SESSION['login'])) {
            header("Location:index.php?page=accueil");
        }else {
            if (isset($_POST['btInscrire'])){
                $nom = $_POST['inputNom'];
                $prenom =$_POST['inputPrenom'];
                $email = $_POST['inputEmail'];
                $role = 1;
                $inputPassword = $_POST['inputPassword'];
                $inputPassword2 =$_POST['inputPassword2'];
                $form['valide'] = true;
                if ($inputPassword!=$inputPassword2){
                    $form['valide'] = false;
                    $form['message'] = 'Les mots de passe sont différents';
                }
                else {
                    $utilisateur = new Utilisateur($db);
                    $exec = $utilisateur->insert($email, password_hash($inputPassword, PASSWORD_DEFAULT),$nom, $prenom, $role);
                    if (!$exec){
                        $form['valide'] = false;
                        $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
                    }
                }
                $form['nom'] = $nom;
                $form['prenom'] = $prenom;
                $form['email'] = $email;
                $form['role'] = $role;
            }
        }
        echo $twig->render('inscrire.html.twig', array('form'=>$form));
    }
    
    function connexionControleur($twig, $db){
        $form = array();
        if (isset($_POST['btConnecter'])){
            $form['email'] = false;
            $form['mdp'] = false;
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $utilisateur = new Utilisateur($db);
            $unUtilisateur = $utilisateur->connect($inputEmail);
            $unUtilisateur2 = $utilisateur->findID($inputEmail);
            $UID = $unUtilisateur2['UID'];

            if ($unUtilisateur!=null){
                if(!password_verify($inputPassword,$unUtilisateur['mdp'])){
                    $form['mdp'] = true;
                } else {
                    //$exec = $utilisateur->updateConnexion($UID);
                    $_SESSION['login'] = $unUtilisateur['email'];
                    $_SESSION['password'] = $unUtilisateur['mdp'];
                    $_SESSION['role'] = $unUtilisateur['idRole'];
                    
                    header("Location:index.php?page=accueil");
                }
            } else{
                $form['email'] = true;
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