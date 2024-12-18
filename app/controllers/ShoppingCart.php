<?php

    class ShoppingCart extends Controller{
        public function index()
        {
            $this->view('LayoutUser', [
                "user" => "ShoppingCart"
            ]);
        }
    }
?>