<?php
    class Role{
        private $db;
        private $select;
        private $selectById;
        
        public function __construct($db){
            $this->db = $db;
            $this->connect  =  $this->db->prepare("select r.id, r.libelle, from Role r");
        }

        public function select(){
            $this->select = $this->db->prepare("select id, libelle from role");
            $this->select->execute();
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());
            }
            return $this->select->fetchAll();
        }

    }

?>