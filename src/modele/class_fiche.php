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
        $this->insert = $this->db->prepare("insert into fichedePaie(nom, nbrHeure, salaire, tauxSalaire)values (:nom, :nbrH, :salaire, :tauxS)");  
        $this->select = $db->prepare("select f.id, nbrHeure, salaire, tauxSalaire  from fichedePaie f order by f.id");
        $this->selectById  =  $db->prepare("select  id, nbrHeure, salaire, tauxSalaire from  fichedePaie");
        $this->update  =  $db->prepare("update  fichedePaie  set nbrHeure=:nbrH,  salaire=:salaire, tauxSalaire=:tauxSalaire");
        $this->delete = $db->prepare("delete from fichedePaie");
    }

    public function insert($nbrH, $salaire, $tauxSalaire){        
        $r = true;        
        $this->insert->execute(array(':nbrH'=>$nbrH, ':salaire'=>$salaire, ':tauxSalaire'=>$tauxSalaire));        
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
    public function update($id, $nbrH, $salaire, $tauxSalaire){        
        $r = true;        
        $this->update->execute(array(':id'=>$id,':nbrH'=>$nbrH, ':salaire'=>$salaire, ':tauxSalaire'=>$tauxSalaire));        
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