<?php
    class CategoriesController extends BaseController {

        public static function index() {
            $categories = Category::all();
            View::make('/main.html', array('categories' => $categories));
        }

        public static function show($id) {
            $category = Category::find($id);
            View::make('/category/show.html', array('category' => $category));
        }

        public static function create() {
            View::make('/category/new.html');
        }

        public static function destroy($id) {

            $usr = self::get_user_logged_in(); 
            if($usr->admin === TRUE) {
                $category = new Category(array(
                    'id' => $params['id']
                ));
                $category->destroy();
                Redirect::to('/categories', array('success' => 'category deleted'));
            } else {
                Redirect::to('/categories', array('You need to be an admin to do that'));
            }
        }

        public static function store() {

            $params = $_POST;
            $currUser = self::get_user_logged_in();
            
            $category = new Category(array(
                'name' => $params['name'],
                'usr_id' => $currUser->id,
                'added' => date("Y-m-d H:i:s") 
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
