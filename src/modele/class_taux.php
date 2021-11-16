<?php
    class Taux{
    private $db;  
    private $insert; 
    private $select; 
    private $selectById;  
    private $update;
    private $delete;

    public function __construct($db){ 
        $this->db = $db; 
        $this->insert = $this->db->prepare("insert into taux(libelle, nbr)values (:designation, :nbr)");  
        $this->select = $db->prepare("select id, libelle, nbr from taux t order by libelle");
        $this->default = $db->prepare("select id, nbr from taux t order by nbr");
        $this->selectById  =  $db->prepare("select  id, libelle, nbr from  taux");
        $this->update  =  $db->prepare("update  taux  set libelle=:libelle, nbr=:nbr");
        $this->delete = $db->prepare("delete from taux");
    }

    public function insert($design, $nbr){        
        $r = true;        
        $this->insert->execute(array(':designation'=>$design, ':nbr'=>$nbr));        
        if ($this->insert->errorCode()!=0){             
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r;    
    }
    public function default(){
    $this->selectById->execute(array());        
        if ($this->selectById->errorCode()!=0){             
            print_r($this->selectById->errorInfo());          
        }        
        return $this->selectById->fetch(); 
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
    public function update($id, $libelle, $nbr){        
        $r = true;        
        $this->update->execute(array(':id'=>$id, ':libelle'=>$libelle, ':nbr'=>$nbr));        
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