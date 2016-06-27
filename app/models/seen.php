<?php
Class UsrSeenTopic extends BaseModel{
    public $usr_id, $topic_id;

    public function __construct($attributes) {
      foreach($attributes as $attribute => $value){
        if(property_exists($this, $attribute)){
          $this->{$attribute} = $value;
        }
      }
    }

    public function save($usr_id, $topic_id) {
        $query = DB::connection()->prepare('INSERT INTO UsrSeenTopic (usr_id, topic_id) VALUES (:usr_id, :topic_id)');
        $query->execute(array('usr_id' => $usr_id, 'topic_id' => $topic_id));
        $row = $query->fetch();

    }

    public static function find($usr, $topic) {
        $query = DB::connection()->prepare('SELECT * FROM UsrSeenTopic WHERE usr_id = :usr_id AND topic_id = :topic_id');
        $query->execute(array('usr_id' => $usr->id, 'topic_id' => $topic->id));
        $seen = $query->fetch();
        return $seen;
    }

    public static function allForUsr($usr_id) {
        $query = DB::connection()->prepare('SELECT * FROM UsrSeenTopic WHERE usr_id = :usr_id');
        $query->execute(array('usr_id' => $usr_id));

        $rows = $query->fetchAll();
        $seen = array();
        foreach($rows as $row) { 
            $temp = new UsrSeenTopic(array(
                'usr_id'=>$row[0],
                'topic_id'=>$row[1]
            ));
            array_push($seen, $temp);        
        }
        return $seen;
    }

    public function destroyByTopic($topic_id) {
        $query = DB::connection()->prepare('DELETE FROM UsrSeenTopic WHERE topic_id = :topic_id');
        $query->execute(array('topic_id' => $topic_id));
    }

    public function destroyByUsr($usr_id) {
        $query = DB::connection()->prepare('DELETE FROM UsrSeenTopic WHERE usr_id = :usr_id');
        $query->execute(array('usr_id' => $usr_id));
    }

    public static function allForTopic($topic_id) {
        $query = DB::connection()->prepare('SELECT * FROM UsrSeenTopic WHERE topic_id = :topic_id');
        $query->execute(array('topic_id' => $topic_id));
        $rows = $query->fetchAll();
        $seen = array();
        
        foreach($rows as $row) { 
            $seen[] = new UsrSeenTopic(array(
                'usr_id' => $row['usr_id'],
                'topic_id' => $row['topic_id']
            ));                
        }
        return $seen;
    }
} 
