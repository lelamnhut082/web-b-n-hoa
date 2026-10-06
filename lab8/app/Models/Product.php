<?php
namespace App\Models;

class Product extends BaseModel {
    protected $tableName = 'products';

    public function getProductsByCategory($slug) {
        $sql = "SELECT p.*, c.slug as category_slug 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE c.slug = ?";
        return $this->db->loadAllRows($sql, [$slug]);
    }

    public function getAllWithCategory() {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id";
        return $this->db->loadAllRows($sql);
    }

    public function getOutOfStock() {
        $sql = "SELECT p.*, c.name as category_name FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.quantity <= 0";
        return $this->db->loadAllRows($sql);
    }

    public function getBestSelling($limit = 10) {
        $limit = (int)$limit;
        $sql = "SELECT p.*, c.name as category_name FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.sold_count DESC LIMIT $limit";
        return $this->db->loadAllRows($sql);
    }

    public function updateStockAndSold($productId, $qty) {
        $sql = "UPDATE products SET quantity = quantity - ?, sold_count = sold_count + ? WHERE id = ?";
        return $this->db->execute($sql, [$qty, $qty, $productId]);
    }
}
