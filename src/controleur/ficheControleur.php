<?php

function ajoutficheControleur($twig, $db){
        $form = array();  
        $utilisateur = new Utilisateur($db);  
        $fiche = new Fiche($db); 

        if(isset($_POST['btajouter'])){    
            $nom = $_POST['nom'];
            $upload = new Upload(array('pdf'), 'fichier', 50000000);     
            $ficher = $upload->enregistrer('fiche');   
            $exec=$fiche->insert($libelle['fichier']);      
            if (!$exec){        
                $form['valide'] = false;          
                $form['message'] = 'Problème d\'insertion dans la table produit ';       
            }else{        
                $form['valide'] = true;  
                $form['nom']=$nom;      
            }  
        }        
        echo $twig->render('ajoutfiche.html.twig', array('form'=>$form));
}

function ficheControleur($twig, $db){
    $form = array();  
    $fiche = new Fiche($db); 
    if(isset($_POST['btCreation'])){  
    
        header('Location: index.php?page=ajoutfiche');      
        exit;    
    }

    if(isset($_POST['btSupprimer'])){      
        $cocher = $_POST['cocher'];      
        $form['valide'] = true;      
        $etat = true;      
        foreach ( $cocher as $id){        
            $exec=$fiche->delete($id);         
            if (!$exec){           
                $etat = false;          
            }      
        }      
        header('Location: index.php?page=fiche&etat='.$etat);      
        exit;    
    }
    if(isset($_GET['id'])){      
        $exec=$fiche->selectById($_GET['id']);      
        if (!$exec){        
            $etat = false;      
        }else{        
            $etat = true;      
        }
        header('Location: index.php?page=fiche&etat='.$etat);      
        exit;    
    } 
    

    if(isset($_GET['etat'])){       
            $form['etat'] = $_GET['etat'];     
    }

    $liste = $fiche->select(); 
    echo $twig->render('fiche.html.twig', array('form'=>$form,'liste'=>$liste));

}


?>