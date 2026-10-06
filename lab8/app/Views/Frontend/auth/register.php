<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
    body { background-color: #f4f4f4; }
    .register-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 350px; margin: 50px auto; }
    .register-box h2 { text-align: center; color: #333; margin-bottom: 20px; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
    .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
    .error { color: #e74c3c; font-size: 14px; margin-top: 5px; text-align: center; }
    button { width: 100%; padding: 10px; background-color: #6da068; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; }
    button:hover { background-color: #5a8a55; }
    .link-login { text-align: center; margin-top: 15px; }
</style>

<div class="register-box">
    <h2>Đăng Ký</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="index.php?act=register" method="POST">
        <div class="form-group">
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirm">Xác nhận Mật khẩu:</label>
            <input type="password" id="password_confirm" name="password_confirm" required>
        </div>
        <button type="submit">Đăng Ký</button>
    </form>

    <p class="link-login">
        Đã có tài khoản? <a href="index.php?act=login">Đăng nhập ngay</a>
    </p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
