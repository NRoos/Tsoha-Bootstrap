<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //
        View::make('main.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä

        $nico = Usr::find(1);
        $users = Usr::all();

        Kint::dump($users);
        Kint::dump($nico);
        
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function categories() {
        View::make('suunnitelmat/category.html'); 
    }
    
    public static function thread() {
        View::make('suunnitelmat/thread_show.html');
    }
  }
