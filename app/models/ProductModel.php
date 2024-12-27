<?php

class ProductModel extends Database
{
    // Lấy danh sách tất cả sản phẩm
    public function getProductList()
    {
        $results = $this->query("SELECT * FROM products");
        if (!$results) {
            return []; 
        }
    
        // Lấy tất cả các hàng
        $productList = [];
        while ($row = $this->fetch($results)) {
            $productList[] = $row; 
        }
        
        return $productList;
    }

    // Lấy 3 sản phẩm đầu tiên
    public function get3Products()
    {
        $results = $this->query("SELECT * FROM products LIMIT 3");
        if (!$results) {
            return []; 
        }

        $productList = [];
        while ($row = $this->fetch($results)) {
            array_push($productList, $row);
        }
        return $productList;
    }

    // Lấy sản phẩm theo ID
    public function getProductById($id)
    {
        $stmt = $this->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    public function addProduct($name, $price, $quantity, $brand)
    {
        $qr = "INSERT INTO products (product_name, price, quantity, size, brand, img_url, category_id) VALUES ('$name', '$price', '$quantity', '[size]', '$brand', 'Sandals&Slides/MinimalistSandalswithAnkleStrap', 1)";
        $result = false;
        if (mysqli_query($this->con,
            $qr
        )) {
            $result = true;
        } else {
            echo "Error: " . mysqli_error($this->con); 
        }

        return $result;
    }

    public function deleteProduct($id)
    {
        // Bước 1: Xóa các bản ghi trong cart_details
        $deleteCartDetails = "DELETE FROM cart_details WHERE product_id = $id";
        if (!mysqli_query($this->con, $deleteCartDetails)) {
            echo "Lỗi khi xóa bản ghi trong bảng cart_details: " . mysqli_error($this->con);
            return false;
        }

        // Bước 2: Xóa sản phẩm
        $deleteProduct = "DELETE FROM products WHERE product_id = $id";
        if (!mysqli_query($this->con, $deleteProduct)) {
            echo "Lỗi khi xóa sản phẩm: " . mysqli_error($this->con);
            return false;
        }

        return true; 
    }

    public function countProduct()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM products");
        return $result ? $result->fetch_assoc()["count"] : 0; 
    }
    ///loc sản phẩm
    public function filterByCategory($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Lấy danh sách sản phẩm
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }


    public function getProductDetails($productID) {
        // Truy vấn SQL
        $sql = "SELECT p.*, c.name AS name 
                FROM products p
                JOIN categories c ON p.category_id = c.category_id
                WHERE p.product_id = ?";

    
        $stmt = $this->con->prepare($sql); 
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProduct($id, $name, $price, $quantity, $brand)
    {
        $qr = "UPDATE products SET product_name = '$name', price = '$price', quantity = '$quantity', brand = '$brand', img_url = 'Sandals&Slides/MinimalistSandalswithAnkleStrap' WHERE product_id = '$id'";

        $result = mysqli_query($this->con, $qr);
        if (!$result) {
            echo "Error updating product: " . mysqli_error($this->con);
        }

        return $result;
    }

}
?>