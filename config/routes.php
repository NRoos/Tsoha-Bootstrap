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
