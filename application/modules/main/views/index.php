<!-- type of service start here -->
<!-- <div class="container-fluid c-service-home" style="background: #FF0000;"> -->
<div class="container-fluid c-service-home">

		<!-- row content start here -->
		<div class="row" style="margin-bottom:50px;">
			<!-- title start here -->
			<div class="col-lg-12">
				<h3 class="o-title text-center">
					our type of services
				</h3>
			</div>
			<!-- title end here -->
			<!-- card Looping start here -->
			<?php
				if(isset($our_services) && $our_services != null) {
					foreach ($our_services as $key => $value) {
						echo '<div class="col-lg-4 col-md-4 d-flex justify-content-center text-center">';
						echo '<div class="card c-card">';
						echo '<div class="card-body">';
						echo '<i class="fas fa-suitcase"></i>';
						echo '<h5 class="card-title">' . $value->art_title. '</h5>';
						echo '<p class="card-text">';
						echo character_limiter(strip_tags($value->art_content), 250);
						echo '<br /><br /><a href="' . base_url() . 'articles/read/' . $value->art_slug. '" class="btn btn-link stretched-link">lihat detail</a>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
				}
			?>
			<!-- card end end here -->
		</div>
		<!-- row content end here -->

		<!-- bg here -->
		<div class="bg"></div>
<!-- bg here -->

</div>
<!-- type of service end here -->

<!-- tour packages start here -->
<div class="container-fluid c-tour-pkg">
<div class="c-content">
	<div class="row no-gutters">

		<!-- Tour Description start here -->
		<div class="col-lg-4 c-description">
			<h2>
				Tour Packages
			</h2>
			<p>
				<?php echo $app_home->desc_section1; ?>
			</p>
			<a href="<?php echo $app_home->link_section1; ?>" class="btn btn-outline-success btn--primary d-block" style="letter-spacing:2px; ">See More Packages</a>
		</div>
		<!-- Tour Description end here -->

		<!-- Tour Slider start here -->
		<div class="col-lg-8">

			<!-- Carousel start here -->
			<div class="c-product-carousel swiper-container">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<?php
						if(isset($tour_packages) && $tour_packages != null) {
							foreach ($tour_packages as $key => $value) {
					?>
					
					<div class="swiper-slide">
						<div class="col">
							<div class="card c-card-product">
								<img src="<?php echo $theme_assets . 'img/dest--2.jpg'; ?>" class="card-img-top" alt="card image">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $value->prod_name; ?>
									</h5>
									<p class="card-text text-capitalize">
										<span class="c-card-date mt-2 mb-2">
											<i class="far fa-calendar-alt pr-2"></i>
											<?php echo $value->prod_duration_day; ?> Days <?php echo $value->prod_duration_night; ?> Night
										</span>
										<span class="c-card-dest">
											<i class="fas fa-map-marker-alt pr-2"></i>
											<?php echo $value->prod_location; ?>
										</span>
									</p>
									<a href="<?php echo base_url('catalogs/product/' . $value->id); ?>" class="btn btn-primary btn-block btn--primary">
										packages detail
									</a>
								</div>
							</div>
						</div>
					</div>
					
					<?php			
							}
						}
					?>
					<!-- Slides -->

				</div>
			</div>
			<!-- Carousel end here -->

		</div>
		<!-- Tour Slider start here -->

	</div>
</div>
</div>
<!-- tour packages end here -->

<!-- destination start here -->
<div class="container-fluid c-destination d-flex align-items-center">
<div class="bg">
	<div class="c-content">
		<div class="row">
			<!-- destination card start here -->
			<div class="col-lg-8 order-2 order-lg-1">
				<div class="row">
					<?php
						if(isset($ourdestination) && $ourdestination != null) {
							foreach ($ourdestination as $key => $value) {
								echo 'Our Destinations';
							}
						}
					?>
					<!-- card #1 start here -->
					<!-- <div class="col-lg-6 col-md-6"> -->
						<!-- card content #1 start here -->
						<!-- <div class="card text-white c-card-destination">
							<img src="<?php // echo $theme_assets . 'img/dest--1.jpg'; ?>" class="card-img img-fluid" alt="background-image">
							<div class="overlay"></div>
							<div class="card-img-overlay">
								<h5 class="card-title">surakarta</h5>
								<p class="card-text">
									20 Tour Packages at this destination</p>
								<a href="/destination-detail.html" class="btn btn-link stretched-link">lihat detail</a>
							</div>
						</div> -->
						<!-- card content #1 end here -->
					<!-- </div> -->
					<!-- card #1 end here -->


				</div>
			</div>
			<!-- destination card end here -->
			<!-- destination description start here -->
			<div class="col-lg-4 c-description text-center">
				<h2>
					our destination
				</h2>
				<?php echo $app_home->desc_section2; ?>
				<a href="<?php echo $app_home->link_section2; ?>" class="btn btn-outline-success btn--secondary" style="letter-spacing:2px; width:80%;">More destination</a>
			</div>
			<!-- destination description end here -->
		</div>
	</div>
</div>
</div>
<!-- destination end here -->

<!-- Mice packages start here -->
<div class="container-fluid c-mice-pkg">
<div class="c-content">
	<div class="row no-gutters">

		<!-- mice Description start here -->
		<div class="col-lg-4 c-description">
			<h2>
				mice Packages
			</h2>
			<p>
			<?php echo $app_home->desc_section3; ?>
			</p>
			<a href="<?php echo $app_home->link_section3; ?>" class="btn btn-outline-success btn--primary d-block" style="letter-spacing:2px; ">See More Packages</a>
		</div>
		<!-- mice Description end here -->

		<!-- mice Slider start here -->
		<div class="col-lg-8">

			<!-- Carousel start here -->
			<div class="c-product-carousel swiper-container">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<?php
						if(isset($micepakcages) && $micepakcages != null) {
							foreach ($micepakcages as $key => $value) {
								echo 'Mice Pacakges';
							}
						}
					?>
					<!-- Slides -->
					<!-- <div class="swiper-slide"> -->
						<!--carousel card #1 start here-->
						<!-- <div class="col">
							<div class="card c-card-img">
								<img src="<?php //echo $theme_assets . 'img/bg--6.jpg'; ?>" class="card-img-top" alt="card image" style="z-index:0;">
								<span class="o-title">
									Event Name #1
								</span>
								<a href="/product-detail.html" class="btn btn-primary btn-block btn--primary">
									packages detail
								</a>
							</div>
						</div> -->
						<!-- carousel card #1 end here-->
					<!-- </div> -->
				</div>
			</div>
			<!-- Carousel end here -->

		</div>
		<!-- mice Slider start here -->

	</div>
</div>
</div>
<!-- Mice packages end here -->

<!-- Recent works start here -->
<div class="container-fluid c-recent-works" style="padding:0;">
<div class="row no-gutters">
	<!-- Recent work wording start here -->
	<div class="col-lg-4 c-wording d-flex align-items-center justify-content-center">
		<div>
			<h5>our recent works</h5>
			<?php echo $app_home->desc_section4; ?>
			<a href="<?php echo $app_home->desc_section4; ?>" class="btn btn-primary btn-block btn--secondary">
				see more
			</a>
		</div>
	</div>
	<!-- Recent work wording end here -->
	<div class="col-lg-8">
		<div class="row no-gutters">
			<?php
				if(isset($recentworks) && $recentworks != null) {
					foreach ($recentworks as $key => $value) {
						echo 'Mice Pacakges';
					}
				}
			?>
			<!-- Recent work content start here -->
			<!-- <div class="col-lg-4 c-img">
				<div class="card text-white">
					<img src="<?php // echo $theme_assets . 'img/bg--6.jpg'; ?>" class="card-img" alt="recent works image">
					<div class="overlay card-img-overlay text-left">
						<div class="c-content">
							<h5 class="card-title">Event Name #1</h5>
							<a href="#" class="btn btn-link stretched-link">lihat detail</a>
						</div>
					</div>
				</div>
			</div> -->
			<!-- Recent work content end here -->
			
		</div>
	</div>
</div>
</div>
<!-- Recent works end here -->