<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    // ดึงจำนวนสินค้าทั้งหมด
    $stmtProducts = $conn->query("SELECT COUNT(*) as total FROM tb_products");
    $totalProducts = $stmtProducts->fetch(PDO::FETCH_ASSOC)['total'];

    // (สมมติ) ดึงจำนวนหมวดหมู่
    $stmtCategories = $conn->query("SELECT COUNT(*) as total FROM tb_categories");
    $totalCategories = $stmtCategories->fetch(PDO::FETCH_ASSOC)['total'];

    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "data" => [
            "products" => $totalProducts,
            "categories" => $totalCategories,
            "orders" => 196, // ตัวเลขสมมติไปก่อน รอทำตาราง Orders
            "customers" => 91 // ตัวเลขสมมติไปก่อน รอทำตาราง Customers
        ]
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>