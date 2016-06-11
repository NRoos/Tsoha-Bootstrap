<?php
    class Usr extends BaseModel {
        public $id, $name, $password, $admin;

        public function __construct($attributes){
            parent::__construct($attributes);
            $this->validators = array('validateNameLength', 'validateNotEmpty', 'validateUnique');
        }

        public function save() {
            $query = DB::connection()->prepare('INSERT INTO Usr (name, password) VALUES (:name, :password) RETURNING id');

            $query->execute(array('name' => $this->name, 'password' => $this->password));

            $row = $query->fetch();

            $this->id = $row['id'];
        }

        public function validateNameLength() {
            $errors = array();
            if($this->validateStringLength($this->name, 3) === TRUE) {
               array_push($errors, "Name must be atleast 3 characters");   
            }
            return $errors; 
        }

        public function validateUnique() {
            $errors = array();
            if($this->findName($this->name) > -1) {
                array_push($errors, "Name is taken");
            }
            return $errors;
        }

        public static function all() {
            $query = DB::connection()->prepare('SELECT * FROM Usr');

            $query->execute();

            $rows = $query->fetchAll();
            $usrs = array();

            foreach($rows as $row) { 
                $usrs[] = new Usr(array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'password' => $row['password'],
                    'admin' => $row['admin']
                ));                
            }

            return $usrs;
        }

        public static function find($id){
            $query = DB::connection()->prepare('SELECT * FROM Usr WHERE id = :id');
            $query->execute(array('id' => $id));
            $row = $query->fetch();

            if($row){
                $usr = new Usr(array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'password' => $row['password'],
                    'admin' => $row['admin']
                ));
                return $usr;
            }
            return null;
        }

        public static function findName($name) {
            $query = DB::connection()->prepare('SELECT * FROM Usr WHERE name = :name');
            $query->execute(array('name' => $name));
            $row = $query->fetch();

            if($row) {
                return $row['id'];
            }
            return -1;
        }
    } 

