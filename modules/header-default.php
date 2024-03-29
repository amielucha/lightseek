<?php
// Header Module
?>
	<header class="site-header">
		<div class="site-header-inner">
			<div class="container">
				<div class="navbar-header">
					<div class="site-branding navbar-brand" itemscope itemtype="https://schema.org/logo">
						<?php if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php else: ?>
							<p class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<p class="site-description h2"><?php bloginfo( 'description' ); ?></p>
						<?php endif ?>
					</div><!-- .site-branding -->
				</div>
			</div>
		</div>
	</header>

	<div id="site-navigation-wrapper" class="site-navigation-wrapper">
		<nav id="site-navigation" class="main-navigation navbar container" role="navigation">
			<label for="menu-toggle" class="menu-toggle-label hidden-md-up"><span class="hamburger" aria-hidden="true">&#8801;</span> Main Menu</label>
			<input type="checkbox" id="menu-toggle" class="menu-toggle invisible" aria-controls="primary-menu" />
			<?php if ( has_nav_menu( 'primary' ) ) wp_nav_menu (
				array (
					'container_class'=> 'nav-menu-container',
					'theme_location' => 'primary',
					'menu_class'     => 'nav navbar-nav',
					'menu_id'		 => 'primary-menu',
					'walker'				 => new iSeek_Menu_Walker()
					)
			) ?>
		</nav><!-- #site-navigation -->
	</div><!-- #nav-wrapper -->
