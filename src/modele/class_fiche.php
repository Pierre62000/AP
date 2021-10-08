<?php
    class Fiche{
    private $db;  
    private $insert; 
    private $select; 
    private $selectById;  
    private $update;
    private $delete;

    public function __construct($db){ 
        $this->db = $db; 
        $this->insert = $this->db->prepare("insert into fiche(libelle, idUtilisateur)values (:designation, :utilisateur)");  
        $this->select = $db->prepare("select f.id, libelle, idUtilisateur from fiche f, Utilisateur u where f.idUtilisateur = u.id order by f.id");
        $this->selectById  =  $db->prepare("select  id, libelle, idUtilisateur from  fiche");
        $this->update  =  $db->prepare("update  fiche  set  libelle=:libelle, idUtilisateur=:utilisateur");
        $this->delete = $db->prepare("delete from fiche");
    }

    public function insert($design, $util){        
        $r = true;        
        $this->insert->execute(array(':libelle'=>$design, ':utilisateur'=>$util));        
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
    public function update($id, $util, $libelle){        
        $r = true;        
        $this->update->execute(array(':id'=>$id, ':utilisateur'=>$util, ':libelle'=>$libelle));        
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