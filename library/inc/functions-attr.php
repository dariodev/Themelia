<?php
/**
 * Modified for Themelia by dariodev. Schema.org microdata removed.
 *
 * HTML attribute functions and filters.  The purposes of this is to provide a way for theme/plugin devs
 * to hook into the attributes for specific HTML elements and create new or modify existing attributes.
 * This is sort of like `body_class()`, `post_class()`, and `comment_class()` on steroids. Plus, it
 * handles attributes for many more elements.
 *
 * @package    HybridCore
 * @subpackage Includes
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

# Attributes for major structural elements.
add_filter( 'hybrid_attr_body',    'hybrid_attr_body',    5    );
add_filter( 'hybrid_attr_header',  'hybrid_attr_header',  5    );
add_filter( 'hybrid_attr_footer',  'hybrid_attr_footer',  5    );
add_filter( 'hybrid_attr_content', 'hybrid_attr_content', 5    );
add_filter( 'hybrid_attr_sidebar', 'hybrid_attr_sidebar', 5, 2 );
add_filter( 'hybrid_attr_menu',    'hybrid_attr_menu',    5, 2 );

# Header attributes.
add_filter( 'hybrid_attr_head',             'hybrid_attr_head',             5 );
add_filter( 'hybrid_attr_branding',         'hybrid_attr_branding',         5 );
add_filter( 'hybrid_attr_site-title',       'hybrid_attr_site_title',       5 );
add_filter( 'hybrid_attr_site-description', 'hybrid_attr_site_description', 5 );

# Archive page header attributes.
add_filter( 'hybrid_attr_archive-header',      'hybrid_attr_archive_header',      5 );
add_filter( 'hybrid_attr_archive-title',       'hybrid_attr_archive_title',       5 );
add_filter( 'hybrid_attr_archive-description', 'hybrid_attr_archive_description', 5 );

# Post-specific attributes.
add_filter( 'hybrid_attr_post',            'hybrid_attr_post',            5    );
add_filter( 'hybrid_attr_entry',           'hybrid_attr_post',            5    ); // Alternate for "post".
add_filter( 'hybrid_attr_entry-title',     'hybrid_attr_entry_title',     5    );
add_filter( 'hybrid_attr_entry-author',    'hybrid_attr_entry_author',    5    );
add_filter( 'hybrid_attr_entry-published', 'hybrid_attr_entry_published', 5    );
add_filter( 'hybrid_attr_entry-content',   'hybrid_attr_entry_content',   5    );
add_filter( 'hybrid_attr_entry-summary',   'hybrid_attr_entry_summary',   5    );
add_filter( 'hybrid_attr_entry-terms',     'hybrid_attr_entry_terms',     5, 2 );

# Comment specific attributes.
add_filter( 'hybrid_attr_comment',           'hybrid_attr_comment',           5 );
add_filter( 'hybrid_attr_comment-author',    'hybrid_attr_comment_author',    5 );
add_filter( 'hybrid_attr_comment-published', 'hybrid_attr_comment_published', 5 );
add_filter( 'hybrid_attr_comment-permalink', 'hybrid_attr_comment_permalink', 5 );
add_filter( 'hybrid_attr_comment-content',   'hybrid_attr_comment_content',   5 );

/**
 * Outputs an HTML element's attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $slug     The slug/ID of the element (e.g., 'sidebar').
 * @param  string  $context  A specific context (e.g., 'primary').
 * @param  array   $attr     Array of attributes to pass in (overwrites filters).
 * @return void
 */
function hybrid_attr( $slug, $context = '', $attr = array()  ) {
	echo hybrid_get_attr( $slug, $context, $attr );
}

/**
 * Gets an HTML element's attributes.  This function is actually meant to be filtered by theme authors, plugins,
 * or advanced child theme users.  The purpose is to allow folks to modify, remove, or add any attributes they
 * want without having to edit every template file in the theme.  So, one could support microformats instead
 * of microdata, if desired.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $slug     The slug/ID of the element (e.g., 'sidebar').
 * @param  string  $context  A specific context (e.g., 'primary').
 * @param  array   $attr     Array of attributes to pass in (overwrites filters).
 * @return string
 */
function hybrid_get_attr( $slug, $context = '', $attr = array() ) {

	$out  = '';
	$attr = wp_parse_args( $attr, apply_filters( "hybrid_attr_{$slug}", array(), $context ) );

	if ( empty( $attr ) )
		$attr['class'] = $slug;

	foreach ( $attr as $name => $value )
		$out .= false !== $value ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" );

	return trim( $out );
}

/* === Structural === */

