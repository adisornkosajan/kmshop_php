<?php
	require 'config/config.php';

	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['total_price'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);

  
?>
<head>
    <title>สถานะการจัดส่ง</title>
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
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="goto-here">
<?php include 'index_nva.php';
      include 'pd.php'
;
?>
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">ให้คะแนนรีวิวกับพวกเรา</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
              <?php
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
							?>
                            <?php 
                            
                    $id = $_GET['id'];

                    ?>
              <input type="hidden" name="user_name" id="user_name" value="<?= $firstname . ' ' . $lastname; ?>">
              <input type="hidden" name="id" id="id" value="<?= $id; ?>">
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
                <input type="text" readonly value="<?php echo $id; ?>" class="form-control" placeholder="">
            <input type="text" readonly value="<?php echo $row['firstname']. ' ' .$row['lastname']; ?>" class="form-control" placeholder="">
	        	</div>
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review" onclick='javascript:location.reload()'>Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>


<div class="overlay" id="divOne">
    <?php 
    $id = $_GET['id'];
    ?>

        <div class="wrapper">
        <center> <h2>แจ้งเหตุที่ต้องการเคลมสินค้า</h2><a class="close" href="#">&times;</a>  </center>   </body> 
                <div class="container">
                    <form action="action2.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                    <input type="hidden" readonly value="<?= $id = $_GET['id'];  ?>" class="form-control" placeholder="">
                    
                    <div class="col-sm-9">
                            <label for="img" class="col-form-label">รูปภาพ:</label>
                            <input type="file"  id="imgInput" name="can_img">
                            <img loading="lazy" width="50%" id="previewImg" alt="">
                        </div>
                    <p><b>เหตุผล</b></p>
                        <div class="form-group text-center">
                            <div class="col-sm-12">
                                <textarea id="editor1" name="petition" rows="10" cols="60" required></textarea>
                            </div>
                        </div>
                        <span style="color:red">
                        ** <span class="SpanAccountNo">สินค้าถึงลูกค้าแล้วต้องอัดวิดีโอก่อนเปิดสินค้าเท่านั้นเพื่อรักษาสิทธิ์ ลูกค้าหากไม่มีวิดีโอยืนยันทางร้านขอไม่รับผิดชอบทุกกรณี</span>
                        </span>
                        
                        <div class="form-group text-center">
                            <div class="col-md-12 mt-3">
                                <input type="submit" name="btn_insert" class="btn btn-success" value="เคลม" onclick='javascript:location.reload()'>
                                </div>
                        </div>
                       
                    </form>
                </div>
        </div>
    </div>

    <div class="overlay" id="divOne1">
    <?php 
    $id = $_GET['id'];
    ?>
        <div class="wrapper">
        <center> <h2>แจ้งเหตุที่ต้องการยกเลิกสินค้า</h2><a class="close" href="#">&times;</a>  </center>   </body> 
        
                <div class="container">
                    <form action="action1.php" method="post">

                    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                    <input type="hidden" readonly value="<?= $id = $_GET['id'];  ?>" class="form-control" placeholder="">
                    <p><b>เหตุผล</b></p>
                        <div class="form-group text-center">

                                <textarea id="editor1" name="petition" rows="10" cols="60" required></textarea>


                        </div>
                        <div class="form-group text-center">
                            <div class="col-md-12 mt-3">
                                <input type="submit" name="btn_insert" class="btn btn-success" value="ยกเลิก" onclick='javascript:location.reload()'>
                                </div>
                        </div>
                    </form>
                </div>

        </div>
    </div>



























    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>
  
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
	<script type="text/javascript"></script>

  <script>
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
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

              var id = $('#id').val();
      
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
                      data:{rating_data:rating_data, user_name:user_name, user_review:user_review,id:id},
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