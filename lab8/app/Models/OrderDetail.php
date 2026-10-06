<?php
namespace App\Models;

class OrderDetail extends BaseModel {
    protected $tableName = 'order_details';

    public function create($orderId, $productId, $quantity, $price) {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        return $this->db->execute($sql, [$orderId, $productId, $quantity, $price]);
    }

    public function getByOrderId($orderId) {
        $sql = "SELECT * FROM order_details WHERE order_id = ?";
        return $this->db->loadAllRows($sql, [$orderId]);
    }
}
