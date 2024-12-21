
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
    function detail() {
        $productID = $_GET['id'] ?? 0; 
        $product = $this->model("ProductModel")->getProductDetails($productID);
        
        if (!$product) {
            die("Product not found");
        }
        $this->view("LayoutUser", [
            "user" => "ProductDetail",
            "product" => $product
        ]);
    }

    public function FilterByCategory() {
        $category = $_GET['category_id'] ?? '';
        $productModel = $this->model("ProductModel");
        $products = $productModel->filterByCategory($category);
        
        $this->view("LayoutUser", [
            "user" => "FilterProducts",
            "products" => $products,
            "category_id" => $category
        ]);
    }

}