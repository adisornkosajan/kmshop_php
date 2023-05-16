<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ..signin.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KMshop_admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style type="text/css">
                input[type="date"]::-webkit-datetime-edit, 
                input[type="date"]::-webkit-inner-spin-button, 
                input[type="date"]::-webkit-clear-button {
                color: #fff;
                position: relative;
                }
                input[type="date"]::-webkit-datetime-edit-year-field{
                position: absolute !important;
                border-left:1px solid #8c8c8c;
                padding: 2px;
                color:red;
                left: 56px;
                }
                input[type="date"]::-webkit-datetime-edit-month-field{
                position: absolute !important;
                border-left:1px solid #8c8c8c;
                padding: 2px;
                color:red;
                left: 26px;
                }
                input[type="date"]::-webkit-datetime-edit-day-field{
                position: absolute !important;
                color:red;
                padding: 2px;
                left: 4px;
                }
                /* ตัวอย่าง css จาก  : https://stackoverflow.com/questions/7372038/is-there-any-way-to-change-input-type-date-format */
        </style>

</head>
<?php
$stmt2 = $conn->query("SELECT * FROM users ");
$stmt2->execute();
$row1 = $stmt2->fetchAll();
$id_user = 0;
$today =date('Y-m-d');
if (!$row1) {
} else {
    foreach ($row1 as $row2) {
?>
        <?php $id_user += $row2['user_quantity']; ?>
<?php }
} ?>

<?php
$stmt1 = $conn->query("SELECT * FROM orders ");
$stmt1->execute();
$users = $stmt1->fetchAll();
$grand_total = 0;
$total = 0;
if (!$users) {
} else {
    foreach ($users as $user) {
?>
        <?php $grand_total += $user['amount_paid']; ?>
<?php }
} ?></div>

<body id="page-top" style="background-color:#F8FFF4;" ></body>
<?php
include 'admin_head.php';
include 'admin_nva.php';


?>


<!-- Content Wrapper -->


<!-- Begin Page Content -->


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">การขนส่งและการตรวจสอบ</h1>
    </div>

    <!-- Content Row -->
    <div class="row">


        <!-- Earnings (Monthly) Card Example -->
        

        <!-- Earnings (Monthly) Card Example -->
       


        <?php
$stmt4 = $conn->query("SELECT * FROM orders WHERE status = '6' ");
$stmt4->execute();
$row11 = $stmt4->fetchAll();
$statu3 = 0;
$today =date('Y-m-d');
if (!$row1) {
} else {
    foreach ($row11 as $row21) {
?>
        <?php $statu3 += ($row21['status']-5); ?>
<?php }
} ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2"> 
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 20px">
                            <a href="orders_check.php">สินค้ารอตรวจสอบ</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></i>&nbsp;&nbsp;<?= number_format($statu3); ?> ชิ้น</b></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x " style="color:palevioletred"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
        <?php
$stmt4 = $conn->query("SELECT * FROM orders WHERE status = '1' ");
$stmt4->execute();
$row11 = $stmt4->fetchAll();
$stat21 = 0;
$today =date('Y-m-d');
if (!$row1) {
} else {
    foreach ($row11 as $row21) {
?>
        <?php $stat21 += ($row21['status']); ?>
<?php }
} ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2"> 
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 20px">
                            <a href="orders_WFD.php">สินค้าที่รอการจัดส่ง</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></i>&nbsp;&nbsp;<?= number_format($stat21); ?> ชิ้น</b></div>
                        </div>
                        <div class="col-auto">
                        <i  class="	fas fa-dolly-flatbed fa-2x text-gray-800 " ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
$stmt4 = $conn->query("SELECT * FROM orders WHERE status = '3' ");
$stmt4->execute();
$row11 = $stmt4->fetchAll();
$statu4 = 0;
$today =date('Y-m-d');
if (!$row1) {
} else {
    foreach ($row11 as $row21) {
?>
        <?php $statu4 += ($row21['status']-2); ?>
<?php }
} ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2"> 
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 20px">
                            <a href="orders_ shipping.php">สินค้าที่กำลังจัดส่ง</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></i>&nbsp;&nbsp;<?= number_format($statu4); ?> ชิ้น</b></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-shipping-fast fa-2x " style="color:#2B6AFA"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <?php
