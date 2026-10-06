<?php
class   Database{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "newphp1";
    public $conn;
    function __construct(){

    try {
    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    }
    // phương thức lấy ra tất cả dữ liệu
    function getAll($sq1){
        $stmt = $this->conn->prepare("$sq1");
        $stmt->execute();

        // set the resulting array to associative
        return $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }
    // phương thức thêm xóa sửa, update
    function action($sq1){
        $stmt = $this->conn->prepare("$sq1");
        $stmt->execute();

    }
    function __destruct(){
        $this->conn = null;
    }
}
?>
