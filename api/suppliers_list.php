<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php';
try {
    $db = new Database();
    $conn = $db->getConnection();
    // แก้ชื่อตารางเป็น tb_suppliers ให้ตรงกับฐานข้อมูล
    $stmt = $conn->query("SELECT * FROM tb_suppliers"); 
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["status" => "success", "data" => $data]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>