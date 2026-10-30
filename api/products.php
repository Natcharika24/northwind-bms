<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php'; 

try {
    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT i_ProductID, c_ProductName, i_CategoryID, i_SupplierID, c_Unit, i_Price 
            FROM tb_products 
            ORDER BY i_ProductID DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    echo json_encode([
        "status" => "success", 
        "total" => count($datas), 
        "data" => $datas
    ]);
    exit;

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    exit;
}
?>