<?php
    class CategoriesController extends BaseController {

        public static function index() {
            $categories = Category::all();
            View::make('/main.html', array('categories' => $categories));
        }

        public static function show($id) {
            $category = Category::find($id);

            self::check_logged_in();

            View::make('/category/show.html', array('category' => $category));
        }

        public static function create() {
            View::make('/category/new.html');
        }

        public static function update($id) {
            $params = $_POST; 

            $attributes = array(
                'id' => $params['id'],
                'name' => $params['name']
                'usr_id' => $params['usr_id'],
                'added' => $params['added']
            );

            $category = new Category($attributes);

            $errors = array();
            $errors = $category->errors();

            if(count($errors) > 0) {
                Redirect::to('/categories/new', array('error' => $errors[0], 'inpname' => $category->name));
            else {
                $category->update();
                Redirect::to('/categories/' . $category->id, array('success' => 'Succesfully updated')); 
            }
            }
        }

        public static function destroy($id) {
            $usr = self::get_user_logged_in(); 
            if($usr->admin === TRUE) {
                $category = new Category(array(
                    'id' => $id
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
            $errors = $category->errors();

            if(count($errors) > 0) {
                Redirect::to('/categories/new', array('error' => $errors[0]));
            } else {
                $category->save();
                Redirect::to('/', array('success' => 'Category created succesfully'));
            } 
        }
    }
