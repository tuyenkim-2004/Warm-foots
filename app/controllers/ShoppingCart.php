<?php

    class ShoppingCart extends Controller{
        public function index()
        {
            $this->view('LayoutUser', [
                "user" => "ShoppingCart"
            ]);
        }
        public function createOder() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($POST['add-to-card'])) {
         
            } else {
                $this->view('LayoutUser', [
                    "user" => "ShoppingCart"
                ]);
            }
        }
    }
?>