<?php

    class HomeController extends Controller{
        public function index()
        {
            $this->view('LayoutUser', [
                "user" => "Home"
            ]);
            
        }
        
    }
?>