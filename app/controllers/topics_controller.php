<?php
class TopicsController extends BaseController {
    
    public static function show($id) {
        $topic = Topic::find($id); 
        $replies = Reply::inTopic($id);
        $seen = UsrSeenTopic::find(self::get_user_logged_in(), $topic);
        if(!$seen) {
            UsrSeenTopic::save(self::get_user_logged_in()->id, $topic->id); 
        }
        if($topic) {
            View::make('/topic/show.html', array('topic' => $topic, 'replies'=>$replies));
        }
    }

    public static function create($cat) {
        self::check_logged_in();
        $category = Category::find($cat);
        $usr = self::get_user_logged_in(); 
        View::make('/topic/new.html', array('category' =>$category,'usr'=> $usr));
    }

    public static function store() {
        $params = $_POST;
        
        $topic = new Topic(array(
            'name' => $params['name'],
            'usr_id' => $params['usr_id'],
            'category_id' => $params['category_id'],
            'content' => $params['content'],
            'added' => date("Y-m-d H:i:s")
        )); 

        $errors = array();
        $errors = $topic->errors();

        if(count($errors) > 0) {
            Redirect::to('/topics/create/' . $params['category_id'], array('error' => $errors[0]));
        } else {
            $topic->save();
            Redirect::to('/categories/' . $topic->category_id, array('success' => 'Topic created succesfully'));
        }
    }
}
