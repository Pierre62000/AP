<?php
function utilisateurModifControleur($twig, $db){ 
    $form = array();    
    if(isset($_GET['id'])){    
        $utilisateur = new Utilisateur($db);    
        $unUtilisateur = $utilisateur->selectById($_GET['id']);      
        if ($unUtilisateur!=null){      
            $form['utilisateur'] = $unUtilisateur; 
            $role = new Role($db);      
            $liste = $role->select();      
            $form['roles']=$liste;   
        }else{      
            $form['message'] = 'Utilisateur incorrect';      
        } 
    }else{        
        if(isset($_POST['btModifier'])){       
            $utilisateur = new Utilisateur($db);       
            $nom = $_POST['nom'];       
            $prenom = $_POST['prenom'];       
            $role = $_POST['role'];       
            $id = $_POST['id'];
            $mdp =$_POST['inputPassword'];       
            $exec=$utilisateur->update($id, $role, $nom, $prenom);  
            if ($mdp  == null){
                $form['valide'] = false;
                $form['message'] = "ce n'est pas le meme mot de passe";
            }else{
                $exec=$utilisateur->updateMdp($id, password_hash($mdp, PASSWORD_DEFAULT));
            }
            
            if(!$exec){         
                $form['valide'] = false;           
                $form['message'] = 'Echec de la modification';        
            }else{ 
                $form['valide'] = true;           
                $form['message'] = 'Modification réussie';         
            }
        }
        else{
            $form['message'] = 'Utilisateur non précisé';
        }
    }
echo $twig->render('utilisateur-modif.html.twig', array('form'=>$form));}
?>