<!DOCTYPE html>
<html lang="en">

<head>
  <title>การให้คะแนน</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="goto-here" style="background-color:#F1FCED;">
  <?php include 'index_nva.php';

  ?>


  <div class="hero-wrap hero-bread" style="background-image: url('images/tt83.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h3 class="mb-2 bread" style="color:white" >คะแนน รีวิวจากลูกค้า</h3>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section contact-section bg-light">
    <div class="info bg-white p-1">
      <div class="container" width="10px" height="48px">
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
    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
            div>
              <?php
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
							?>
              <input type="hidden" name="user_name" id="user_name" value="<?= $firstname . ' ' . $lastname; ?>">
	      	</div>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-4">
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
	        	<div class="form-group">
            <input type="text" readonly value="<?php echo $row['firstname']. ' ' .$row['lastname']; ?>" class="form-control" placeholder="">
	        	</div>
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>

  </section>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <style>
      
      .progress-label-left
      {
          float: left;
          margin-right: 0.5em;
          line-height: 1em;
      }
      .progress-label-right
      {
          float: right;
          margin-left: 0.3em;
          line-height: 1em;
      }
      .star-light
      {
        color:#e9ecef;
      }
      </style>
      
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