
<?php 
require_once './app/models/ProductModel.php';

class Products extends Controller {
    function index(){

        $productlist = $this->model("ProductModel")->getProductList();

        $this->view("LayoutUser", [
            "user" => "Products",
            "productList" => $productlist
        ]);
    }
}