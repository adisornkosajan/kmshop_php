<div class="jumbotron p-3 mb-2 text-center">
	<h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
	<h6 class="lead"><b>Delivery Charge : </b>Free</h6>
	<h5><b>Total Amount Payable : </b><?= number_format($grand_total, 2) ?>/-</h5>
</div>








class="term" style="background-color:#4A148C"

INSERT INTO product(product_name, category, product_price, product_image,description) VALUES("1", "6", "200", "221325.jpg", "asd")





$countsql = $conn->prepare('SELECT COUNT(id) from product');
       $countsql->execute();
       $row1 = $countsql->fetch();
       $numrecords =  $row1[0];
       @$page = $_GET["page"];
       $numperpage = 4;
       $start = $page * $numperpage;
       $numlinks = ceil($numrecords/$numperpage);


	   $countsql = $conn->prepare('SELECT COUNT(id) as cpt from product');
      $countsql->setFetchMode(PDO::FETCH_ASSOC);
      $countsql->execute();
      $tcount = $countsql->fetchAll();
      @$page=$GET["page"];
      $nbr_elements_par_page=5;
      $nbr_de_pages=ceil($tcount[0]["cpt"]/$nbr_elements_par_page);
      $debut=($page-1)*$nbr_elements_par_page;

	  @$page=$_GET["page"];
      $nbr_elements_par_page=4;
      $nbr_de_pages=ceil($tcount[0]["cpt"]/$nbr_elements_par_page);
      $debut=($page-1)*$nbr_elements_par_page;





	  $count = $conn->prepare('SELECT COUNT(id) as cpt from product');
      $count->setFetchMode(PDO::FETCH_ASSOC);
      $count->execute();
      $tcount = $count->fetchAll();

      @$page=$_GET["page"];
      $nbr_elements_par_page=8;
      $nbr_de_pages=ceil($tcount[0]["cpt"]/$nbr_elements_par_page);
      $debut=($page-1)*$nbr_elements_par_page;



<section class="ftco-section">
	<div class="container">
		<div class="row">

			<div class="col-lg-6 mb-5 ftco-animate">
				<a href="images/product-1.jpg" class="image-popup"><img src="images/product-1.jpg" class="img-fluid" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3>Bell Pepper</h3>
				<div class="rating d-flex">
					<p class="text-left mr-4">
						<a href="#" class="mr-2">5.0</a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
					</p>
					<p class="text-left mr-4">
						<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
					</p>
					<p class="text-left">
						<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
					</p>
				</div>
				<p class="price"><span>$120.00</span></p>
				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until.
				</p>
			</div>
			<p><a href="cart.html" class="btn btn-black py-3 px-5">Add to Cart</a></p>
		</div>
	</div>
</section>