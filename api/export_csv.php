<?php
require_once '../config/ConnDB.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    // ดึงข้อมูลสินค้าทั้งหมด
    $sql = "SELECT i_ProductID, c_ProductName, i_CategoryID, i_SupplierID, c_Unit, i_Price 
            FROM tb_products 
            ORDER BY i_ProductID DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ตั้งค่า Header ให้เบราว์เซอร์รู้ว่านี่คือไฟล์ดาวน์โหลด CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="northwind_products_' . date('Ymd_His') . '.csv"');

    // เปิด Output Stream
    $output = fopen('php://output', 'w');

    // ใส่ BOM (Byte Order Mark) เพื่อให้ MS Excel อ่านภาษาไทยได้ถูกต้อง
    fputs($output, "\xEF\xBB\xBF");

    // สร้างหัวตาราง (Header Row) ของไฟล์ CSV
    fputcsv($output, ['รหัสอ้างอิง', 'ชื่อผลิตภัณฑ์', 'รหัสหมวดหมู่', 'รหัสผู้จัดจำหน่าย', 'หน่วยบรรจุภัณฑ์', 'ราคา (บาท)']);

    // วนลูปนำข้อมูลจากฐานข้อมูลใส่ลงไปทีละแถว
    foreach ($products as $row) {
        fputcsv($output, [
            $row['i_ProductID'],
            $row['c_ProductName'],
            $row['i_CategoryID'],
            $row['i_SupplierID'],
            $row['c_Unit'],
            $row['i_Price']
        ]);
    }

    // ปิดการเขียนไฟล์
    fclose($output);
    exit;

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
    exit;
}
?>