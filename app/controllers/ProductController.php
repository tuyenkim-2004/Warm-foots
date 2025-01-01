
<?php 
class ProductController extends Controller {
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

    public function filterByCategory() {
        $category = $_GET['category_id'] ?? '';
        if (empty($category)) {
            echo json_encode(['error' => 'Missing category_id']); 
            return;
        }
        $productModel = $this->model("ProductModel");
        $products = $productModel->filterByCategory($category);
        if ($products) {
            echo json_encode($products);
        } else {
            echo json_encode([]); 
        }
    }

    public function search()
    {
        if (isset($_POST['keyword'])) {

            $keyword = trim($_POST['keyword']);

            $productlist = $this->model("ProductModel")->searchProducts($keyword);

            $this->view("LayoutUser", [
                "user" => "Products",
                "productList" => $productlist
            ]);
            
        } else {
            $this->view("LayoutUser", [
                "user" => "Products",
                "productList" => []
            ]);
        }
    }

}