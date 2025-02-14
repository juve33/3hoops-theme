<!DOCTYPE html>

<!--
<?php
	$theme = wp_get_theme();
	if ( $theme ) {
		echo $theme->get( 'Name' ) . ' Theme Version ' . $theme->get( 'Version' );
	}
?>
-->
<!--
	Released under GPL-3.0 license by Julian Velling
-->

<html <?php language_attributes(); ?>>

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="theme-color" content=
			"<?php
				$primary_color = get_theme_mod( 'primary_color' );
				if ( $primary_color ) {
					echo esc_attr( $primary_color );
				} 
			?>"
		/>
		
		<?php
			wp_head();
		?>

	</head> 

	<body <?php body_class(); ?>>

		<?php
			wp_body_open();
		?>

		<nav class="main-nav">
			<div class="nav-wrapper">

				<?php

					wp_nav_menu(
						array(
							'menu' => 'primary',
							'container' => '',
							'theme_location' => 'primary',
							'items_wrap' => '<ul class="navigation"><li class="menu-item hamburger-icon"><i class="fa-sharp fa-solid fa-bars" tabindex="0"></i></li>%3$s</ul>',
							'fallback_cb' => 'lupustheme_empty_navigation',
							'depth' => 2
						)
					);

				?>
				<ul class="socialmedia">
					<?php
						$socialmedias = array(
							array( 'Facebook', 'facebook', 'fab fa-facebook fa-fw' ),
							array( 'Instagram', 'instagram', 'fab fa-instagram fa-fw' ),
							array( 'Tiktok', 'tiktok', 'fab fa-tiktok fa-fw' ),
							array( 'YouTube', 'youtube', 'fa-brands fa-youtube' ),
							array( 'X', 'x', 'fab fa-x-twitter fa-fw' ),
							array( 'Threads', 'threads', 'fab fa-threads fa-fw' ),
							array( 'Bluesky', 'bluesky', 'fa-brands fa-bluesky' ),
							array( 'Reddit', 'reddit', 'fa-brands fa-reddit' ),
							array( 'Github', 'github', 'fab fa-github fa-fw' ),
						);
					?>
					<?php foreach ( $socialmedias as $socialmedia ) : ?>
					<li class="menu-item">
						<a href="<?php
							$social_link = get_theme_mod( $socialmedia[1] . '_link', '' );
							if ( $social_link ) {
								echo esc_attr( $social_link );
							}
						?>" title="<?php esc_html_e( $socialmedia[0] ); ?>" target="_blank">
							<i class="<?php echo esc_html( $socialmedia[2], '3hoops' ) ?>"></i>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>

			</div>
		</nav>

		<main>