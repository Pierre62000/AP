<?php
    class Utilisateur{
        private $db;
        private $insert;
        private $insertC;
        private $connect;
        private $select;
        private $selectById;
        private $delete;
        private $update;
        
        public function __construct($db){
            $this->db = $db;
            $this->insert = $this->db->prepare("insert into utilisateur(email, mdp, nomUtil, prenom, idRole)values (:email, :mdp, :nomUtil, :prenom, :role)");
            $this->delete = $db->prepare("delete from utilisateur where id=:id");
            $this->connect  =  $this->db->prepare("select   email,   idRole,   mdp   from   utilisateur   where   email=:email");
            $this->update  =  $db->prepare("update  utilisateur  set  nomUtil=:nomUtil,  prenom=:prenom,  idRole=:role where id=:id");
        }
        
        public function insert($email, $mdp, $role, $nom, $prenom){
            $r = true;
            $this->insert->execute(array(':email'=>$email, ':mdp'=>$mdp, ':role'=>$role, ':nom'=>$nom,':prenom'=>$prenom));
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }

        public function connect($email){
            $this->connect->execute(array(':email'=>$email));
            if ($this->connect->errorCode()!=0){
                print_r($this->connect->errorInfo());
            }
            return $this->connect->fetch();
        }

        public function select(){
            $this->select = $this->db->prepare("select u.id, email, idRole, nomUtil, prenom, r.libelle as libellerole from utilisateur u, role r where u.idRole = r.id order by nomUtil");
            $this->select->execute();
            if ($this->select->errorCode()!=0){
                print_r($this->select->errorInfo());
            }
            return $this->select->fetchAll();
        }

        public function selectById($id){
            $this->selectById = $this->db->prepare("select u.id,  email,  nomUtil,  prenom,  idRole  from  utilisateur u, role r where u.idRole=r.id AND u.id=:id");
            $this->selectById->execute(array(':id'=>$id));
            if ($this->selectById->errorCode()!=0){
                print_r($this->selectById->errorInfo());
            }
            return $this->selectById->fetch();
        }

        public function delete($id){
            $r = true;
            $this->delete->execute(array(':id'=>$id));
            if ($this->delete->errorCode()!=0){
                print_r($this->delete->errorInfo());
                $r=false;
            }
            return $r;
        }

        public function update($id, $role, $nom, $prenom){
            $r = true;
            $this->update->execute(array(':id'=>$id, ':role'=>$role, ':nomUtil'=>$nom, ':prenom'=>$prenom));
            if ($this->update->errorCode()!=0){
                print_r($this->update->errorInfo());
                $r=false;
            }
            return $r;
        }
    }

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