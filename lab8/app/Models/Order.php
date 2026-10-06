<?php
namespace App\Models;

class Order extends BaseModel {
    protected $tableName = 'orders';

    public function create($userId, $totalAmount) {
        $sql = "INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'pending')";
        $this->db->execute($sql, [$userId, $totalAmount]);
        return $this->db->getLastId();
    }

    public function getAllOrders() {
        // Assume users table has 'name'
        $sql = "SELECT orders.*, users.name as user_name 
                FROM orders 
                LEFT JOIN users ON orders.user_id = users.id 
                ORDER BY orders.created_at DESC";
        return $this->db->loadAllRows($sql);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        return $this->db->execute($sql, [$status, $id]);
    }
}
