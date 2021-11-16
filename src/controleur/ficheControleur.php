<?php

function generateficheControleur($twig, $db){
    $form = array();
    $nbr = 0;  
    $taux = new Taux($db);
    $fichier = new Fichier($db);
    $liste = $taux->select();  
    if(isset($_GET['id'])){      
        $unTaux = $taux->selectById($_GET['id']); 
        //$nbr=$id; 
        if ($unTaux!=null){      
            $form['nbr'] = $unTaux;  
        }else{      
            $form['message'] = 'Taux incorrect';      
        }  
    }   
    if(isset($_POST['btgenerate'])){ 
        $fiche = new Fiche($db);             
        $heure = $_POST['heure'];       
        $tauxS = $_POST['taux']; 
        $cocher = $_POST['cocher'];      
        $form['valide'] = true;      
        $etat = true;      
        foreach ( $cocher as $id){        
            $tauxA=1;         
            if (!$exec){           
                $etat = true;          
            }      
        } 
        $brut = $heure * $tauxS; 
        $MMID = $brut * $untaux / 100;  
        $CCid = $brut * $untaux / 100;
        $CS   = $brut + '' * $untaux / 100;  
        $accident = $brut * $untaux / 100;
        $plafonné = $brut * $untaux / 100;
        $deplafonné = $brut * $untaux / 100;
        $complémentaire = $brut * $untaux / 100;
        $famille = $brut * $untaux / 100;
        $chomage = $brut * $untaux / 100;
        $contributeur = $brut * $untaux / 100;
        $forfait = $brut * (8/100) * $untaux / 100;
        $cotisation = $brut * $untaux / 100;
        $CSG = $brut * (1.75/100) * $untaux / 100;
        $exonum = $brut * $untaux / 100;
        $CRDS = $brut * (1.75/100) * $untaux / 100;
        $deduire=$MMID+$CCid+$CS+$accident+$plafonné+$deplafonné+$complémentaire+$famille+$chomage+$contributeur+$forfait+$cotisation+$CSG+$exonum+$CRDS;
        $salaire = $brut-$deduire;
        $pdf = $this->get('knp_snappy.pdf')->getOutputFromHtml($html);
        file_put_content($pdf,'fiche_de_paie-'+$nbr+'.pdf');
            
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),200,array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
        $pdf = $this->get('knp_snappy.pdf')->getOutputFromHtml($html);
        file_put_content($pdf,'fiche_de_paie-'+$nbr+'.pdf');

        $exec=$fiche->insert($heure, $tauxS, $salaire);  
                        
        if(!$exec){         
                $form['valide'] = false;           
                $form['message'] = 'Echec de la generation';        
        }else{ 
                $form['valide'] = true;           
                $form['message'] = 'Generation réussie';         
            }
    }
    else{
        $form['message'] = 'Une donée de la fiche est non précisé';
    }
    echo $twig->render('generatefiche.html.twig', array('form'=>$form,'liste'=>$liste));
}

function ajoutfichierControleur($twig, $db){
    $form = array();  
    $utilisateur = new Utilisateur($db);  
    $fichier = new Fichier($db);
    $liste = $fichier->select();  
    if(isset($_GET['id'])){      
        $unUtilisateur = $utilisateur->selectById($_GET['id']);  
        if ($unUtilisateur!=null){      
            $form['utilisateur'] = $unUtilisateur;   
        }else{      
            $form['message'] = 'Utilisateur incorrect';      
        }   
    }      
        if(isset($_POST['btajouter'])){    
            $libelle = $_POST['libelle'];
            $upload = new Upload(array('pdf'), 'fichier', 50000000);     
            $fichier = $upload->enregistrer('fichier');   
            $exec=$fichier->insert($libelle['fichier']);      
            if (!$exec){        
                $form['valide'] = false;          
                $form['message'] = 'Problème d\'insertion dans la table fichier ';       
            }else{        
                $form['valide'] = true;  
                $form['libelle']=$libelle;      
            }  
        }       
    echo $twig->render('ajoutfichier.html.twig', array('form'=>$form, 'liste'=>$liste));
}

function ficheControleur($twig, $db){
    $form = array();  
    $fichier = new fichier($db); 
    if(isset($_POST['btCreation'])){  
    
        header('Location: index.php?page=ajoutfichier');      
        exit;    
    }

    if(isset($_POST['btSupprimer'])){      
        $cocher = $_POST['cocher'];      
        $form['valide'] = true;      
        $etat = true;      
        foreach ( $cocher as $id){        
            $exec=$fichier->delete($id);         
            if (!$exec){           
                $etat = false;          
            }      
        }      
        header('Location: index.php?page=fichier&etat='.$etat);      
        exit;    
    }
    if(isset($_GET['id'])){      
        $exec=$fichier->selectById($_GET['id']);      
        if (!$exec){        
            $etat = false;      
        }else{        
            $etat = true;      
        }
        header('Location: index.php?page=fichier&etat='.$etat);      
        exit;    
    } 
    

    if(isset($_GET['etat'])){       
            $form['etat'] = $_GET['etat'];     
    }

    $liste = $fichier->select(); 
    echo $twig->render('fichier.html.twig', array('form'=>$form,'liste'=>$liste));

}


?>