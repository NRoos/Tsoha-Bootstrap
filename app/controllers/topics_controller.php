<?php
class TopicsController extends BaseController {
    
    public static function show($id) {
        $topic = Topic::find($id); 
        $replies = Reply::inTopic($id);
        View::make('/topic/show.html', array('topic' => $topic, 'replies'=>$replies));
    }

}
