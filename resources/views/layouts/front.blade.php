<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>{{ $page_title }}</title>
	<link rel="shortcut icon" href="{{ url('/img/gbdoelogo.png') }}">
	<meta name="description" content="The Directorate of Education (Colleges) Gilgit Balistan is attached Department, facilitating and supervising the College/Higher level Education in Gilgit-Baltistan. Besides this, Directorate of Education (Colleges) is dealing with disbursement of stipend to the students of GB and merit scholarships to the students of GB studying in professional institutions of the country. The DoE (colleges) also deals with the nomination of about 800 reserved seats for Gilgit-Baltistan in different institution of the country.">
	<meta name="author" content="Directorate of Education (Colleges) Gilgit Balistan">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Built In Css Includes -->

	<link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap3.0.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/slick.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/slick-theme.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/jquery-ui.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/jquery.lighter.css') }}">

	<!-- Custom Css Files Included -->

	<link rel="stylesheet" media="(min-width: 1200px)" href="{{ url('/css/desktop_screen.css') }}">
	<link rel="stylesheet" media="(min-width : 960px) and (max-width : 1200px)" href="{{ url('/css/wider_tablet_screen.css') }}">
	<link rel="stylesheet" media="(min-width : 768px) and (max-width : 960px)" href="{{ url('/css/tablet_screen.css') }}">
	<link rel="stylesheet" media="(min-width : 480px) and (max-width : 768px)" href="{{ url('/css/htc_mot_screen.css') }}">
	<link rel="stylesheet" media="(min-width : 320px) and (max-width : 480px)" href="{{ url('/css/smartphone_screen.css') }}">
	<link rel="stylesheet" media="(max-width: 320px)" href="{{ url('/css/small_screen.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">

</head>

