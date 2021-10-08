<?php

function ajoutficheControleur($twig, $db){
    $form = array();  
    $utilisateur = new Utilisateur($db);  
    $fiche = new Fiche($db); 
    if(isset($_POST['btajouter'])){      
        $upload = new Upload(array('pdf'), 'fichier', 50000000);     
        $fiche = $upload->enregistrer('fiche');   
             
        echo $twig->render('fiche.html.twig', array('form'=>$form));
    }
}

function ficheControleur($twig, $db){
    $form = array();  
    $fiche = new Fiche($db); 

    if(isset($_POST['btSupprimer'])){      
        $cocher = $_POST['cocher'];      
        $form['valide'] = true;      
        $etat = true;      
        foreach ( $cocher as $id){        
            $exec=$produit->delete($id);         
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
    echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));

}


?>