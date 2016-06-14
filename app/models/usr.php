<?php
    class Usr extends BaseModel {
        public $id, $name, $password, $admin;

        public function __construct($attributes){
            parent::__construct($attributes);
            $this->validators = array('validateName', 'validatePassword');
        }
         
        public static function authenticate($name, $password) {
            $query = DB::connection()->prepare('SELECT * FROM Usr WHERE name = :name AND password = :password LIMIT 1');
            $query->execute(array('name' => $name, 'password' => $password));
            $row = $query->fetch();
            if($row) {
                $usr = New Usr(
                    array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'password' => $row['password'],
                        'admin' => $row['admin']
                    ));
                return $usr;
            } else {
                return NULL;
            }
        }

        public function save() {
            $query = DB::connection()->prepare('INSERT INTO Usr (name, password) VALUES (:name, :password) RETURNING id');

            $query->execute(array('name' => $this->name, 'password' => $this->password));

            $row = $query->fetch();

            $this->id = $row['id'];
        }

        public function destroy() {
            $query = DB::connection()->prepare('DELETE FROM Usr WHERE id = ' . $this->id);
            $query->execute();
        }

        public function update() {
            $query = DB::connection()->prepare('UPDATE Usr SET password = \'' . $this->password . '\' WHERE id = ' . $this->id);

            $query->execute();
        }

        public function validateName() {
            $errors = array();
            if($this->validateStringLength($this->name, 3) === TRUE) {
                array_push($errors, "Name must be atleast 3 characters");   
            }
            if($this->validateAlphanumeric($this->name, 3) === TRUE) {
                array_push($errors, "Name must contain only A-Ö and 0-9");
            }

            if($this->validateUnique($this->name) === TRUE) {
                array_push($errors, "Name is already in use");
            }
            return $errors; 
        }

        public function validatePassword() {
            $errors = array();
            if($this->validateStringLength($this->password, 5) === TRUE) {
                array_push($errors, "Password must be atleast 5 characters");
            }
            if($this->validateNotEmpty($this->password) === TRUE) {
                array_push($errors, "Password must not be empty");
            }
            if($this->validateAlphanumeric($this->password) === TRUE) {
                array_push($errors, "Password must only contain A-Ö and numbers");
            }

            return $errors;
        }

        public function validateUnique() {
            $errors = array();
            if($this->findName($this->name) > -1) {
                return TRUE;
            }
            return FALSE;
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
            return NULL;
        }
    } 

