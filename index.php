<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include("include/css.php")
  ?>
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
<?php 
  include("include/sidebar.php");
?>

  <!-- ======= Hero Section ======= -->


  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row" data-aos="fade-in">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="info">
              <div class="qr-code-reader">
                <h1>QR Code Reader</h1>
                <video id="video" playsinline></video>
                <input type="text" class="form form-control">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>iPortfolio</span></strong>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php
include("include/js.php");
?>
<script src="https://unpkg.com/@zxing/library@0.18.1/umd/index.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const inputField = document.querySelector('.qr-code-reader input');

    inputField.addEventListener('keyup', function () {
      const qrContent = inputField.value.trim(); // Retrieve the value of the input field and remove leading/trailing whitespace

      $.ajax({
            url: 'getData.php', // Replace with the path to your PHP script
            type: 'POST',
            data: {id: qrContent},
            dataType: 'json',
            success: function(response) {
                console.log(response)
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('AJAX Error:', status, '-', error);
            }
        });

    });
  });
  const video = document.getElementById('video');

function startScanner() {
    const codeReader = new ZXing.BrowserQRCodeReader();
    codeReader.decodeFromVideoDevice(undefined, 'video', (result, err) => {
        if (result) {
            alert('QR Code detected, content: ' + result.text);
        } else {
            console.error(err);
        }
    });
}

startScanner();
</script>
</body>

</html>