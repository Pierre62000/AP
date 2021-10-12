<?php
    function utilisateurControleur($twig, $db){
        $form = array();
        $utilisateur = new Utilisateur($db);
        $liste = $utilisateur->select();
        echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
    }
    
    function inscrireControleur($twig,$db){
        $form = array();
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