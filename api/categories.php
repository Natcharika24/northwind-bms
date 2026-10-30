<?php
// กำหนด Header ให้ตอบกลับเป็น JSON และรองรับภาษาไทย
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php'; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

try {
    // สร้าง Object Database และเชื่อมต่อ
    $db = new Database();
    $conn = $db->getConnection();

    // คำสั่ง SQL ดึงข้อมูลหมวดหมู่ (อิงตาม Naming Convention ที่อาจารย์ใช้)
    $sql = "SELECT i_CategoryID, c_CategoryName FROM tb_categories ORDER BY i_CategoryID ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // ดึงข้อมูลทั้งหมดออกมาเป็น Associative Array
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // ส่งข้อมูลกลับไปแบบ JSON
    http_response_code(200); // 200 OK
    echo json_encode([
        "status" => "success", 
        "total" => count($datas),
        "data" => $datas
    ]);
    
    exit; // จบการทำงาน เพื่อไม่ให้มี tag HTML อื่นๆ ปนไปกับ JSON

} catch (PDOException $e) {
    // กรณีเกิด Error จากฐานข้อมูล
    http_response_code(500); // 500 Internal Server Error
    echo json_encode(["status" => "error", "message" => "Database Error: " . $e->getMessage()]);
    exit;
}
?>