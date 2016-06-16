<?php
    class Category extends BaseModel {
        public $id, $name, $usr_id, $added; 

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array();
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
