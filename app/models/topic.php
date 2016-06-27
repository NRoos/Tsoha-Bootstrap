<?php
    class Topic extends BaseModel {
        public $id, $name, $content, $category_id, $usr_id, $added;

        public function __construct($attributes) {
            parent::__construct($attributes);
            $this->validators = array('validateName');
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

        public function validateName() {
            $errors = array(); 
            if($this->validateStringLength($this->name, 10)) {
                array_push($errors, "Name must be more than 10 characters");
            }
            return $errors;
        }

        public static function inCategory($catId) {
            $query = DB::connection()->prepare('SELECT * FROM Topic WHERE category_id = :id');
            $query->execute(array('id' => $catId));

            $rows = $query->fetchAll();
            $topics = array();

            foreach($rows as $row) {
                    $topics[] = new Topic(array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'content' => $row['content'],
                        'usr_id' => $row['usr_id'],
                        'category_id' => $row['category_id'],
                        'added' => $row['added']
                    ));
            }
            
            return $topics;
        }

        public function destroy() {
            $seen = UsrSeenTopic::allForTopic($this->id);
            $replies = Reply::InTopic($this->id);
            foreach($seen as $s) {
                $s->destroyByTopic($this->id);
            }
            Kint::dump($replies);
            foreach($replies as $reply) {
                $reply->destroy();
            }
            $query = DB::connection()->prepare('DELETE FROM topic WHERE id = :id');
            $query->execute(array('id' => $this->id));
        }

        public function save() {
           $query = DB::connection()->prepare('INSERT INTO topic (name, content, usr_id, category_id, added) VALUES (:name, :content, :usr_id, :category_id, :added) RETURNING id');
           $query->execute(array('name'=> $this->name, 'usr_id' => $this->usr_id, 'category_id' => $this->category_id, 'added' => $this->added, 'content' => $this->content));

           $row = $query->fetch(); 

           $this->id = $row['id'];
        }
    }
