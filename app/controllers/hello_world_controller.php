<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
          echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        View::make('main.html');
    }
    
    public static function login() {
        View::make('login.html');
    }

    public static function categories() {
        View::make('category.html'); 
    }
    
    public static function thread() {
        View::make('thread_show.htnml');
    }
  }
