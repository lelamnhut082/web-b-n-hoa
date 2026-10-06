<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


/**
 * Đọc dữ liệu từ file JSON
 * @param string $file_name Tên file (ví dụ: products.json)
 * @return array
 */
function readJsonFile(string $file_name): array {
    $file_path = $file_name;
    if (!file_exists($file_path)) {
        file_put_contents($file_path, json_encode([])); // Tạo file rỗng nếu không tồn tại
        return [];
    }
    $data = file_get_contents($file_path);
    return json_decode($data, true) ?? [];
}

/**
 * Ghi dữ liệu vào file JSON
 * @param string $file_name Tên file (ví dụ: users.json)
 * @param array $data Dữ liệu cần ghi
 * @return bool
 */
function writeJsonFile(string $file_name, array $data): bool {
    $file_path = $file_name;
    return file_put_contents($file_path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

/**
 * Yêu cầu người dùng đăng nhập, nếu chưa thì chuyển hướng.
 */
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

/**
 * Tìm người dùng theo ID
 * @param int $id
 * @return array|null
 */
function findUserById(int $id): ?array {
    $users = readJsonFile('users.json');
    foreach ($users as $user) {
        if ($user['id'] === $id) {
            return $user;
        }
    }
    return null;
}
?>