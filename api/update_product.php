<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        $conn = $db->getConnection();

        $productId = $_POST['ProductID'] ?? '';
        $productName = $_POST['ProductName'] ?? '';
        $catId = $_POST['CatID'] ?? '';
        $supplierId = $_POST['SupplierID'] ?? '';
        $unit = $_POST['Unit'] ?? '';
        $price = $_POST['Price'] ?? '';

        if (empty($productId) || empty($productName) || empty($catId) || empty($supplierId) || empty($price)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "กรุณากรอกข้อมูลให้ครบถ้วน"]);
            exit;
        }

        $sql = "UPDATE tb_products 
                SET c_ProductName = :pname, i_CategoryID = :cid, i_SupplierID = :sid, c_Unit = :unit, i_Price = :price 
                WHERE i_ProductID = :id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pname', $productName, PDO::PARAM_STR);
        $stmt->bindParam(':cid', $catId, PDO::PARAM_INT);
        $stmt->bindParam(':sid', $supplierId, PDO::PARAM_INT);
        $stmt->bindParam(':unit', $unit, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        
        $stmt->execute();

        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "อัปเดตข้อมูลผลิตภัณฑ์สำเร็จ"]);
        exit;

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Database Error: " . $e->getMessage()]);
        exit;
    }
}
?>