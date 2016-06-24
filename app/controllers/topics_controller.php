<?php
class TopicsController extends BaseController {
    
    public static function show($id) {
        $topic = Topic::find($id); 
        View::make('/topic/show.html', array('topic' => $topic));
    }
}
