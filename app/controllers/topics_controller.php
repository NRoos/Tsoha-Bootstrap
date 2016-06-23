<?php
class TopicsController extends BaseController {
    
    public static function show($id) {
        $topic = Topic::find($id); 
        View::make('/topics/:id/show', array('topic' => $topic));
    }
}
