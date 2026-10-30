<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        $conn = $db->getConnection();

        // รับค่า ProductID ที่ต้องการลบ
        $productId = $_POST['ProductID'] ?? '';

        if (empty($productId)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ไม่พบรหัสอ้างอิงของสินค้าที่ต้องการลบ"]);
            exit;
        }

        // คำสั่ง SQL ลบข้อมูล
        $sql = "DELETE FROM tb_products WHERE i_ProductID = :id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "ลบข้อมูลผลิตภัณฑ์ออกจากระบบสำเร็จ"]);
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