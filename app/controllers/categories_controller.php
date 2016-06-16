<?php
    class CategoriesController extends BaseController {

        public static function index() {
            View::make('/main.html');
        }

        public static function show($id) {
            View::make('/category/:id/show.html');
        }

        public static function create() {
            View::make('/category/new.html');
        }

        public static function store() {

            $params = $_POST;
            $currUser = self::get_user_logged_in();
            
            $category = new Category(array(
                'name' => $params['name'],
                'user_id' => $currUser->id
            ));

            $errors = array();

            if(count($errors) > 0) {
                Redirect::to('/categories/new', array('error' => 'unsuccsefull'));
            } else {
                $category->save();
                Redirect::to('/', array('success' => 'Category created succesfully'));
            } 
        }
    }
