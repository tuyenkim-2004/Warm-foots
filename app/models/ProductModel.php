<?php

class ProductModel extends Database
{
    // Lấy danh sách tất cả sản phẩm
    public function getProductList()
    {
        $results = $this->query("SELECT * FROM products");
        
        // Kiểm tra nếu có lỗi trong câu truy vấn
        if (!$results) {
            return []; // Trả về mảng rỗng nếu không có kết quả hoặc có lỗi
        }
    
        // Lấy tất cả các hàng
        $productList = [];
        while ($row = $this->fetch($results)) {
            $productList[] = $row; // Sử dụng cú pháp ngắn để thêm phần tử vào mảng
        }
        
        return $productList;
    }

    // Lấy 3 sản phẩm đầu tiên
    public function get3Products()
    {
        $results = $this->query("SELECT * FROM products LIMIT 3");
        if (!$results) {
            return []; // Trả về mảng rỗng nếu không có kết quả
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

    // Thêm sản phẩm mới
    public function addProduct($name, $price, $quantity, $size, $brand, $img_url, $category_id)
    {
        $stmt = $this->prepare("INSERT INTO products (product_name, price, quantity, size, brand, img_url, category_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdissssi", $name, $price, $quantity, $size, $brand, $img_url, $category_id);
        return $stmt->execute();
    }

    // Cập nhật thông tin sản phẩm
    public function updateProduct($id, $name, $price, $quantity, $size, $brand, $img_url, $category_id)
    {
        $stmt = $this->prepare("UPDATE products SET 
                                    product_name = ?, 
                                    price = ?, 
                                    quantity = ?, 
                                    size = ?, 
                                    brand = ?, 
                                    img_url = ?, 
                                    category_id = ? 
                                WHERE product_id = ?");
        $stmt->bind_param("sdissssii", $name, $price, $quantity, $size, $brand, $img_url, $category_id, $id);
        return $stmt->execute();
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        $stmt = $this->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Đếm số lượng sản phẩm
    public function countProduct()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM products");
        return $result ? $result->fetch_assoc()["count"] : 0; // Trả về 0 nếu không có kết quả
    }
}
?>