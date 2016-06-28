<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head <?php hybrid_attr( 'head' ); ?>>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>

</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container">

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'themelia' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>
            
            <div <?php hybrid_attr( 'branding' ); ?>> 
                <div id="access" class="site-access grid-container">
                    <div class="grid-100 relative">
               
						<?php //themelia_build_logo(); ?>
                        <?php themelia_construct_site_title(); ?>

                        <?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>
                    
                    </div><!-- .grid-100 -->
                </div><!-- #access -->
            </div><!-- #branding -->    

		</header><!-- #header -->

		<div id="main" class="main">
			<div class="grid-container">
            
			<?php if ( true == get_theme_mod( 'display_breadcrumbs', true ) ) : ?>
                <?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
            <?php endif; ?>
