<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowerCorner</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
    <header>
        <nav>
            <div class="menu">
                <div class="w-logo">
                    <a href="index.php">
                        <img src="img/logo.webp" alt="logo">
                    </a>
                </div>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li>
                        <a href="index.php?act=products">SẢN PHẨM</a>
                        <!-- Submenu omitted for brevity or can be updated to categories dynamically if needed -->
                    </li>
                    <li><a href="index.php?act=contact">LIÊN HỆ</a></li>
                    <li><a href="index.php?act=faq">HỎI & ĐÁP</a></li>
                </ul>
                <div class="login-container" style="float:right; padding-right: 15px;">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="#" class="user-info">
                            <i class="fa-solid fa-user"></i>
                            <span style="font-weight: bold; color: #6da068;"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
                        </a>
                         <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                            <a href="index.php?act=admin" class="dk" style="color:black;">Admin</a>
                        <?php endif; ?>
                        <a href="index.php?act=cart" class="dk" style="color:black;"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
                        <a href="index.php?act=logout" class="dk" style="color:black;">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất
                        </a>
                    <?php else: ?>
                        <a href="index.php?act=login" class="dn">
                            <i class="fa-solid fa-user"></i> Đăng nhập
                        </a>
                        <a href="index.php?act=register" class="dk" style="color:black;">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng ký
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
