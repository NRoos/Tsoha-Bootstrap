<?php
    class UsrsController extends BaseController {
        public static function index() {
            $usrs = Usr::all();
            View::make('/usr/index.html', array('usrs' => $usrs));
        }

        public static function register() {
            View::make('usr/new.html');
        } 

        public static function show($id) {
            $usr = Usr::find($id);
            View::make('usr/show.html', array('usr' => $usr));
        }

        public function edit($id) {
            $usr = Usr::find($id);
            View::make('usr/edit.html', array('usr' => $usr));
        }

        public static function destroy($id) {
           $usr = new Usr(array('id' => $id)); 
           $usr->destroy();

           Redirect::to('/users');
        }

        public static function update($id) {
            $params = $_POST;

            $attributes = array(
                'id' => $id,
                'name' => $params['name'],
                'password' => $params['password'],
            );

            $usr = new Usr($attributes);
            $errors = $usr->errors();

            if(count($errors) > 0) {
                View::make('usr/edit.html', array('errors' => $errors, 'usr' => $attributes));
            } else {
                $usr->update();
            }
            Redirect::to('/usr/' . $id, array('message' => 'Updated'));
        }

        public static function store() {

            $params = $_POST;

            $usr = new Usr(array(
                'name' => $params['name'],
                'password' => $params['password']
            ));
            $errors = array();
            $errors = $usr->errors(); 
            
            if(count($errors) > 0) {
                foreach($errors as $error) {
                    echo $error;
                }
            } else {
                $usr->save();
                Redirect::to('/users/' . $usr->id, array('message' => 'Account creation succesfull'));
            }
        }       
    }
