<?php
    class Reply extends BaseModel {
        public $id, $usr_id, $added, $topic_id, $content;

        public function __construct($attributes) {
            parent::__construct($attributes); 
            $this->validators = array();
        }

        public static function find($id) {
            $query = DB::connection()->prepare('SELECT * FROM reply WHERE id = :id');
            $query->execute(array('id'=>$id));

            $row = $query->fetch();

            if($row) {
                $topic = new Topic(array(
                    'id' => $row['id'],
                    'usr_id'=>$row['usr_id'],
                    'added'=>$row['added'],
                    'topic_id'=>$row['topic_id'],
                    'content'=>$row['content']
                ));
                return $topic;
            }
            return NULL;
        } 
        
        public static function inTopic($topId) {
            $query = DB::connection()->prepare('SELECT * FROM reply WHERE topic_id = :topId');
            $query->execute(array('topId'=>$topId));

            $rows = $query->fetchAll();
            $replies = array();

            foreach($rows as $row) {
                array_push($replies, new Reply(array(
                    'id' => $row['id'],
                    'usr_id'=>$row['usr_id'],
                    'added'=>$row['added'],
                    'topic_id'=>$row['topic_id'],
                    'content'=>$row['content']
                )));
            }
            return $replies;
        }
    }
