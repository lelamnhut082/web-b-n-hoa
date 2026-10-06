<?php
// setup.php

$directories = [
    'app/Controllers',
    'app/Models',
    'app/Views/auth',
    'app/Views/home',
    'app/Views/products',
    'app/Views/cart',
    'app/Views/admin/products', 
    'app/Views/layouts',
    'public',
    'config'
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0777, true)) {
            echo "Created directory: $dir\n";
        } else {
            echo "Failed to create directory: $dir\n";
        }
    } else {
        echo "Directory already exists: $dir\n";
    }
}

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php1";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = file_get_contents('schema.sql');
    
    // Execute multiple queries
    $conn->exec($sql);
    echo "Database and tables created successfully.\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
