<?php

  $routes->get('/', function() {
    CategoriesController::index(); 
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

        // LOGIN / LOGOUT
  $routes->get('/login', function() {
      UsrsController::login();
  });

  $routes->post('/login', function() {
      UsrsController::handle_login();
  });

  $routes->post('/logout', function() {
      UsrsController::logout();
  });
        // USERS START HERE
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

    // CATEGORIES START HERE

  $routes->get('/categories', function() {
      CategoriesController::index();
  });

  $routes->get('/categories/new', function() {
      CategoriesController::create();
  });

  $routes->get('/categories/:id', function($id) {
      CategoriesController::show($id);
  });

  $routes->post('/categories/:id/destroy', function($id) {
      CategoriesController::destroy($id);
  });

  $routes->post('/category', function() {
      CategoriesController::store();
  });

  $routes->get('/categories/:id/edit', function($id) {
      CategoriesController::edit($id);
  });

  $routes->post('/categories/:id/edit', function($id) {
      CategoriesController::update($id);
  });
