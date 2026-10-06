<?php
include "data.php";

$id = $_GET["id"];

if (!isset($products[$id])) {
    echo "Sản phẩm không tồn tại!";
    exit;
}

$sp = $products[$id];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm - <?= $sp["ten"] ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .product-detail { display: flex; gap: 30px; padding: 30px 0; }
        .product-detail img { width: 450px; border-radius: 10px; }
        .product-info { flex: 1; }
        .product-info h2 { color: #fff; font-size: 26px; margin-bottom: 10px; }
        .product-info .old-price { color: gray; text-decoration: line-through; font-size: 18px; }
        .product-info .price { color: #ff4f7b; font-size: 24px; font-weight: bold; }
        .product-info .discount { background: #ff4f7b; padding: 4px 8px; border-radius: 5px; font-size: 14px; margin-left: 10px; }
        .product-info p { margin-top: 10px; line-height: 1.6; }
        .product-info button { background:#d11b6b;color:white;border:none;border-radius:20px;padding:10px 20px;font-size:16px;font-weight:bold;cursor:pointer;margin-top:15px; }
        .product-info button:hover { background:white;color:#d11b6b; }
        .order-btn { display:inline-block;margin-top:15px;padding:12px 28px;background:#d11b6b;color:white;font-size:18px;font-weight:bold;border:none;border-radius:25px;cursor:pointer;transition:0.3s; }
        .order-btn:hover { background:white;color:#d11b6b;border:2px solid #d11b6b;transform:scale(1.05); }
        footer {width:100%;min-height:100px;color:white;font-size:larger;line-height:100px;text-align:center;background:#d11b6b;margin-top:50px;}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="img/logo.webp" alt="logo">
        </header>

        <nav>
            <div class="menu">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li>
                        <a href="sanpham.php">SẢN PHẨM</a>
                        <ul>
                            <li><a href="menu_hoakhaitruong.php">Hoa khai trương để bàn</a></li>
                            <li><a href="menu_hoasinhnhat.php">Hoa sinh nhật</a></li>
                            <li><a href="menu_hoahong.php">Hoa hồng</a></li>
                            <li><a href="menu_hoasen.php">Hoa sen</a></li>
                            <li><a href="menu_hoadongtien.php">Hoa đồng tiền</a></li>
                        </ul>
                    </li>
                    <li><a href="lienhe.php">LIÊN HỆ</a></li>
                    <li><a href="hoidap.php">HỎI & ĐÁP</a></li>
                    <li><a href="gopy.php">GÓP Ý</a></li>

                    <div style="float:right; padding-right:15px;">
                        <a href="dangnhap.php" class="dn">Đăng nhập</a>
                        <a href="dangky.php" class="dk">Đăng ký</a>
                    </div>
                </ul>
            </div>
        </nav>

        <div class="product-detail">
            <div class="left">
                <img src="<?= $sp["anh"] ?>" alt="<?= $sp['ten'] ?>">
            </div>

            <div class="right">
                <h1><?= $sp["ten"] ?></h1>

                <p class="price">
                    <del><?= number_format($sp["gia_cu"]) ?>đ</del>
                    <?= number_format($sp["gia_moi"]) ?>đ
                </p>

                <div class="description">
                    <?= $sp["mota"] ?>
                </div>

                <div class="info-section">
                    <h3>Chi tiết bó hoa</h3>
                    <ul>
                        <?php foreach ($sp["chitiet"] as $ct): ?>
                            <li><?= $ct ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="info-section">
                    <h3>Lưu ý</h3>
                    <p>
                        Do đặc điểm thủ công, sản phẩm thực tế có thể khác nhẹ so với hình trên website.
                        FlowerCorner cam kết sản phẩm giống khoảng 80% so với hình.
                        Tùy theo mùa, loại hoa phụ sẽ thay đổi phù hợp nhất.
                    </p>
                </div>

                <a href="giohang.php?id=<?= $id ?>" class="order-btn">ĐẶT HOA NGAY</a>
            </div>
        </div>

        <footer>
            © 2025 FlowerCorner Demo | Thiết kế bởi HTML & CSS
        </footer>
    </div>
</body>
</html>
