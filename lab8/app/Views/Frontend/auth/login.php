<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
    body { background-color: #f4f4f4; }
    .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 350px; margin: 50px auto; }
    .login-box h2 { text-align: center; color: #333; margin-bottom: 20px; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
    .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
    .error { color: #e74c3c; font-size: 14px; margin-top: 5px; text-align: center; }
    .success { color: green; font-size: 14px; margin-top: 5px; text-align: center; }
    button { width: 100%; padding: 10px; background-color: #6da068; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; }
    button:hover { background-color: #5a8a55; }
    .link-register { text-align: center; margin-top: 15px; }
</style>

<div class="login-box">
    <h2>Đăng Nhập</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <p class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>

    <form action="index.php?act=login" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Đăng Nhập</button>
    </form>

    <p class="link-register">
        Chưa có tài khoản? <a href="index.php?act=register">Đăng ký ngay</a>
    </p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
