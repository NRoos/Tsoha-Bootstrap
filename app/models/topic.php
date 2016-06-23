<?php
    Class Topic extends BaseModel {
        public $id, $name, $content, $category_id, $usr_id, $added;

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array();
        }

        public static function find($id) {
            $query = DB::connection()->prepare('SELECT * FROM Topic WHERE id = :id');
            $query->execute(array('id' => $id));

            $row = $query->fetch();

            if($row) {
                $topic = new Topic(array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'content' => $row['content'],
                    'usr_id' => $row['usr_id'],
                    'category_id' => $row['category_id'],
                    'added' => $row['added']
                ));
                return $topic;
            }
            return NULL;
        }

        public static function inCategory($catId) {
            $query = DB::connection()->prepare('SELECT * FROM Topic WHERE category_id = :id');
            $query->execute(array('id' => $catId));

            $rows = $query->fetchAll();

            if($rows) {
                $topics = new Topic(array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'content' => $row['content'],
                    'usr_id' => $row['usr_id'],
                    'category_id' => $row['category_id'],
                    'added' => $row['added']
                ));
                return $topics;
            }
            return NULL;
        }
    }
