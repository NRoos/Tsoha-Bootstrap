<?php
    class Reply extends BaseModel {
        public $id, $usr_id, $added, $topic_id, $content;

        public function __construct($attributes) {
            parent::__construct($attributes); 
            $this->validators = array();
        }
        
        public function inTopic($topId) {
            $query = DB::connection()->prepare('SELECT * FROM reply WHERE topic_id = :topId');
            $query->execute(array('topId'=>$topId));

            $rows = $query->fetchAll();
            $replies = array();

            foreach($rows as $row) {
                $replies[] = new Reply(array(
                    'id' => $row['id'],
                    'usr_id'=>$row['usr_id'],
                    'added'=>$row['added'],
                    'topic_id'=>$row['topic_id'],
                    'content'=>$row['content']
                ));
            }
            return $replies;
        }

    }
