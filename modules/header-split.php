<?php
// Header Module
?>
	<header class="site-header">
		<div class="site-header-inner">
			<div class="container">
				<nav id="site-navigation" class="main-navigation navbar" role="navigation">
					<div class="navbar-header">
						<div class="site-branding navbar-brand" itemscope itemtype="https://schema.org/logo">
							<?php if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						</div><!-- .site-branding -->
					</div>
					<?php if ( has_nav_menu( 'primary' ) ) wp_nav_menu (
						array (
							'theme_location' => 'primary',
							'menu_class'     => 'nav navbar-nav pull-right',
							'walker'				 => new iSeek_Menu_Walker()
							)
					) ?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header>
