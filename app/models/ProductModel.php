<?php

class ProductModel extends Database
{

    public function getProductListAdmin($currentPage = 1, $resultsPerPage = 4)
    {
        $startingLimit = ($currentPage - 1) * $resultsPerPage;

        $totalResults = $this->query("SELECT COUNT(*) as total FROM products");

        $totalRow = $this->fetch($totalResults);

        if ($totalRow) {
            $totalProducts = (int)$totalRow['total'];
        } else {
            $totalProducts = 0; 
        }
        $results = $this->query("SELECT * FROM products LIMIT $startingLimit, $resultsPerPage");

        if (!$results) {
            return [];
        }

        $productList = [];
        while ($row = $this->fetch($results)) {
            $productList[] = $row;
        }

        return [
            'productList' => $productList,
            'totalProducts' => $totalProducts, 
        ];
    }


    public function getProductList()
    {
        $results = $this->query("SELECT * FROM products");
        if (!$results) {
            return [];
        }

        $productList = [];
        while ($row = $this->fetch($results)) {
            $productList[] = $row;
        }

        return $productList;
    }
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

    public function getProductById($id)
    {
        $stmt = $this->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    public function addProduct($name, $price, $quantity, $brand, $img_url)
    {
        $qr = "INSERT INTO products (product_name, price, quantity, size, brand, img_url, category_id) VALUES ('$name', '$price', '$quantity', '[size]', '$brand', '$img_url', 1)";
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
        $deleteCartDetails = "DELETE FROM cart_details WHERE product_id = $id";
        if (!mysqli_query($this->con, $deleteCartDetails)) {
            echo "Lỗi khi xóa bản ghi trong bảng cart_details: " . mysqli_error($this->con);
            return false;
        }
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

    public function filterByCategory($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    public function getAllProducts() {
        $stmt = $this->con->query("SELECT * FROM products");
        $stmt = $this->con->prepare($stmt);
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function getProductDetails($productID) {
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

    public function updateProduct($id, $name, $price, $quantity, $brand, $img_url)
    {

        $qr = "UPDATE products SET product_name = '$name', price = '$price', quantity = '$quantity', brand = '$brand', img_url = '$img_url' WHERE product_id = '$id'";
        $result = mysqli_query($this->con, $qr);
        if (!$result) {
            echo "Error updating product: " . mysqli_error($this->con);
        }
        return $result;
    }

    public function searchProducts($keyword) {
        $data = [];
        $sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%'";
        $stmt = $this->query($sql);
        while ($row = $this->fetch($stmt)){
            $data[] = $row;
        }
        return $data; 
    }

    public function search ($keyword)
    {
        $data = [];
        $sql = "SELECT * FROM products WHERE product_name LIKE ?";
        $stmt = $this->con->prepare($sql);

        $searchTerm = '%' . $keyword . '%';
        $stmt->bind_param('s', $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();

        return $data;
    }

    

}
?>
