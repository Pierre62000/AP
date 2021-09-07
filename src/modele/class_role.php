<?php
    class Role{
        private $db;
        private $select;
        private $selectById;
        
        public function __construct($db){
            $this->db = $db;
            $this->connect  =  $this->db->prepare("select email, idRole, mdp from utilisateur where email=:email");
        }

        public function connect($email){
            $this->connect->execute(array(':email'=>$email));
            if ($this->connect->errorCode()!=0){
                print_r($this->connect->errorInfo());
            }
            return $this->connect->fetch();
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