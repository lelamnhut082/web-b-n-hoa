<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Góp Ý & Phản Hồi | flowerCorner</title>
  <link rel="stylesheet" href="css/gopy.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <?php include 'layout/header.php'; ?>
  </header>
  <div class="feedback-container">
    <h1>Gửi Góp Ý & Phản Hồi</h1>
    <p class="subtitle">Ý kiến của bạn là vô cùng quý giá giúp chúng tôi phục vụ tốt hơn.</p>

    <form action="process_feedback.php" method="POST">

      <div class="form-group">
        <label for="name">Họ và tên *</label>
        <input type="text" id="name" name="name" required placeholder="Tên của bạn">
      </div>

      <div class="form-group">
        <label for="email">Email (Để chúng tôi phản hồi)</label>
        <input type="email" id="email" name="email" placeholder="example@gmail.com">
      </div>

      <div class="form-group">
        <label>Bạn hài lòng với dịch vụ nào nhất?</label>
        <select name="service_type" required>
          <option value="">-- Chọn loại dịch vụ --</option>
          <option value="product_quality">Chất lượng sản phẩm (Hoa)</option>
          <option value="delivery_service">Dịch vụ giao hàng</option>
          <option value="customer_service">Tư vấn và chăm sóc khách hàng</option>
          <option value="website_experience">Trải nghiệm website</option>
        </select>
      </div>

      <div class="form-group">
        <label>Đánh giá tổng thể của bạn:</label>
        <div class="rating-group">

          <div class="rating-option">
            <input type="radio" name="rating" id="rate-1" value="1" required>
            <label for="rate-1"><span style="margin-top: 5px;">1</span><span class="star-rating">★</span></label>
          </div>

          <div class="rating-option">
            <input type="radio" name="rating" id="rate-2" value="2">
            <label for="rate-2"><span style="margin-top: 5px;">2</span><span class="star-rating">★★</span></label>
          </div>

          <div class="rating-option">
            <input type="radio" name="rating" id="rate-3" value="3" checked>
            <label for="rate-3"><span style="margin-top: 5px;">3</span><span class="star-rating">★★★</span></label>
          </div>

          <div class="rating-option">
            <input type="radio" name="rating" id="rate-4" value="4">
            <label for="rate-4"><span style="margin-top: 5px;">4</span><span class="star-rating">★★★★</span></label>
          </div>

          <div class="rating-option">
            <input type="radio" name="rating" id="rate-5" value="5">
            <label for="rate-5"><span style="margin-top: 5px;">5</span><span class="star-rating">★★★★★</span></label>
          </div>

        </div>
      </div>

      <div class="form-group">
        <label for="feedback_detail">Chi tiết góp ý/Đề xuất cải tiến *</label>
        <textarea id="feedback_detail" name="feedback_detail" required placeholder="Vui lòng nêu rõ trải nghiệm của bạn và cách chúng tôi có thể làm tốt hơn..."></textarea>
      </div>

      <button type="submit" class="btn-submit">GỬI GÓP Ý</button>
    </form>
  </div>
  <?php include 'layout/footer.php'; ?>
</body>

</html>