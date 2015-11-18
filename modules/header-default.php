<?php
// Header Module
?>
	<header class="site-header">
		<div class="site-header-inner">
			<div class="container">
				<div class="navbar-header">
					<div class="site-branding navbar-brand" itemscope itemtype="https://schema.org/logo">
						<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>

						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div><!-- .site-branding -->
				</div>
			</div>
		</div>
	</header>

	<div id="site-navigation-wrapper" class="site-navigation-wrapper">
		<nav id="site-navigation" class="main-navigation navbar container" role="navigation">
			<?php if ( has_nav_menu( 'primary' ) ) wp_nav_menu (
				array (
					'theme_location' => 'primary',
					'menu_class'     => 'nav navbar-nav',
					'walker'				 => new iSeek_Menu_Walker()
					)
			) ?>
		</nav><!-- #site-navigation -->
	</div><!-- #nav-wrapper -->
