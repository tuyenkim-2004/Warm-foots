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
            $userId = $_SESSION['user_id'] ?? null;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $orderDate = date('Y-m-d H:i:s');
            $address = $_POST['shipping_address'];
            $paymentMethod = $_POST['payment_method'] ?? 'cash on delivery';
            $phone = $_POST['phone'];
            $status = 'Processing';
    
            if (empty($address) || empty($phone)) {
                echo 'Address or phone is empty.';
                return;
            }
    
            $cartItems = [];
            if (!empty($_SESSION['buy_now'])) {
                $buyNowData = $_SESSION['buy_now'];
                $cartItems = [[
                    'product_id' => $buyNowData['product_id'],
                    'quantity' => $buyNowData['quantity'],
                    'price' => $buyNowData['price']
                ]];
            } else {
                $cartItems = $this->model("OrderModel")->getCartItems($userId);
            }
    
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
    
                    unset($_SESSION['buy_now']);
                    if (empty($_SESSION['buy_now'])) {
                        $this->model("OrderModel")->clearCart($userId);
                    }

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
    
    public function buyNow() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0; 
            $quantity = $_POST['quantity'] ?? 1;  
            $price = $_POST['price'] ?? 0;        
            $imageName = $_POST['img_url'] ?? 'public/imgs/default-image.webp';
            $productName = $_POST['product_name'] ?? 'Unnamed Product'; 
            if (empty($productId) || empty($price)) {
                echo "Invalid product data.";
                return;
            }
    
            $_SESSION['buy_now'] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
                'img_url' =>   $imageName,
                'product_name' => $productName
            ];
    
            // Tính toán tổng tiền
            $totalAmount = $price * $quantity;
            $this->view("LayoutUser", [
                "user" => "Order",
                "orderDetails" => [[
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'img_url' =>    $imageName,
                    'product_name' => $productName
                ]],
                "totalAmount" => $totalAmount
            ]);
        } else {
            echo "Invalid request method.";
        }
    }

    public function checkoutView() {
        $buyNowData = $_SESSION['buy_now'] ?? null;
    
        if ($buyNowData) {
            $productId = $buyNowData['product_id'];
            $quantity = $buyNowData['quantity'];
            $price = $buyNowData['price'];
            $imageName = $buyNowData['img_url'];
            
            $this->view("checkoutView", [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price
            ]);
        } else {
            echo "No product selected.";
        }
    }

}
?>
