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
                <h2>Date of Attendance:</h2>
                <input type="date"  id="attendanceDate" class="form form-control">
                <div id="attendanceTable"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
    <div class="card">
      <div class="card-body">
        
      </div>
    </div>
    

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
$(document).ready(function() {
  $('#attendanceDate').change(function() {
    var selectedDate = $(this).val();
    getAttendanceData(selectedDate);
  });
});

function getAttendanceData(date) {
  $.ajax({
    url: 'getAttendance.php',
    method: 'POST',
    dataType: 'json', // Set the expected data type to JSON
    data: { date: date },
    success: function(data) {
      displayAttendanceTable(data);
    },
    error: function(xhr, status, error) {
      console.error('Failed to fetch attendance data:', error);
    }
  });
}

function displayAttendanceTable(attendanceData) {
  var tableHTML = '<table class="table table-stripped"><tr><th>Name</th><th>AM Time In</th><th>AM Time Out</th><th>PM Time In</th><th>PM Time Out</th></tr>';

  $.each(attendanceData, function(index, record) {
    tableHTML += '<tr><td>' + record.name + '</td><td>' + record.am_time_in + '</td><td>' + record.am_time_out + '</td><td>' + record.pm_time_in + '</td><td>' + record.pm_time_out + '</td></tr>';
  });

  tableHTML += '</table>';

  $('#attendanceTable').html(tableHTML);
}

</script>
</body>

</html>