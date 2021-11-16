<?php
    class Fichier{
    private $db;  
    private $insert; 
    private $select; 
    private $selectById;  
    private $update;
    private $delete;

    public function __construct($db){ 
        $this->db = $db; 
        $this->insert = $this->db->prepare("insert into fichier(nom, libelle, idUtilisateur)values (:nom, :designation, :utilisateur)");  
        $this->select = $db->prepare("select f.id, f.nom, libelle, idUtilisateur from fichier f, Utilisateur u where f.idUtilisateur = u.id order by f.id");
        $this->selectById  =  $db->prepare("select  id, nom, libelle, idUtilisateur from  fichier");
        $this->update  =  $db->prepare("update  fichier  set nom=:nom,  libelle=:libelle, idUtilisateur=:utilisateur");
        $this->delete = $db->prepare("delete from fichier");
    }

    public function insert($nom, $design, $util){        
        $r = true;        
        $this->insert->execute(array(':nom'=>$nom, ':designation'=>$design, ':utilisateur'=>$util));        
        if ($this->insert->errorCode()!=0){             
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r;    
    }
    public function select(){  
        $this->select->execute();       
        if ($this->select->errorCode()!=0){             
            print_r($this->select->errorInfo());          
        }        
        return $this->select->fetchAll();    
    }
    public function selectById($id){          
        $this->selectById->execute(array(':id'=>$id));        
        if ($this->selectById->errorCode()!=0){             
            print_r($this->selectById->errorInfo());          
        }        
        return $this->selectById->fetch(); 
    }
    public function update($id, $util, $libelle, $nom){        
        $r = true;        
        $this->update->execute(array(':id'=>$id, ':utilisateur'=>$util, ':libelle'=>$libelle, ':nom'=>$nom));        
        if ($this->update->errorCode()!=0){             
            print_r($this->update->errorInfo());               
            $r=false;       
        }        
    return $r;
    }
    public function delete($id){   
        $r = true;
        $this->delete->execute(array(':id'=>$id));        
        if ($this->delete->errorCode()!=0){             
            print_r($this->delete->errorInfo());               
            $r=false;        
        }return $r;    
    }
}?>