<?php 

	session_start();
	require("dbconnect.php");

	if (empty($_SESSION["id"])) {
		$user_id = mt_rand();
		$_SESSION["id"] = $user_id;
	}

	$works_sql = 'SELECT * FROM `works`';
	
	$works_data = array();
	$works_stmt = $dbh->prepare($works_sql);
	$works_stmt->execute($works_data);

	$my_works = array();
	$tmp_works = array();

	while (true) {
	    $works = $works_stmt->fetch(PDO::FETCH_ASSOC);

	    if ($works == false) {
	        break;
	    }
	
	    $tmp_works = $works;

		$like_sql ='SELECT COUNT(*) AS `like_cnt` FROM `likes` WHERE `works_id`=?';
		$like_data = array($tmp_works['id']);          
		$like_stmt = $dbh->prepare($like_sql);
		$like_stmt->execute($like_data);

		$like = $like_stmt->fetch(PDO::FETCH_ASSOC);
		$tmp_works['like_cnt'] = $like['like_cnt'];
	
		$like_flag_sql='SELECT count(*) as `like_flag` FROM `likes` WHERE `user_id`=? and `works_id`=?';
		$like_flag_data = array($_SESSION["id"],$tmp_works['id']);          
		$like_flag_stmt = $dbh->prepare($like_flag_sql);
		$like_flag_stmt->execute($like_flag_data);

		$like_flag=$like_flag_stmt->fetch(PDO::FETCH_ASSOC);

		if ($like_flag["like_flag"]>0) {
		  $tmp_works["like_flag"]=1;            
		}
		else{
		  $tmp_works["like_flag"]=0;
		}

		$my_works[] = $tmp_works;
	}
	
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>My Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<!-- <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon"> -->
	<!-- <link rel="icon" href="favicon.ico"> -->
	<link rel="icon" href="assets/images/favicons_basashi/favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="assets/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="assets/css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/my_style.css">
	<!-- fontawesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

	<!-- Modernizr JS -->
	<script src="assets/js/modernizr-2.6.2.min.js"></script>
	<!-- s<script src="js/svgxuse.js"></script> -->
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<div id="colorlib-page">
		<div class="container-wrap">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
			<div class="text-center">
				<div class="author-img" style="background-image: url(assets/images/前撮り_180407_0027.jpg);"></div>
				<h1 id="colorlib-logo"><a href="#">Mizuki Watanabe</a></h1>
				<span id="margin" class="position"><a href="#" class="original_a">Engineer</a> in Cebu/Japan</span>
				<span class="position"><a href="https://github.com/exchange-wata">https://github.com/exchange-wata</a></span>
			</div>
			<nav id="colorlib-main-menu" role="navigation" class="navbar">
				<div id="navbar" class="collapse">
					<ul>
						<li class="active"><a href="#" data-nav-section="home">Home</a></li>
						<li><a href="#" data-nav-section="about">About</a></li>
						<!-- <li><a href="#" data-nav-section="services">Services</a></li> -->
						<li><a href="#" data-nav-section="skills">Skills</a></li>
						<li><a href="#" data-nav-section="education">Education</a></li>
						<li><a href="#" data-nav-section="experience">Experience</a></li>
						<li><a href="#" data-nav-section="work">Work</a></li>
						<!-- <li><a href="#" data-nav-section="blog">Blog</a></li> -->
						<li><a href="#" data-nav-section="contact">Contact</a></li>
					</ul>
				</div>
			</nav>

			<div class="colorlib-footer">
				<p><small>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> </span> <span>Demo Images: <a href="https://unsplash.com/" target="_blank">Unsplash.com</a></span></small></p>
				<ul>
					<li><a href="#"><i class="icon-facebook2"></i></a></li>
					<li><a href="#"><i class="icon-twitter2"></i></a></li>
					<li><a href="#"><i class="icon-instagram"></i></a></li>
					<li><a href="#"><i class="icon-linkedin2"></i></a></li>
				</ul>
			</div>

		</aside>

		<div id="colorlib-main">
			<section id="colorlib-hero" class="js-fullheight" data-section="home">
				<div class="flexslider js-fullheight">
					<ul class="slides">
				   	<li style="background-image: url(assets/images/mizuki.jpg);">
				   		<div class="overlay"></div>
				   		<div class="container-fluid">
				   			<div class="row">
					   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 col-sm-12 col-xs-12 js-fullheight slider-text">
					   				<div class="slider-text-inner js-fullheight">
					   					<div class="desc">
					   						<h1>Hi! <br>I'm Mizuki.</h1>
						   					<!-- <h2>100% html5 bootstrap templates Made by <a href="https://colorlib.com/" target="_blank">colorlib.com</a></h2> -->
						   					<h2>Thank you for visiting my web site!</h2>
												<p><a class="btn btn-primary btn-learn" href="#about_me">About Me <i class="icon-download4"></i></a></p>
											</div>
					   				</div>
					   			</div>
					   		</div>
				   		</div>
				   	</li>
				   	<li style="background-image: url(assets/images/miuzki2.jpg);">
				   		<div class="overlay"></div>
				   		<div class="container-fluid">
				   			<div class="row">
					   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 col-sm-12 col-xs-12 js-fullheight slider-text">
					   				<div class="slider-text-inner">
					   					<div class="desc">
						   					<h1>I am <br>Japanese.</h1>
												<!-- <h2>100% html5 bootstrap templates Made by <a href="https://colorlib.com/" target="_blank">colorlib.com</a></h2> -->
												<h2>I am a pure Japanese. Please don't ask me, "Are you mixed?" Ha,Ha!!</h2>
												<p><a class="btn btn-primary btn-learn" href="#works">View Portfolio <i class="icon-briefcase3"></i></a></p>
											</div>
					   				</div>
					   			</div>
					   		</div>
				   		</div>
				   	</li>
				  	</ul>
			  	</div>
			</section>

			<section class="colorlib-about" data-section="about">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-12">
							<div class="row row-bottom-padded-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="col-md-12">
									<div class="about-desc">
										<span id="about_me" class="heading-meta">About Me</span>
										<h2 class="colorlib-heading">Who Am I?</h2>
										<p><strong>Hi I'm Mizuki Watanabe.</strong> <br>Thank you for coming to my site! You can see about me by scrolling. </p>
										<p>I am an assistant engineer at Nexseed in Cebu. I am going to support you. <br>I do my best that you will be a great enguneer!</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 animate-box" data-animate-effect="fadeInLeft">
									<div class="services color-1">
										<span class="icon2"><i class="icon-music2"></i></span>
										<!-- <span class="icon-piano"></span>
										<h3>Piano</h3> -->
										<!-- <span class="icons"><i class="icon-piano"></i></span> -->
										<!-- <svg class="icon_style">
											<use xlink:href="SVG/symbol-defs.svg#icon-piano"/>
										</svg> -->
										<h3>Piano</h3>
									</div>
								</div>
								<div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
									<div class="services color-2">
										<span class="icon2"><i class="icon-book2"></i></span>
										<h3>Books</h3>
									</div>
								</div>
								<div class="col-md-3 animate-box" data-animate-effect="fadeInTop">
									<div class="services color-3">
										<span class="icon2"><i class="icon-video3"></i></span>
										<h3>Movies</h3>
									</div>
								</div>
								<div class="col-md-3 animate-box" data-animate-effect="fadeInBottom">
									<div class="services color-4">
										<span class="icon2"><i class="icon-tv2"></i></span>
										<h3>Anime</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="colorlib-skills" data-section="skills">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">My Specialty</span>
							<h2 class="colorlib-heading animate-box">My Skills</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
							<p>My programming skills are improving now! I have studied these languages. I am good at using front-end languages.  However, I want to be able to use other languages. So I show my skills that I have touched in spite of being ashamed.</p>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
							<div class="progress-wrap">
								<h3>HTML3</h3>
								<div class="progress">
								 	<div class="progress-bar color-1" role="progressbar" aria-valuenow="75"
								  	aria-valuemin="0" aria-valuemax="100" style="width:85%">
								    <span>85%</span>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInRight">
							<div class="progress-wrap">
								<h3>jQuery</h3>
								<div class="progress">
								 	<div class="progress-bar color-2" role="progressbar" aria-valuenow="60"
								  	aria-valuemin="0" aria-valuemax="100" style="width:30%">
								    <span>30%</span>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
							<div class="progress-wrap">
								<h3>CSS3</h3>
								<div class="progress">
								 	<div class="progress-bar color-3" role="progressbar" aria-valuenow="85"
								  	aria-valuemin="0" aria-valuemax="100" style="width:85%">
								    <span>85%</span>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInRight">
							<div class="progress-wrap">
								<h3>PHP</h3>
								<div class="progress">
								 	<div class="progress-bar color-4" role="progressbar" aria-valuenow="90"
								  	aria-valuemin="0" aria-valuemax="100" style="width:40%">
								    <span>40%</span>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
							<div class="progress-wrap">
								<h3>Python</h3>
								<div class="progress">
								 	<div class="progress-bar color-5" role="progressbar" aria-valuenow="70"
								  	aria-valuemin="0" aria-valuemax="100" style="width:20%">
								    <span>20%</span>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInRight">
							<div class="progress-wrap">
								<h3>R</h3>
								<div class="progress">
								 	<div class="progress-bar color-6" role="progressbar" aria-valuenow="80"
								  	aria-valuemin="0" aria-valuemax="100" style="width:20%">
								    <span>20%</span>
								  	</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="colorlib-education" data-section="education">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Education</span>
							<h2 class="colorlib-heading animate-box">Education</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
							<div class="fancy-collapse-panel">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingOne">
									        <h4 class="panel-title">
									            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">elementary school
									            </a>
									        </h4>
									    </div>
									    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									         <div class="panel-body">
									            <div class="row">
										      		<div class="col-md-12">
										      			<!-- <p></p> -->
										      			<ul>
										      				<li>Futukaichi Higashi Elemenary School</li>
										      				<li>Futukaichi Elemenary School</li>
										      			</ul>
										      		</div>
										      		<!-- <div class="col-md-6">
										      			<p></p>
										      		</div> -->
										      	</div>
									         </div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingTwo">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">junior high school
									            </a>
									        </h4>
									    </div>
									    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									        <div class="panel-body">
									            <!-- <p><strong></strong></p> -->
													<ul>
														<li>Futukaichi Junior High School</li>
														<!-- <li></li> -->
													</ul>
									        </div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingThree">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">high school
									            </a>
									        </h4>
									    </div>
									    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
									        <div class="panel-body">
									            <ul>
									            	<li>Chikuyo Gakuen High School</li>
									            </ul>
									        </div>
									    </div>
									</div>

									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingFour">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">University
									            </a>
									        </h4>
									    </div>
									    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
									        <div class="panel-body">
									            <ul>
									            	<li>Tokyo Metropolitan University</li>
									            </ul>	
									        </div>
									    </div>
									</div>

									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingFive">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Study abroad
									            </a>
									        </h4>
									    </div>
									    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
									        <div class="panel-body">
									            <ul>
									            	<li>NexSeed</li>
									            </ul>	
									        </div>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="colorlib-experience" data-section="experience">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Experience</span>
							<h2 class="colorlib-heading animate-box">Work Experience</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
				         <div class="timeline-centered">
					         <article class="timeline-entry animate-box" data-animate-effect="fadeInLeft">
					            <div class="timeline-entry-inner">

					               <div class="timeline-icon color-1">
					                  <i class="icon-pen2"></i>
					               </div>

					               <div class="timeline-label">
					                  <h2>Front-End Engineer<span> 2018.4-2018.6</span></h2>
					                  <p>When I was a front-end engineer at Nexseed, I made this website with my teammate. You can see our work as clicking this URL!→<a href="http://localhost/PHILIALE/top2.php" target="_blank" class="url">http://localhost/PHILIALE/top2.php</a></p>
					               </div>
					            </div>
					         </article>


					         <article class="timeline-entry animate-box" data-animate-effect="fadeInRight">
					            <div class="timeline-entry-inner">
					               <div class="timeline-icon color-2">
					                  <i class="icon-pen2"></i>
					               </div>
					               <div class="timeline-label">
					               	<h2>Apprentice Engineer<span> 2018.7-</span></h2>
					                  <p>My adventure is going on...</p>
					               </div>
					            </div>
					         </article>

					         <article class="timeline-entry begin animate-box" data-animate-effect="fadeInBottom">
					            <div class="timeline-entry-inner">
					               <div class="timeline-icon color-none">
					               </div>
					            </div>
					         </article>
					      </div>
					   </div>
				   </div>
				</div>
			</section>

			<section class="colorlib-work" data-section="work">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span id="works" class="heading-meta">My Work</span>
							<h2 class="colorlib-heading animate-box">Recent Work</h2>
						</div>
					</div>
					<div class="row row-bottom-padded-sm animate-box" data-animate-effect="fadeInLeft">
						<div class="col-md-12">
							<p class="work-menu">
								<span>WebSite</span></p>
						</div>
					</div>
					<div class="row">

						<!-- foreach -->
						<?php foreach ($my_works as $work): ?>								
							<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
								<div class="project" style="background-image: url(assets/images/<?php echo $work["img"]; ?>);">
									<div class="desc">
										<div class="con">
											<h3><a href="work.html"><?php echo $work["name"]; ?></a></h3>
											<span>Website</span>
											<p class="icon">
												<span><a href="<?php echo $work["url"]; ?>" target="_blanck"><i class="icon-share3"></i></a></span>
												<!-- <span><a href="#"><i class="icon-eye"></i> 100</a></span> -->
												<!-- いいねされた時 -->
												<?php if ($work["like_flag"]==0){ ?>
												<span><a href="like.php?works_id=<?php echo $work["id"]; ?>"><i class="icon-heart"></i><?php echo $work["like_cnt"]; ?></a></span>
												<!-- いいねの取り消し -->
												<?php }else{?>
												<span><a href="unlike.php?works_id=<?php echo $work["id"]; ?>"><i class="icon-heart"></i><?php echo $work["like_cnt"]; ?></a></span>
												<?php }?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
						<!-- foreachここまで -->

					</div>
					<div class="row">
						<div class="col-md-12 animate-box">
							<p><a href="add_works.php" class="btn btn-primary btn-lg btn-load-more" target="_blanck">Coming Soon.... <i class="icon-reload"></i></a></p>
						</div>
					</div>
				</div>
			</section>

			
			<section class="colorlib-contact" data-section="contact">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Get in Touch</span>
							<h2 class="colorlib-heading">Contact</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="colorlib-icon">
									<i class="icon-social-twitter"></i>
								</div>
								<div class="colorlib-text">
									<p><a href="https://twitter.com/zweim7" target="_blank">follow me!</a></p>
								</div>
							</div>

							<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="colorlib-icon">
									<i class="icon-social-facebook"></i>
								</div>
								<div class="colorlib-text">
									<p><a href="https://www.facebook.com/profile.php" target="_blanck">follow me!</a></p>
								</div>
							</div>

							<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="colorlib-icon">
									<i class="icon-social-github"></i>
								</div>
								<div class="colorlib-text">
									<p><a href="https://github.com/exchange-wata">follow me!</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-7 col-md-push-1">
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-md-pull-1 animate-box" data-animate-effect="fadeInRight">
									<form action="">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Name">
										</div>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Email">
										</div>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Subject">
										</div>
										<div class="form-group">
											<textarea name="" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-primary btn-send-message" value="Send Message">
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</section>

		</div><!-- end:colorlib-main -->
	</div><!-- end:container-wrap -->
	</div><!-- end:colorlib-page -->

	<!-- jQuery -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="assets/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="assets/js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="assets/js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- Counters -->
	<script src="assets/js/jquery.countTo.js"></script>
	
	
	<!-- MAIN JS -->
	<script src="assets/js/main.js"></script>

	</body>
</html>