/**
 * <body> element attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_body( $attr ) {

	$attr['class'] = join( ' ', get_body_class() );
	$attr['dir']   = is_rtl() ? 'rtl' : 'ltr';

	return $attr;
}

/**
 * Page <header> element attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_header( $attr ) {

	$attr['id']    = 'header';
	$attr['class'] = 'site-header';

	return $attr;
}

/**
 * Page <footer> element attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_footer( $attr ) {

	$attr['id']    = 'footer';
	$attr['class'] = 'site-footer';

	return $attr;
}

/**
 * Main content container of the page attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_content( $attr ) {

	$attr['id']    = 'content';
	$attr['class'] = 'content';

	return $attr;
}

/**
 * Sidebar attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_sidebar( $attr, $context ) {

	$attr['class'] = 'sidebar';

	if ( $context ) {

		$attr['class'] .= " sidebar-{$context}";
		$attr['id']     = "sidebar-{$context}";

		$sidebar_name = hybrid_get_sidebar_name( $context );

		if ( $sidebar_name ) {
			// Translators: The %s is the sidebar name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Sidebar', 'sidebar aria label', 'themelia' ), $sidebar_name ) );
		}
	}

	return $attr;
}

/**
 * Nav menu attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_menu( $attr, $context ) {

	$attr['class'] = 'menu';

	if ( $context ) {

		$attr['class'] .= " menu-{$context}";
		$attr['id']     = "menu-{$context}";

		$menu_name = hybrid_get_menu_location_name( $context );

		if ( $menu_name ) {
			// Translators: The %s is the menu name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Menu', 'nav menu aria label', 'themelia' ), $menu_name ) );
		}
	}

	return $attr;
}

/* === header === */

/**
 * Branding (usually a wrapper for title and tagline) attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_branding( $attr ) {

	$attr['id']    = 'branding';
	$attr['class'] = 'site-branding';

	return $attr;
}

/**
 * Site title attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_site_title( $attr ) {

	$attr['id']    = 'site-title';
	$attr['class'] = 'site-title';

	return $attr;
}

/**
 * Site description attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_site_description( $attr ) {

	$attr['id']       = 'site-description';
	$attr['class']    = 'site-description';

	return $attr;
}

/* === loop === */

/**
 * Archive header attributes.
 *
 * @since  3.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_archive_header( $attr ) {

	$attr['class'] = 'archive-header';

	return $attr;
}

/**
 * Archive title attributes.
 *
 * @since  3.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_archive_title( $attr ) {

	$attr['class'] = 'archive-title';

	return $attr;
}

/**
 * Archive description attributes.
 *
 * @since  3.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_archive_description( $attr ) {

	$attr['class'] = 'archive-description';

	return $attr;
}

/* === posts === */

/**
 * Post <article> element attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_post( $attr ) {

	$post = get_post();

	// Make sure we have a real post first.
	if ( ! empty( $post ) ) {

		$attr['id']    = 'post-' . get_the_ID();
		$attr['class'] = join( ' ', get_post_class() );

	} else {

		$attr['id']    = 'post-0';
		$attr['class'] = join( ' ', get_post_class() );
	}

	return $attr;
}

/**
 * Post title attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_entry_title( $attr ) {

	$attr['class']    = 'entry-title';
	$attr['itemprop'] = 'headline';

	return $attr;
}

/**
 * Post author attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_entry_author( $attr ) {

	$attr['class']    = 'entry-author';
	$attr['itemprop'] = 'author';

	return $attr;
}

/**
 * Post time/published attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_entry_published( $attr ) {

	$attr['class']    = 'entry-published updated';
	$attr['datetime'] = get_the_time( 'Y-m-d\TH:i:sP' );
	$attr['itemprop'] = 'datePublished';

	// Translators: Post date/time "title" attribute.
	$attr['title'] = get_the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'themelia' ) );

	return $attr;
}

/**
 * Post content (not excerpt) attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_entry_content( $attr ) {

	$attr['class'] = 'entry-content';

	if ( 'post' === get_post_type() )
		$attr['itemprop'] = 'articleBody';
	else
		$attr['itemprop'] = 'text';

	return $attr;
}

/**
 * Post summary/excerpt attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_entry_summary( $attr ) {

	$attr['class']    = 'entry-summary';
	$attr['itemprop'] = 'description';

	return $attr;
}

/**
 * Post terms (tags, categories, etc.) attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybrid_attr_entry_terms( $attr, $context ) {

	if ( !empty( $context ) ) {

		$attr['class'] = 'entry-terms ' . sanitize_html_class( $context );

		if ( 'category' === $context )
			$attr['itemprop'] = 'articleSection';

		else if ( 'post_tag' === $context )
			$attr['itemprop'] = 'keywords';
	}

	return $attr;
}


/* === Comment elements === */


/**
 * Comment wrapper attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_comment( $attr ) {

	$attr['id']    = 'comment-' . get_comment_ID();
	$attr['class'] = join( ' ', get_comment_class() );

	if ( in_array( get_comment_type(), array( '', 'comment' ) ) ) {

		$attr['itemprop']  = 'comment';
	}

	return $attr;
}

/**
 * Comment author attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_comment_author( $attr ) {

	$attr['class']     = 'comment-author';
	$attr['itemprop']  = 'author';

	return $attr;
}

/**
 * Comment time/published attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_comment_published( $attr ) {

	$attr['class']    = 'comment-published';
	$attr['datetime'] = get_comment_time( 'Y-m-d\TH:i:sP' );

	// Translators: Comment date/time "title" attribute.
	$attr['title']    = get_comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'themelia' ) );
	$attr['itemprop'] = 'datePublished';

	return $attr;
}

/**
 * Comment permalink attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_comment_permalink( $attr ) {

	$attr['class']    = 'comment-permalink';
	$attr['href']     = get_comment_link();
	$attr['itemprop'] = 'url';

	return $attr;
}

/**
 * Comment content/text attributes.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybrid_attr_comment_content( $attr ) {

	$attr['class']    = 'comment-content';
	$attr['itemprop'] = 'text';

	return $attr;
}
