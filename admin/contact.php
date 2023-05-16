<?php

session_start();

require_once "config/connection.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $urole = $_POST['urole'];

    $sql = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname,email= :email,phone= :phone,address= :address,urole=:urole WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":firstname", $firstname);
    $sql->bindParam(":lastname", $lastname);
    $sql->bindParam(":email", $email);
    $sql->bindParam(":phone", $phone);
    $sql->bindParam(":address", $address);
    $sql->bindParam(":urole", $urole);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been updated successfully";
        header("location: admin_user.php");
    } else {
        $_SESSION['error'] = "Data has not been updated successfully";
        header("location: Proflie.php");
    }
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

    <title>คะแนนรีวิว</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php
    include 'admin_head.php';
    include 'admin_nva.php';


    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">คะแนนรีวิว</h1>
    <div class="info bg-white p-1">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4 text-center">
                <h1 class="text-warning mt-2 mb-4">
                  <b><span id="average_rating">0.0</span> / 5</b>
                </h1>
                <div class="mb-3">
                  <i class="fas fa-star star-light mr-1 main_star"></i>
                  <i class="fas fa-star star-light mr-1 main_star"></i>
                  <i class="fas fa-star star-light mr-1 main_star"></i>
                  <i class="fas fa-star star-light mr-1 main_star"></i>
                  <i class="fas fa-star star-light mr-1 main_star"></i>
                </div>
                <h3><span id="total_review">0</span> Review</h3>
              </div>
              <div class="col-sm-4">
                <p>
                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                </div>
                </p>
                <p>
                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                </div>
                </p>
                <p>
                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                </div>
                </p>
                <p>
                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                </div>
                </p>
                <p>
                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                </div>
                </p>
              </div>
             
            </div>
          </div>
        </div>
        <div class="mt-5" id="review_content"></div>
      </div>
    </div>
  	</div>
</div>

  </section>
   
   

    </div>
    <!-- End of Page Wrapper -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
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