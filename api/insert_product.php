<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php';

// ตรวจสอบว่าเป็นการส่งข้อมูลแบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        $conn = $db->getConnection();

        // รับค่าจากฟอร์ม
        $productName = $_POST['ProductName'] ?? '';
        $catId = $_POST['CatID'] ?? '';
        $supplierId = $_POST['SupplierID'] ?? '';
        $unit = $_POST['Unit'] ?? '';
        $price = $_POST['Price'] ?? '';

        // ตรวจสอบข้อมูลเบื้องต้น
        if (empty($productName) || empty($catId) || empty($supplierId) || empty($price)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "กรุณากรอกข้อมูลให้ครบถ้วน"]);
            exit;
        }

        // คำสั่ง SQL แบบ Bind Parameter ป้องกัน SQL Injection
        $sql = "INSERT INTO tb_products (c_ProductName, i_CategoryID, i_SupplierID, c_Unit, i_Price) 
                VALUES (:pname, :cid, :sid, :unit, :price)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pname', $productName, PDO::PARAM_STR);
        $stmt->bindParam(':cid', $catId, PDO::PARAM_INT);
        $stmt->bindParam(':sid', $supplierId, PDO::PARAM_INT);
        $stmt->bindParam(':unit', $unit, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        
        $stmt->execute();

        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "บันทึกข้อมูลผลิตภัณฑ์สำเร็จ"]);
        exit;

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Database Error: " . $e->getMessage()]);
        exit;
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
    exit;
}
?>