<?php

class OrderController extends Controller {
    
    function index() {
        $data = [];
        $userId = $_SESSION['user_id'] ?? null;
    
        if ($userId) {
            $cartItems = $this->model("OrderModel")->getCartItems($userId);
            
            if (!empty($cartItems)) {
                $totalAmount = 0;
                foreach ($cartItems as $item) {
                    $totalAmount += $item['price'] * $item['quantity'];
                }
                $data["totalAmount"] = $totalAmount;
            } else {
                $data["totalAmount"] = 0;
            }
            $this->view("LayoutUser", [
                "user" => "Order",
                "orderDetails" => $cartItems,
                "totalAmount" => $data["totalAmount"]
            ]);
        } else {
            header("Location: /login");
            exit();
        }
    }
    
    public function checkout() {
        $userId = $_SESSION['user_id'] ?? null;
        
        if ($userId) {
            $cartDetails = $this->model("OrderModel")->getCartItems($userId);
    
            $totalAmount = array_reduce($cartDetails, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);
    
            $data = [
                "orderDetails" => $cartDetails,
                "totalAmount" => $totalAmount,
            ];
            $this->view("LayoutUser", $data);
        } else {
            header("Location: /login");
            exit();
        }
    }
    
    public function placeOrder() {

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id']; 
            date_default_timezone_set('Asia/Ho_Chi_Minh'); 
            $orderDate = date('Y-m-d H:i:s');  
            $address = $_POST['shipping_address'];  
            $paymentMethod = $_POST['payment_method'] ?? 'cash on delivery';  
            $status = 'Processing';  
            $phone = $_POST['phone']; 
           
            if (empty($address) || empty($phone)) {
                echo 'Address or phone is empty.';
                return;
            }
    
            $cartItems = $this->model("OrderModel")->getCartItems($userId);
    
            if (!empty($cartItems)) {
                try {
                    $orderId = $this->model("OrderModel")->createOrder(
                        $userId,
                        $orderDate,
                        $address,
                        $paymentMethod,
                        $cartItems,
                        $phone
                    );
                    $this->model("OrderModel")->clearCart($userId);
                    echo "<script>
                        alert('Order placed successfully!');
                    </script>";
                    $productlist = $this->model("ProductModel")->getProductList();

                    $this->view("LayoutUser", [
                        "user" => "Products",
                        "productList" => $productlist
                    ]);  
                                  
                     exit();
                    
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Your cart is empty.";
            }
        }
    }


}
?>
