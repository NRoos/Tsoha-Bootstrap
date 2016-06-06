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

        public static function store() {

            $params = $_POST;

            $usr = new Usr(array(
                'name' => $params['name'],
                'password' => $params['password']
            ));


            $usr->save();

            Redirect::to('/users/' . $usr->id, array('message' => 'Account creation succesfull'));

        }       
    }
