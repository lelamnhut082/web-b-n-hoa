<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$is_logged_in = isset($_SESSION['user_id']) && isset($_SESSION['user_name']);
$user_name = $is_logged_in ? htmlspecialchars($_SESSION['user_name']) : '';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
	nav {
		width: 100%;
		background-color: #fcfcfc;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		position: sticky;
		top: 0;
		z-index: 1000;
		color: black;
	}

	nav .menu {
		max-width: 1200px;
		display: flex;
		margin: 0 auto;
		padding: 20px 20px;
		align-items: center;
		gap: 20px;
	}

	nav .menu>ul {
		list-style: none;
		margin: 0;
		padding: 0;
		display: flex;
		align-items: center;
		height: 100%;
		flex: 1;
		/* justify-content: space-evenly; */
	}

	.w-logo>a img {
		height: 40px;
		margin-left: 15px;
	}

	.menu>ul>li>a {
		text-decoration: none;
		color: black;
		font-weight: 600;
		padding: 10px 15px;
		display: block;
		position: relative;
	}

	.menu>ul>li>a:hover {
		color: #ffffff;
	}

	.dk,
	.dn {
		display: flex;
		gap: 5px;
		align-items: center;
		color: black;
	}

	.dk {
		color: white;
	}

	.dk:hover {
		color: #ffffff;
	}

	.login-container {
		display: flex;
		align-items: center;
		gap: 1rem;
	}
</style>

<nav>
	<div class="menu">
		<div class="w-logo">
			<a href="">
				<img src="img/logo.webp" alt="logo">
			</a>
		</div>
		<ul>
			<li><a href="index.php">HOME</a></li>
			<li>
				<a href="menu_hoadongtien.php">SẢN PHẨM</a>
				<ul>
					<li><a href="menu_hoakhaitruong.php">Hoa khai trương</a></li>
					<li><a href="menu_hoasinhnhat.php">Hoa sinh nhật</a></li>
					<li><a href="menu_hoahong.php">Hoa hồng</a></li>
					<li><a href="menu_hoasen.php">Hoa sen</a></li>
					<li><a href="menu_hoadongtien.php">Hoa đồng tiền</a></li>
				</ul>
			</li>

			<li><a href="lienhe.php">LIÊN HỆ</a></li>
			<li><a href="hoidap.php">HỎI & ĐÁP</a></li>
			<li><a href="gopy.php">GÓP Ý</a></li>
		</ul>
		<div class="login-container" style="float:right; padding-right: 15px;">
			<?php if ($is_logged_in): ?>
				<a href="dashboard.php" class="user-info">
					<i class="fa-solid fa-user"></i>
					<span style="font-weight: bold; color: #6da068;"><?php echo $user_name; ?></span>
				</a>
				<a href="/asm/admin_dashboard.php" class="dk">
					<span>Admin</span>
				</a>
				<a href="process_auth.php?action=logout" class="dk">
					<i class="fa-solid fa-arrow-right-from-bracket"></i>
					<span>
						Đăng xuất
					</span>
				</a>
			<?php else: ?>
				<a href="dangnhap.php" class="dn">
					<i class="fa-solid fa-user"></i>
					<span>Đăng nhập</span>
				</a>
				<a href="dangky.php" class="dk">
					<i class="fa-solid fa-arrow-right-from-bracket"></i>
					<span>Đăng ký</span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</nav>