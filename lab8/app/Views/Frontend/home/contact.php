<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="container my-5" style="min-height: 50vh;">
    <h2>Liên Hệ</h2>
    <p>Cảm ơn bạn đã quan tâm. Vui lòng để lại lời nhắn, chúng tôi sẽ liên hệ lại sớm nhất.</p>
    <form>
        <div class="mb-3">
            <label class="form-label">Họ và tên</label>
            <input type="text" class="form-control" placeholder="Nhập tên của bạn">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Nhập email">
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea class="form-control" rows="4" placeholder="Nội dung cần liên hệ"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #6da068; border-color: #6da068;">Gửi Liên Hệ</button>
    </form>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
