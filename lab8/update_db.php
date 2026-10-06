<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=newphp1;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('ALTER TABLE products ADD COLUMN quantity INT DEFAULT 20');
    echo 'quantity column added successfully!<br>';
} catch (Exception $e) {
    echo 'quantity column error (or already exists): ' . $e->getMessage() . '<br>';
}
try {
    $pdo->exec('ALTER TABLE products ADD COLUMN sold_count INT DEFAULT 0');
    echo 'sold_count column added successfully!<br>';
} catch (Exception $e) {
    echo 'sold_count column error (or already exists): ' . $e->getMessage() . '<br>';
}
?>
