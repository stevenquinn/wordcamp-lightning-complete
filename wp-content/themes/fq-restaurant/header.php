<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package Bootstrap Canvas WP
 * @since Bootstrap Canvas WP 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Wendy+One" rel="stylesheet">
    
	<?php
	  /*
	   * We add some JavaScript to pages with the comment form
	   * to support sites with threaded comments (when in use).
	   */
	  if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	  /*
	   * Always have wp_head() just before the closing </head>
	   * tag of your theme, or you will break many plugins, which
	   * generally use this hook to add elements to <head> such
	   * as styles, scripts, and meta tags.
	   */
	  wp_head(); 
    ?>
  </head>
  <body <?php body_class(); ?>>
    
    <div class="site-header">
	    
	    <div class="container">
		    
		    <!-- logo -->
		    <div class="row">
			    <div class="col-sm-4 col-sm-offset-4">
				    
				    <div class="logo">
					    <div class="small">Figoli's</div>
					    <div class="large">Cannolis</div>	
					    <div class="date">Est. 2017</div>
				    </div>
				    
			    </div>
		    </div>
		    <!-- end logo -->
		    
		    <!-- main nav area -->
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php print site_url();?>">
						Steven Quinn Design
					</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
								'container'      => 'false',
								'items_wrap'     => '%3$s',
								'fallback_cb'    => 'bootstrap_canvas_wp_menu_fallback',
							));
						?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
			<!-- end main nav area -->
		    
		</div>
    
