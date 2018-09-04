<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package carousel-post
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'carousel-post' ); ?></a>

	<header id="masthead" class="site-header">
		<nav class="navbar navbar-expand-md navbar-dark  nav_bg " style="	">
			<div class="container" >


			<div class="site-branding navbar-brand">

				<!--   output the custom logo when site title and site description is not active-->
				<?php
		    if( get_custom_logo() ) {
		        the_custom_logo();
		    } elseif ( is_front_page() || is_home() ) { ?>

		        <h1 class="site-title">
		            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		        </h1>
		        <?php
		        $description = get_bloginfo( 'description', 'display' );
		    } else {?>

		        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		        <?php
		        $description = get_bloginfo( 'description', 'display' );
		    }

		    if ( ( isset($description) && $description) || is_customize_preview() ) {
		        ?>
		        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		        <?php
		    }
				?>




			</div><!-- .site-branding -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

				<?php
				 wp_nav_menu( array(
			 'theme_location'  => 'menu-1',
			 'depth'	         => 2, // 1 = no dropdowns, 2 = with dropdowns.
			 'container'       => 'div',
			 'container_class' => 'collapse navbar-collapse',
			 'container_id'    => 'navbarCollapse',
			 'menu_class'      => 'navbar-nav ml-auto',
			 'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			 'walker'          => new WP_Bootstrap_Navwalker(),
				) );
				?>

			</div>
	</nav>

						<!--   output the carousel csutom post type only in the front page-->
		<?php
		if (is_front_page()){ ?>

			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">

						<!--   output li indicators with the custom post-->
					<?php

						$indicator_object= new WP_Query(array(

							'post_type' => 'carouselslider'
						));

						$indicator_var= -1;

						while ($indicator_object->have_posts()){
							$indicator_object->the_post(); $indicator_var ++ ?>

								<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $indicator_var; ?>" class="active"></li>

						<?php }

					?>


				</ol>



					<div class="carousel-inner">

							<!--   custom post type-->

						<?php

						$carouselvar = new WP_query(array(

							'post_type'  => 'carouselslider'
						));

						$carva=0;

						while (	$carouselvar->have_posts()) {
							$carouselvar->the_post(); 	$carva ++?>

						  	<?php if($carva==1){?>
									  <div class="carousel-item active">

								<?php	}else{?>

								<div class="carousel-item">
								<?php }
								?>

								<img class="d-block w-100" src="<?php the_post_thumbnail();?>"
									<div class="carousel-caption d-none d-md-block">
									 <h1 class="animated bounceInUp"><?php the_title();?></h1>
									 <p ><?php the_content()?></p>
								 </div>
							</div>

							<?php }
							?>


						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>

			</div>


		<?php }
		wp_reset_postdata();
		?>





		</header><!-- #masthead -->

	<div id="content" class="site-content container container_padding">
