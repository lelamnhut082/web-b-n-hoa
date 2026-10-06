<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="container my-5" style="min-height: 50vh;">
    <h2>Hỏi & Đáp</h2>
    
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Cửa hàng có giao hàng tận nơi không?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Có, chúng tôi hỗ trợ giao hàng tận nơi trong nội thành trong thời gian nhanh nhất.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Làm sao để thanh toán?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Chúng tôi chấp nhận thanh toán khi nhận hàng (COD) hoặc chuyển khoản ngân hàng.
          </div>
        </div>
      </div>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