$stmt4 = $conn->query("SELECT * FROM orders WHERE status = '4' ");
$stmt4->execute();
$row11 = $stmt4->fetchAll();
$statu1 = 0;
$today =date('Y-m-d');
if (!$row1) {
} else {
    foreach ($row11 as $row21) {
?>
        <?php $statu1 += ($row21['status']-3); ?>
<?php }
} ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2"> 
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 20px">
                            <a href="orders_ succeed.php">สินค้าที่ขายสำเร็จ</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></i>&nbsp;&nbsp;<?= number_format($statu1); ?> ชิ้น</b></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x " style="color:green"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

    <!-- Content Row -->
</div>



   

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">ขอให้วันนี้เป็นวันที่ดี</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<script>
      
      $(document).ready(function(){
      
        var rating_data = 0;
      
          $('#add_review').click(function(){
      
              $('#review_modal').modal('show');
      
          });
      
          $(document).on('mouseenter', '.submit_star', function(){
      
              var rating = $(this).data('rating');
      
              reset_background();
      
              for(var count = 1; count <= rating; count++)
              {
      
                  $('#submit_star_'+count).addClass('text-warning');
      
              }
      
          });
      
          function reset_background()
          {
              for(var count = 1; count <= 5; count++)
              {
      
                  $('#submit_star_'+count).addClass('star-light');
      
                  $('#submit_star_'+count).removeClass('text-warning');
      
              }
          }
      
          $(document).on('mouseleave', '.submit_star', function(){
      
              reset_background();
      
              for(var count = 1; count <= rating_data; count++)
              {
      
                  $('#submit_star_'+count).removeClass('star-light');
      
                  $('#submit_star_'+count).addClass('text-warning');
              }
      
          });
      
          $(document).on('click', '.submit_star', function(){
      
              rating_data = $(this).data('rating');
      
          });
      
          $('#save_review').click(function(){
      
              var user_name = $('#user_name').val();
      
              var user_review = $('#user_review').val();
      
              if(user_name == '' || user_review == '')
              {
                  alert("Please Fill Both Field");
                  return false;
              }
              else
              {
                  $.ajax({
                      url:"submit_rating.php",
                      method:"POST",
                      data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                      success:function(data)
                      {
                          $('#review_modal').modal('hide');
      
                          load_rating_data();
      
                          alert(data);
                      }
                  })
              }
      
          });
      
          load_rating_data();
      
          function load_rating_data()
          {
              $.ajax({
                  url:"submit_rating.php",
                  method:"POST",
                  data:{action:'load_data'},
                  dataType:"JSON",
                  success:function(data)
                  {
                      $('#average_rating').text(data.average_rating);
                      $('#total_review').text(data.total_review);
      
                      var count_star = 0;
      
                      $('.main_star').each(function(){
                          count_star++;
                          if(Math.ceil(data.average_rating) >= count_star)
                          {
                              $(this).addClass('text-warning');
                              $(this).addClass('star-light');
                          }
                      });
      
                      $('#total_five_star_review').text(data.five_star_review);
      
                      $('#total_four_star_review').text(data.four_star_review);
      
                      $('#total_three_star_review').text(data.three_star_review);
      
                      $('#total_two_star_review').text(data.two_star_review);
      
                      $('#total_one_star_review').text(data.one_star_review);
      
                      $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');
      
                      $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');
      
                      $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');
      
                      $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');
      
                      $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');
      
                      if(data.review_data.length > 0)
                      {
                          var html = '';
      
                          for(var count = 0; count < data.review_data.length; count++)
                          {
                              html += '<div class="row mb-3">';
      
                              html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';
      
                              html += '<div class="col-sm-11">';
      
                              html += '<div class="card">';
      
                              html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';
      
                              html += '<div class="card-body">';
      
                              for(var star = 1; star <= 5; star++)
                              {
                                  var class_name = '';
      
                                  if(data.review_data[count].rating >= star)
                                  {
                                      class_name = 'text-warning';
                                  }
                                  else
                                  {
                                      class_name = 'star-light';
                                  }
      
                                  html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                              }
      
                              html += '<br />';
      
                              html += data.review_data[count].user_review;
      
                              html += '</div>';
      
                              html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';
      
                              html += '</div>';
      
                              html += '</div>';
      
                              html += '</div>';
                          }
      
                          $('#review_content').html(html);
                      }
                  }
              })
          }
      
      });
      
      </script>

</body>

</html>