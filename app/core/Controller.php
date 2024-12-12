<?php

    class Controller{

        public function model($model){
            require_once './app/models/'.$model.'.php';
            return new $model;
        }

        public function view($view, $data = [])
        {
            
            $layout = (isset($_SESSION['role']) && $_SESSION['role'] == 1) ? 'layouts/LayoutAdmin' : 'layouts/LayoutUser';

            require_once './app/views/' . $layout . '.php';
            require_once './app/views/' . $view . '.php';
        }
        
    }