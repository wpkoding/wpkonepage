<!DOCTYPE html>
<html>
<head>
<?php wp_head(); ?>
</head>
<body>
	<div id="site-cover">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="cover-text">
						<h2>LET'S</h2>
						<p>Make Something Awesome</p>
					</div>
					<div id="cover-btn">
						<a href="#navigation" class="btn btn-outline-light">
			                <i class="fa fa-angle-down"></i>
			            </a>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<header id="site-header">
		<nav id="navigation" class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="wpk">wpk</span>onepage</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<?php
					if ( has_nav_menu( 'top' ) ) :

						$args = array(
							'theme_location'	=> 'top',
							'menu_id'			=> 'top-menu',
							'menu_class'		=> 'navbar-nav mr-auto',
							'container'			=> '',
							'walker'			=> new bs4Navwalker(),
						);
						wp_nav_menu($args);
					
					else : ?>

						<ul class="navbar-nav mr-auto">
							<li class="nav-item">
								<a class="nav-link" href="#about-us">About Us</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#services">Services</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#our-works">Our Works</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#contact">Contact</a>
							</li>
						</ul>

					<?php
					endif; 
					?>
					<a class="nav-link call" href="tel:+6281111111111">
						<span class="call-label">Call Us Now: </span>
						<i class="fa fa-phone fa-flip-horizontal"></i>
						<span class="call-number">+6281111111111<span>
					</a>
				</div>
			</div>
		</nav>
	</header>