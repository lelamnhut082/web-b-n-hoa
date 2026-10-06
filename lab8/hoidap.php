<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Hỏi & Đáp Thường Gặp | flowerCorner</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fcfcfc;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .faq-container {
      max-width: 900px;
      margin: 50px auto;
      padding: 0 20px;
    }

    h1 {
      text-align: center;
      color: #6da068;
      /* Màu xanh lá cây thương hiệu */
      font-size: 34px;
      margin-bottom: 40px;
      border-bottom: 2px solid #f7a9a8;
      padding-bottom: 15px;
    }

    /* ---------------- ACCORDION STYLING ---------------- */
    .faq-item {
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 12px;
      overflow: hidden;
      /* Quan trọng để ẩn nội dung */
    }

    .faq-question {
      background-color: #ffffff;
      color: #333;
      padding: 15px 20px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: bold;
      font-size: 16px;
      border-bottom: 1px solid #eee;
      transition: background-color 0.3s;
    }

    .faq-question:hover {
      background-color: #f5f5f5;
    }

    .faq-question.active {
      background-color: #f7a9a8;
      /* Màu hồng khi active */
      color: white;
    }

    .faq-answer {
      background-color: #fff8f8;
      /* Màu nền nhẹ nhàng cho câu trả lời */
      padding: 0 20px;
      max-height: 0;
      /* Mặc định ẩn */
      overflow: hidden;
      transition: max-height 0.4s ease-out;
      /* Tạo hiệu ứng trượt */
    }

    .faq-answer p {
      padding: 15px 0;
      margin: 0;
      line-height: 1.6;
      color: #555;
    }

    .toggle-icon {
      font-size: 1.2em;
      transition: transform 0.3s;
    }

    .faq-question.active .toggle-icon {
      transform: rotate(45deg);
      /* Xoay dấu '+' thành 'x' hoặc '-' thành '+' */
    }
  </style>
</head>

<body>
  <header>
    <?php include 'layout/header.php'; ?>
  </header>
  <div class="faq-container">
    <h1>Câu Hỏi Thường Gặp (FAQ)</h1>

    <div class="faq-list">

      <div class="faq-item">
        <div class="faq-question">
          1. Tôi có thể đặt hoa trước bao lâu?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Bạn nên đặt hoa trước ít nhất **2-3 giờ** đối với các mẫu có sẵn. Đối với các thiết kế hoa đặc biệt, số lượng lớn hoặc hoa nhập khẩu hiếm, vui lòng đặt trước **ít nhất 24 giờ** để chúng tôi chuẩn bị nguyên vật liệu tốt nhất.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          2. flowerCorner có giao hàng trong ngày lễ, Tết không?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Chúng tôi hoạt động cả vào các ngày lễ lớn như Valentine, 8/3, 20/10, và Tết Nguyên Đán. Tuy nhiên, phí giao hàng có thể điều chỉnh và bạn cần đặt hàng sớm vì số lượng đơn hàng trong các dịp này rất cao.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          3. Chi phí vận chuyển được tính như thế nào?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Phí vận chuyển được tính dựa trên địa chỉ nhận hàng và khoảng cách từ cửa hàng gần nhất. Chúng tôi có chính sách **miễn phí giao hàng** trong bán kính 3-5km tùy khu vực và đơn hàng tối thiểu 500.000đ.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          4. Tôi muốn thay đổi loại hoa hoặc màu sắc trong bó hoa có được không?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Chắc chắn rồi! Nếu bạn muốn tùy chỉnh bó hoa, vui lòng ghi chú rõ ràng trong mục Ghi chú Đơn hàng hoặc liên hệ trực tiếp qua Hotline. Tùy chỉnh có thể phát sinh thêm chi phí nếu bạn chọn loại hoa cao cấp hơn.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          5. Chính sách đổi trả và hoàn tiền của flowerCorner?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Chúng tôi cam kết hoa tươi và đạt chất lượng tốt nhất khi giao. Nếu hoa bị hư hỏng nặng hoặc sai mẫu hoàn toàn do lỗi của shop, chúng tôi sẽ đổi sản phẩm mới hoặc hoàn tiền 100% trong vòng **2 giờ** kể từ khi nhận hàng.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          6. Làm sao để giữ hoa tươi lâu nhất?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Để hoa tươi lâu, bạn nên: 1) Cắt chéo gốc hoa khoảng 2cm; 2) Thay nước sạch hàng ngày; 3) Để hoa ở nơi thoáng mát, tránh ánh nắng trực tiếp và gió điều hòa.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          7. Tôi có thể hủy đơn hàng sau khi đã thanh toán không?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Bạn có thể hủy đơn hàng và được hoàn tiền nếu việc hủy diễn ra **trước 2 giờ** so với thời gian giao hàng đã hẹn (để chúng tôi chưa kịp cắm hoa). Sau thời gian này, chúng tôi không thể hoàn tiền do hoa đã được chuẩn bị.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          8. Tôi có cần đăng ký tài khoản để đặt hoa không?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Bạn có thể đặt hoa với tư cách khách (Guest Checkout) mà không cần đăng ký. Tuy nhiên, việc đăng ký tài khoản giúp bạn dễ dàng theo dõi lịch sử đơn hàng và nhận các chương trình ưu đãi độc quyền.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          9. flowerCorner có cung cấp hóa đơn VAT không?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Có. Nếu bạn cần hóa đơn giá trị gia tăng (VAT), vui lòng chọn mục Ghi chú Đơn hàng và cung cấp đầy đủ thông tin Tên công ty, Mã số thuế và Địa chỉ email nhận hóa đơn.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          10. Mẫu hoa thực tế có giống hình trên website 100% không?
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Do hoa là sản phẩm thủ công và phụ thuộc vào mùa vụ, bó hoa thực tế có thể giống **khoảng 80-90%** so với hình mẫu. Chúng tôi cam kết giữ nguyên tông màu, phong cách và giá trị của bó hoa.</p>
        </div>
      </div>

    </div>
  </div>
  <?php include 'layout/footer.php'; ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const questions = document.querySelectorAll('.faq-question');

      questions.forEach(question => {
        question.addEventListener('click', function() {
          const answer = this.nextElementSibling;

          // Đóng tất cả các câu trả lời khác
          questions.forEach(q => {
            if (q !== this && q.classList.contains('active')) {
              q.classList.remove('active');
              q.nextElementSibling.style.maxHeight = null;
            }
          });

          // Mở/Đóng câu trả lời hiện tại
          this.classList.toggle('active');
          if (answer.style.maxHeight) {
            answer.style.maxHeight = null; // Đóng
          } else {
            // Mở: Đặt max-height bằng chiều cao nội dung thực tế
            answer.style.maxHeight = answer.scrollHeight + "px";
          }
        });
      });
    });
  </script>

</body>

</html>