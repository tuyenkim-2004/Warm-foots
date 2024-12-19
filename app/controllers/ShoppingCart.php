<?php

class ShoppingCart extends Controller {
    private $ShoppingCartModel;

    public function __construct($ShoppingCartModel) {
        $this->ShoppingCartModel = $ShoppingCartModel;
    }

    public function index() {
        $this->view('LayoutUser', [
            "user" => "ShoppingCart",
            "cartItems" => $this->getCartItems()
        ]);
    }

    public function createOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            session_start();
            if (isset($_SESSION['user_id'])) {
                $productId = $_POST['product_id']; // Get product ID from POST request
                $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1; // Default quantity to 1

                // Add product to cart
                $result = $this->ShoppingCartModel->addProductToCart($productId, $quantity);
                
                if ($result) {
                    return "Product added to cart successfully."; // Success message
                } else {
                    return "Failed to add product to cart."; // Error message
                }
            } else {
                return "User not logged in."; // Error message for unauthenticated users
            }
        } else {
            $this->index();
        }
    }

    private function getCartItems() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            return $this->ShoppingCartModel->getCartItems($_SESSION['user_id']);
        }
        return [];
    }
}
?>