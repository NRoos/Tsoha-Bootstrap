<?php
    class Category extends BaseModel {
        public $id, $name, $usr_id, $added; 

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array();
        }

        public function save() {
            $query = DB::connection()->prepare('INSERT INTO Category (name) VALUES (:name) RETURNING id');

            $query->execute(array('name' => $this->name));

            $row = $query->fetch();

            $this->id = $row['id'];
        }
    }
