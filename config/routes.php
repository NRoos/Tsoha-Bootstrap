<?php

  $routes->get('/', function() {
    CategoriesController::index(); 
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });


  $routes->get('/thread/1', function() {
    HelloWorldController::thread();
  });

  $routes->get('/login', function() {
      UsrsController::login();
  });

  $routes->post('/login', function() {
      UsrsController::handle_login();
  });

  $routes->post('/logout', function() {
      UsrsController::logout();
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

  $routes->get('/users/:id/edit', function($id) {
      UsrsController::edit($id);
  });

  $routes->post('/users/:id/edit', function($id) {
      UsrsController::update($id);
  });

  $routes->post('/users/:id/destroy', function($id) {
      UsrsController::destroy($id);
  });

  $routes->get('/categories', function() {
      CategoriesController::index();
  });

  $routes->get('/categories/new', function() {
      CategoriesController::create();
  });

  $routes->post('/category', function() {
      CategoriesController::store();
  });
