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
                <table class="table table-stripped">
                    <thead>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Number of absent</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark Balinario</td>
                            <td>Mayors</td>
                            <td>5 days</td>
                            <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
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

<script>

</script>
</body>

</html>