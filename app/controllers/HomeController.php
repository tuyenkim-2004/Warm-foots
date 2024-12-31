<?php

    class HomeController extends Controller{
        public function index()
        {
            $productlist = $this->model("ProductModel")->getProductList();
            $this->view("LayoutUser", [
                "user" => "Home",
                "productList" => $productlist
            ]);
            
        }
        // $productlist = $this->model("ProductModel")->getProductList();

        // $this->view("LayoutUser", [
        //     "user" => "Products",
        //     "productList" => $productlist
        // ]);
    }
?>