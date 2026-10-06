<?php
// migrate.php
require_once 'app/Models/Database.php';
require_once 'app/Models/BaseModel.php';

use App\Models\Database;

// Fix for standalone run
if (!class_exists('App\Models\Database')) {
    // Basic autoloader for the script if needed, but normally we just include
    include_once 'app/Models/Database.php';
}

$db = Database::getInstance();
$conn = $db->getConnection();

echo "Migrating data to 'newphp1'...\n";

// 1. Create Tables if not exist (Running schema logic roughly)
$sqlSchemas = [
    "CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        img VARCHAR(255),
        description TEXT,
        category_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
    )"
];

foreach ($sqlSchemas as $sql) {
    try {
        $conn->exec($sql);
    } catch (PDOException $e) {
        echo "Table creation warning: " . $e->getMessage() . "\n";
    }
}

// 2. Read JSON
$jsonFile = 'products.json';
if (!file_exists($jsonFile)) {
    die("products.json not found.\n");
}

$jsonData = file_get_contents($jsonFile);
$products = json_decode($jsonData, true);

if (!$products) {
    die("Invalid JSON data.\n");
}

// 3. Insert Categories and Products
$categories = [
    'bo_hoa_tinh_te' => 'Bó Hoa Tinh Tế',
    'gio_hoa_sang_trong' => 'Giỏ Hoa Sang Trọng',
    'hop_hoa_doc_dao' => 'Hộp Hoa Độc Đáo'
];

$categoryMap = []; // slug -> id

$stmtCat = $conn->prepare("INSERT INTO categories (name, slug) VALUES (?, ?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)");
foreach ($categories as $slug => $name) {
    $stmtCat->execute([$name, $slug]);
    $categoryMap[$slug] = $conn->lastInsertId();
}

$stmtProd = $conn->prepare("INSERT INTO products (name, price, img, category_id, description, created_at) VALUES (?, ?, ?, ?, ?, NOW())");

foreach ($products as $p) {
    $price = (float)str_replace(['.', 'đ'], '', $p['price']); // Convert "490.000đ" to 490000
    $catId = $categoryMap[$p['category']] ?? null;
    
    // Check if exists to avoid duplicates (optional, based on name)
    $check = $conn->prepare("SELECT id FROM products WHERE name = ?");
    $check->execute([$p['name']]);
    if ($check->rowCount() > 0) {
        echo "Skipping existing product: " . $p['name'] . "\n";
        continue;
    }

    $stmtProd->execute([
        $p['name'],
        $price,
        $p['img'],
        $catId,
        $p['description'] ?? 'Mô tả sản phẩm đang cập nhật...'
    ]);
    echo "Imported: " . $p['name'] . "\n";
}

// 4. Migrate Users
$userFile = 'users.json';
if (file_exists($userFile)) {
    $userData = file_get_contents($userFile);
    $users = json_decode($userData, true);
    if ($users) {
        $stmtUser = $conn->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
        foreach ($users as $u) {
            // Check existence
            $checkU = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $checkU->execute([$u['email']]);
            if ($checkU->rowCount() > 0) continue;

            // Simple password handling - assumes they are already hashed or need hashing?
            // Existing `process_auth.php` used password_hash. So json has HASHED passwords.
            // My User model uses hashed passwords. So we can just copy.
            $pass = $u['password'] ?? ''; 
            $role = 'user';
            
            // Check if admin
            if ($u['email'] === 'admin@gmail.com') $role = 'admin';

            $stmtUser->execute([$u['name'], $u['email'], $pass, $role]);
            echo "Imported User: " . $u['name'] . "\n";
        }
    }
}


echo "Migration Completed.\n";
