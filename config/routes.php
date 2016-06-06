<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/categories', function() {
    HelloWorldController::categories();
  });

  $routes->get('/thread/1', function() {
    HelloWorldController::thread();
  });

  $routes->get('/login', function() {
      HelloWorldController::login();
  });

  $routes->get('/users', function() {
      UsrsController::index();
  });

  $routes->get('/users/new', function() {
      UsrsController::register();
  });
  $routes->get('/users/:id', function($id) {
      UsrsController::show($id);
  });

  $routes->post('/usr', function() {
      UsrsController::store();
  });

