<?php
class Type{
        private $db;
        private $select;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $this->db->prepare("insert into type(nom)values (:nom)");
            $this->connect  =  $this->db->prepare("select   nom   from   utilisateur   where   nom=:nom");
        }

        public function insert($nom){
            $r = true;
            $this->insert->execute(array(':nom'=>$nom));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }

        public function select(){
            $this->select = $this->db->prepare("select t.id as id, t.nom as nom from type t order by nom");
            $this->select->execute();
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());
            }
            return $this->select->fetchAll();
        }

    }

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

    class Commentaire{
        private $db;
        private $select;
        private $selectById;
        private $update;
        private $insert;

        public function __construct($db){
            $this->db = $db;
            $this->select = $this->db->prepare("select u.id, c.id, u.nomUtil, p.nomProd, c.message from commentaire c, utilisateur u, produit p where c.idUtilisateur = u.id AND c.idProduit = p.id order by u.nomUtil");   
            $this->selectById = $this->db->prepare("select c.id, u.nomUtil, p.nomProd, c.message from utilisateur u, commentaire c, produit p where c.idUtilisateur = u.id AND c.idProduit = p.id AND c.id=:id");
            $this->update  =  $db->prepare("update  commentaire  set  message=:message where id=:id");
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

        public function insert($message){
            $r = true;
            $this->insert->execute(array(':message'=>$message));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }

        public function update($id, $message){
            $r = true;
            $this->update->execute(array(':id'=>$id, ':message'=>$message));
            if ($this->update->errorCode()!=0){
                print_r($this->update->errorInfo());
                $r=false;
            }
            return $r;
        }
    }

    class Produit{
        private $db;
        private $select;
        private $selectById;
        private $update;
        private $insert;

        public function __construct($db){
            $this->db = $db;
            $this->select = $this->db->prepare("select u.id, c.id, u.nomUtil, p.nomProd, c.message from commentaire c, utilisateur u, produit p where c.idUtilisateur = u.id AND c.idProduit = p.id order by u.nomUtil");   
            $this->selectById = $this->db->prepare("select c.id, u.nomUtil, p.nomProd, c.message from utilisateur u, commentaire c, produit p where c.idUtilisateur = u.id AND c.idProduit = p.id AND c.id=:id");
            $this->update  =  $db->prepare("update  produit  set  photo=:photo where id=:id");
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

        public function insert($photo){
            $r = true;
            $this->insert->execute(array(':photo'=>$photo));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }

        public function update($id, $photo){
            $r = true;
            $this->update->execute(array(':id'=>$id, ':photo'=>$photo));
            if ($this->update->errorCode()!=0){
                print_r($this->update->errorInfo());
                $r=false;
            }
            return $r;
        }
    }

    
?>