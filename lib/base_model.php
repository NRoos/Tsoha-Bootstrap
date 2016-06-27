<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function validateStringLength($string, $length) {
        if(strlen($string) < $length) {
            return TRUE;
        }
        return FALSE;
    }

    public function validateNotEmpty($string) {
        if($string == '' || $string == NULL){
            return TRUE;
        }
        return FALSE;
    }

    public function validateAlphanumeric($string) {
        if(!preg_match('/^[A-Za-z0-9]*$/', $string)) {
            return TRUE;
        }
        return FALSE;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
          $valArr = array();
          $valArr = $this->{$validator}();
          $errors = array_merge($errors, $valArr);
      }

      return $errors;
    }


  }
