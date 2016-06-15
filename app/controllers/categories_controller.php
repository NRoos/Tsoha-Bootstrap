<?php
    class CategoriesController extends BaseController {

        public static function index() {
            View::make('/main.html');
        }

        public static function show($id) {
            View::make('/categories/:id/show');
        }
    }
