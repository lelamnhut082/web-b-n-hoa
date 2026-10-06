<?php
namespace App\Models;

abstract class BaseModel {
    protected $db;
    protected $tableName;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->db->loadAllRows($sql);
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = ?";
        return $this->db->loadRow($sql, [$id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->tableName} WHERE id = ?";
        return $this->db->execute($sql, [$id]);
    }

    public function execute($sql, $params = []) {
        return $this->db->execute($sql, $params);
    }
}
