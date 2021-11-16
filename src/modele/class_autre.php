<?php
    class Contact{
        private $db;

        public function __construct($db){
            $this->db = $db;
            $this->insertC = $this->db->prepare("insert into contact(nomC, emailC, messageC)values (:nomC, :emailC, :messageC)");
            $this->connect  =  $this->db->prepare("select   nomC,   emailC,   messageC   from   contact   where   email=:email");
        }

        public function insertC($emailC, $nomC, $messageC){
            $rC = true;
            $this->insertC->execute(array(':emailC'=>$emailC, ':nomC'=>$nomC,':messageC'=>$messageC));
            if ($this->insertC->errorCode()!=0){
                print_r($this->insertC->errorInfo());
                $rC=false;
            }
            return $rC;
        }
    }
?>