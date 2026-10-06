<?php
namespace App\Models;

class Category extends BaseModel {
    protected $tableName = 'categories';
    
    public function getBySlug($slug) {
        $sql = "SELECT * FROM categories WHERE slug = ?";
        return $this->db->loadRow($sql, [$slug]);
    }
}
