<?php
    Class RepliesController extends BaseController {
    
        public static function create() {
            $params = $_POST;
            $reply = new Reply(array(
                'usr_id' => $params['usr_id'],
                'topic_id' => $params['topic_id'],
                'added' => date("Y-m-d H:i:s"),
                'content' => $params['content']
            ));

            $errors = array();
            $errors = $reply->errors();

            if(count($errors) > 0) {
                Redirect::to('/topics/' . $params['topic_id'], array('error' => $errors[0]));
            } else {
                $reply->save();
                Redirect::to('/topics/' . $params['topic_id'], array('success' => 'reply created succesfully'));
            }
        }
    }
