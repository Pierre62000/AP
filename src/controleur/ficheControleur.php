<?php

function ficheControleur($twig){

    if(isset($_POST['btajouter'])){      
        $upload = new Upload(array('pdf'), 'fichier', 50000000);     
        $fiche = $upload->enregistrer('fiche');   
             
        header('Location: index.php?page=fiche&etat='.$etat);      
        exit;    
    }
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
        $exec=$produit->selectById($_GET['id']);      
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
    echo $twig->render('fiche.html.twig', array('form'=>$form));
}


?>