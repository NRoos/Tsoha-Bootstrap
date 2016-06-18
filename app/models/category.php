<?php
    class Category extends BaseModel {
        public $id, $name, $usr_id, $added; 

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array('validateName');
        }

        public function find($id) {
            $query = DB::connection()->prepare('SELECT * FROM Category WHERE id = :id');

            $query->execute(array('id' => $id));

            $row = $query->fetch();


            if($row) {
                $category = New Category(array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'usr_id' => $row['usr_id'],
                    'added' => $row['added']
                )); 
                return $category;
            }
            return null;
        } 

        public function all() {
            $query = DB::connection()->prepare('SELECT * FROM Category');
            $query->execute();
            
            $rows = $query->fetchAll();
            $categories = array();

            foreach($rows as $row){
                $categories[] = new Category(array(
                   'id' => $row['id'],
                   'name' => $row['name'],
                   'added' => $row['added'],
                   'usr_id' => $row['usr_id']
               ));
            }
            return $categories;
        }

        public function validateName() {
            $errors = array();

            if($this->validateNotEmpty($this->name) === TRUE) {
                array_push($errors, 'Name can\'t be empty');
            }
            if($this->validateStringLength($this->name, 5) === TRUE) {
                array_push($errors, 'name must be atleast 5 characters');
            }

            return $errors;

        }

        public function update() {
            $query = DB::connection()->prepare('UPDATE Category SET NAME = \'' . $this->name . '\' where id = ' . $this->id);  

            $query->execute();

        }

        public function save() {
            $query = DB::connection()->prepare('INSERT INTO Category (name, usr_id, added) VALUES (:name, :usr_id, :added) RETURNING id');

            $query->execute(array('name' => $this->name, 'usr_id' => $this->usr_id, 'added' => $this->added));

            $row = $query->fetch();

            $this->id = $row['id'];
        }

        public function destroy() {
            $query = DB::connection()->prepare('DELETE FROM Category WHERE id = :id');

            $query->execute(array('id' => $this->id));
        }
    }