<body>
	<div class="wrapper font-family-texgyread">

		<section class="top">
			<div class="jumbotron top_header">
				<div class="container subwrapper">
					<div class="pull-left">	
						<p>
							<span class="item dd-font-size">
								<span class="glyphicon glyphicon-earphone golden-color"></span> +92-5811-960001/960091
							</span>
							<span class="item dd-font-size">
								<span class="glyphicon glyphicon-envelope golden-color"></span><a href="mailto:doec.emis@gmail.com"> doec.emis@gmail.com</a>
							</span>
						</p>
					</div>
					<div class="pull-right">
						<p class="header_social_icons">
							<a href="mailto:doec.emis@gmail.com"><i class="fa fa-envelope social_icons"></i></a>
							<a href="https://www.facebook.com/doecgb.edu.pk/" target="_blank"><i class="fa fa-facebook social_icons"></i></a>
							<a href="#" target="_blank"><i class="fa fa-twitter social_icons"></i></a>
							<a href="#" target="_blank"><i class="fa fa-linkedin social_icons"></i></a>
							<i id="search_expander_btn" class="fa fa-search social_icons"></i>
						</p>
						<form id="search_form" action="#" method="get" class="search_form hidden">
							<div class="input-group">
							  	<input type="text" class="" placeholder="Search" aria-describedby="basic-addon2" required="" pattern=".{5,}" title="5 characters minimum">
							  	<span class="input-group-addon" id="basic-addon2"><button class="search_form_submit_btn" type="submit"><i class="fa fa-search frmBtn_social_icons"></i></button></span>
							</div>
						</form>
						<p class="header_social_icons">
							<a class="log_btns font-weight-bold" href="{{ url('users/login') }}">Login</a><span class="log_btns2"> | </span> 
							<a class="log_btns font-weight-bold" href="{{ url('users/register') }}">Register</a>
						</p>
					</div>
				</div>
			</div>
		</section>
		    
		<!--=========MIDDEL-TOP_BAR============-->
		<!--Begin Fixed Header-->
		<section id="bottom_fixed_header" class="bottom">    
		    <div class="middleBar">
			    <div class="container">
				  <div class="row display-table">
				    <div class="col-sm-2 vertical-align text-left hidden-xs">
				      <a href="javascript:void(0);"> <img class="img img-responsive float-right  height-100" width="" src="{{ url('/img/gbdoelogo.png') }}" alt=""></a>
				    </div>
				    <!-- end col -->
				    <div class="col-sm-10 vertical-align">
				    	<h1 class="top-head-h1">Directorate of Education Colleges Gilgit-Baltistan</h1>     
				    </div>
				    <!-- end col -->
				    <!-- end col -->
				  </div>
				  <!-- end  row -->
				</div>
			</div>
		</section>
		<!--End Fixed Header-->
		    

		<nav class="navbar navbar-main navbar-default custom_default_border" role="navigation" style="opacity: 1;">
		          <div class="container">
		            <!-- Brand and toggle -->
		            <div class="navbar-header">
		              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		              </button>             
		            </div>
		        
		            <!-- Collect the nav links,  -->
		            <div class="collapse navbar-collapse navbar-1 custom-nav-bar-2" style="margin-top: 0px;">            
		              <ul class="nav navbar-nav">
		                <li class="{{$selected_main_menu == 'home_page' ? 'active-button-mid':'' }}"><a href="{{ url('/') }}" class="dropdown-toggle">Home</a></li>
		                <li class="{{$selected_main_menu == 'institutions_page' ? 'active-button-mid':'' }}"><a href="{{ url('/institutions') }}" class="dropdown-toggle">Institutions</a></li>
		                <li class="dropdown megaDropMenu {{$selected_main_menu == 'nominations_page' ? 'active-button-mid':'' }}">
		                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">Nominations <i class="fa fa-angle-down ml-5"></i></a>
		                  <ul class="dropdown-menu row custom-top-border-dropdown">
		                    <li class="col-sm-3 col-xs-12">
		                      <ul class="list-unstyled">
		                        <li>Medical Nominations</li>
		                        <li><a href="{{ url('/nominations/medical/universitiesandcourses') }}">Universities & Courses</a></li>
		                        <li><a href="{{ url('/nominations/medical/seatsdistributions') }}">Seats Distributions</a></li>
		                        <li><a href="{{ url('/nominations/medical/criteria') }}">Criteria</a></li>
		                     </ul>
		                    </li>
		                    <li class="col-sm-3 col-xs-12">
		                      <ul class="list-unstyled">
		                        <li>Engineering Nominations</li>
		                        <li><a href="{{ url('/nominations/engineering/universitiesandcourses') }}">Universities & Courses</a></li>
		                        <li><a href="{{ url('/nominations/engineering/seatsdistributions') }}">Seats Distributions</a></li>
		                        <li><a href="{{ url('/nominations/engineering/criteria') }}">Criteria</a></li>
		                       </ul>
		                    </li>
		                    <li class="col-sm-3 col-xs-12">
		                      <ul class="list-unstyled">
		                        <li>General Nominations</li>
		                        <li><a href="{{ url('/nominations/general/universitiesandcourses') }}">Universities & Courses</a></li>
		                        <li><a href="{{ url('/nominations/general/seatsdistributions') }}">Seats Distributions</a></li>
		                        <li><a href="{{ url('/nominations/general/criteria') }}">Criteria</a></li>
		                     </ul>
		                    </li>
		                    <li class="col-sm-3 col-xs-12">
		                        <ul class="list-unstyled">
			                        <li>DVM, D-Pharm & Agriculture Nominations</li>
			                        <li><a href="{{ url('/nominations/dvm-dpt-bs-agriculture-d-pharmacy/universitiesandcourses') }}">Universities & Courses</a></li>
			                        <li><a href="{{ url('/nominations/dvm-dpt-bs-agriculture-d-pharmacy/seatsdistributions') }}">Seats Distributions</a></li>
			                        <li><a href="{{ url('/nominations/dvm-dpt-bs-agriculture-d-pharmacy/criteria') }}">Criteria</a></li>
			                     </ul>
		                    </li>
		                    <li class="col-lg-12">
		                    	<ul class="list-unstyled">
				                  	<li style="padding-top:5px;padding-bottom: 10px;"><a style="color:#338041;border: 1px solid #ccc;border-radius: 7px;text-transform: none;" class="text-center" href="{{ url('/nominations/seeall') }}">See All</a></li>
				                 </ul>
		                    </li>
		                  </ul>
		                </li>
		                <li class="dropdown {{$selected_main_menu == 'scholarship_page' ? 'active-button-mid':'' }}">
		                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">Scholarships <i class="fa fa-angle-down ml-5"></i></a>
		                  <ul class="dropdown-menu dropdown-menu-left custom-top-border-dropdown">
		                    <li><a href="{{ url('/scholarships/stipend') }}">Stipend</a></li>
		                    <li><a href="{{ url('/scholarships/meritscholarship') }}">Merit Scholarships</a></li>
		                  </ul>
		                </li>
		                <li class="{{$selected_main_menu == 'aboutus_page' ? 'active-button-mid':'' }}"><a href="{{ url('/aboutus') }}" class="dropdown-toggle">About Us</a></li>
		                <li class="{{$selected_main_menu == 'contactus_page' ? 'active-button-mid':'' }}"><a href="{{ url('/contactus') }}" class="dropdown-toggle">Contact Us</a></li>
		                <li class="{{$selected_main_menu == 'newsandnotices_page' ? 'active-button-mid':'' }}"><a href="{{ url('/newsandnotices') }}" class="dropdown-toggle">News & Notices</a></li>
		                <li class="{{$selected_main_menu == 'sitedownloads_page' ? 'active-button-mid':'' }}"><a href="{{ url('/sitedownloads') }}" class="dropdown-toggle">Downloads</a></li>
		              </ul>
		            </div><!-- /.navbar-collapse -->
		          </div>
        </nav>

		<section class="main_content_container">
			@yield('content')
		</section>

		<!-- Complete Footer -->

		<footer class="site_footer">
			<section class="main_footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
							<h4 class="footer_left_headings">Help</h4>
							<ul class="footer_stacked_ul">
								<li><a class="footer_links">Admissions</a></li>
								<li><a class="footer_links">Nominations</a></li>
								<li><a class="footer_links">Colleges & Universities</a></li>
								<li><a class="footer_links">FAQ</a></li>
								<li><a class="footer_links">Privacy Policy</a></li>
								<li><a class="footer_links">Terms and Usage</a></li>
							</ul>
							<h4 class="footer_left_headings">Quick Links</h4>
							<ul class="footer_stacked_ul">
								<li><a class="footer_links">Contact Us</a></li>
								<li><a class="footer_links">What's Going On</a></li>
								<li><a class="footer_links">About Us</a></li>
								<li><a class="footer_links">Application Tracking</a></li>
								<li><a class="footer_links">Sitemap</a></li>
							</ul>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-4 hidden-xs">
							<h4 class="footer_left_headings">About DOEC,GB</h4>
							<p class="footer-link">
								The Directorate of Education (Colleges) Gilgit Balistan is attached Department, facilitating and supervising the College/Higher level Education in Gilgit-Baltistan. Besides this, Directorate of Education (Colleges) is dealing with disbursement of stipend to the students of GB and merit scholarships to the students of GB studying in professional institutions of the country. The DoE (colleges) also deals with the nomination of about 800 reserved seats for Gilgit-Baltistan in different institution of the country.
							</p>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
							<h3>Social Network</h3>
							<p>Find us and like, follow and watch us for latest</p>
							<div class="social_symbols_container">
								<div class="upper_btns_container">
									<a class="sym_social_fb" target="_blank" href="#"></a>
									<a class="sym_social_twt" target="_blank" href="#"></a>
									<a class="sym_social_in" target="_blank" href="#"></a>
								</div>
								<div class="lower_btn_container">
									<a class="sym_social_ytb" target="_blank" href="#"></a>
									<a class="sym_social_gpls" target="_blank" href="#"></a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h3>Newsletter</h3>
							<p>Fill in the email field given below to subscribe to our news letter to remain informed about new admissions, nominations and scholarships.</p>
							<br>
							<div class="email_box_container">
								<div class="text_box_container">
									<form class="validator_form" action="" method="get">
										<input id="subscriber_email" name="email" value="" class="email_input" type="email" class="pull-left" placeholder="Email Address" autocomplete="off" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
										<a href="" class="button_container pull-right">
											<button type="submit" class="btn_text validator_submitBtn">Go</button>
										</a>
									</form>
								</div>
							</div>
							<br>
							<h3>Get Started</h3>
							<p>Please select from the below given links to proceed.</p>
							<div class="users_actions_container">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding-left-0">
									<a class="btn btn-block btn-primary font-size-incr" href="{{ url('users/login') }}"><span class="fa fa-lock"></span>&nbsp;Login</a>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddding-right-0">
									<a class="btn btn-block btn-success font-size-incr" href="{{ url('users/register') }}"><span class="fa fa-users"></span>&nbsp;Register</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="bottom_most_footer hidden-sm hidden-xs">
				<div class="container">
					<div class="left_nav_items pull-left color-fff">
						<a href="">About Us </a> |
						<a href="">Terms of Use </a> |
						<a href="">Privacy Policy </a> |
						<a href="">Contact Us </a>
					</div>
					<div class="right_nav_items pull-right">
						<p>DOEC, GB © 2009 All Rights are reserved</p>
					</div>
				</div>
			</section>
			<section class="footer_powered">
				<div class="container">
					<div class="right_nav_items">
						<p class="text-center color-000">Powered By <a href="#">Highlander Connection ©</a> Heli Chowk, Near FCNA HQ, Jutial Gilgit</p>
					</div>
				</div>
			</section>
		</footer>

	</div>

	<script type="text/javascript" src="{{ url('/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('/js/jquery-migrate.js') }}"></script>
	<script type="text/javascript" src="{{ url('/js/bootstrap3.0.js') }}"></script>
	<script type="text/javascript" src="{{ url('/js/slick.js') }}"></script>
	<script type="text/javascript" src="{{ url('/js/jquery-ui.js') }}"></script>
	<script type="text/javascript" src="{{ url('/js/jquery.lighter.js') }}"></script>

	<script type="text/javascript" src="{{ url('/js/custom.js') }}"></script>

</body>
</html>