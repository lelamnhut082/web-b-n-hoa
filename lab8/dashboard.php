<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
	// Nếu chưa, chuyển hướng về trang đăng nhập
	header('Location: login.php');
	exit();
}

$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<title>Trang Quản lý Cá nhân</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			text-align: center;
			padding-top: 50px;
		}

		.welcome-box {
			border: 1px solid #ccc;
			padding: 30px;
			display: inline-block;
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
		}

		.welcome-box h1 {
			color: #6da068;
		}

		.logout-btn {
			padding: 10px 20px;
			background-color: #e74c3c;
			color: white;
			border: none;
			border-radius: 4px;
			text-decoration: none;
			display: inline-block;
			margin-top: 20px;
		}

		.logout-btn:hover {
			background-color: #c0392b;
		}
	</style>
</head>

<body>

	<div class="welcome-box">
		<h1>Xin chào, <?php echo htmlspecialchars($user_name); ?>!</h1>
		<p>Bạn đã đăng nhập thành công. Đây là trang quản lý cá nhân của bạn.</p>
		<p>ID người dùng trong Session: <?php echo $_SESSION['user_id']; ?></p>

		<a href="process_auth.php?action=logout" class="logout-btn">Đăng Xuất</a>
	</div>

</body>

</html>