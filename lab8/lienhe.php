<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Liên Hệ Với Chúng Tôi | flowerCorner</title>
</head>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/lienhe.css">

<body>
  <header>
    <?php include 'layout/header.php'; ?>
  </header>
  <div class="contact-container">
    <h1>Liên Hệ Với flowerCorner</h1>

    <div class="contact-wrapper">

      <div class="form-section">
        <h3 class="section-title">Gửi Yêu Cầu/Tin Nhắn</h3>
        <form action="process_contact.php" method="POST" class="contact-form">

          <div class="form-group">
            <label for="name">Họ và tên *</label>
            <input type="text" id="name" name="name" required placeholder="Tên của bạn">
          </div>

          <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required placeholder="example@gmail.com">
          </div>

          <div class="form-group">
            <label for="subject">Tiêu đề (Tùy chọn)</label>
            <input type="text" id="subject" name="subject" placeholder="Về sản phẩm, đơn hàng, v.v.">
          </div>

          <div class="form-group">
            <label for="message">Nội dung *</label>
            <textarea id="message" name="message" required placeholder="Chi tiết yêu cầu của bạn"></textarea>
          </div>

          <button type="submit" class="btn-submit">GỬI TIN NHẮN</button>
        </form>
      </div>

      <div class="info-map-section">

        <div class="info-box">
          <h3 class="section-title">Thông tin Cửa hàng</h3>
          <p><i class="fas fa-map-marker-alt"></i> **Địa chỉ:** 142 Nguyễn Văn Cừ, Phường Cầu Ông Lãnh, TP.HCM</p>
          <p><i class="fas fa-phone-alt"></i> **Hotline:** 1900 633 045</p>
          <p><i class="fas fa-envelope"></i> **Email:** sales@flowercorner.vn</p>
          <p><i class="fas fa-clock"></i> **Giờ làm việc:** 8:00 - 20:00 (Thứ 2 - Chủ nhật)</p>
        </div>

        <div class="map-box">
          <h3 class="section-title">Vị trí trên Bản đồ</h3>
          <div class="map-placeholder" style="border-radius: 1rem; overflow: hidden;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4215.702023882852!2d106.68186037535914!3d10.758803289388913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1b182305f3%3A0xa1a45f556cd15fbd!2zMTQyIE5ndXnhu4VuIFbEg24gQ-G7qywgUGjGsOG7nW5nIE5ndXnhu4VuIEPGsCBUcmluaCwgUXXhuq1uIDEsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e1!3m2!1svi!2s!4v1765397095328!5m2!1svi!2s" width="400" height="280" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
      </div>

    </div>
  </div>
  <?php include 'layout/footer.php'; ?>
</body>

</html> 