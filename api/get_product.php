<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/ConnDB.php';

if (isset($_GET['id'])) {
    try {
        $db = new Database();
        $conn = $db->getConnection();
        $id = $_GET['id'];

        $sql = "SELECT * FROM tb_products WHERE i_ProductID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            http_response_code(200);
            echo json_encode(["status" => "success", "data" => $data]);
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "ไม่พบข้อมูลสินค้า"]);
        }
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        exit;
    }
}
?>