<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<div class="entry-byline small">
				<?php hybrid_post_format_link(); ?>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php
				if ( true != get_theme_mod( 'postby_full' ) )
					{ ?>
					<span class="post-by"><?php echo esc_html_x( 'by', 'post author', 'themelia' ) ?></span>
					<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
					<?php
					}
				?>
				<?php themelia_comments_link(); ?>
				<?php themelia_edit_link(); ?>
			</div><!-- .entry-byline -->

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => '<span>,</span> ',  'text' => esc_html__( 'Posted in: %s', 'themelia' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => '<span>,</span> ', 'text' => esc_html__( 'Tagged: %s', 'themelia' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

		<?php get_template_part( 'misc/author-box' ); ?>

	<?php else : // If not viewing a single post. ?>

		<header class="entry-header">

			<div class="entry-byline small">
				<?php hybrid_post_format_link(); ?>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php
				if ( true != get_theme_mod( 'postby_excerpt' ) )
					{ ?>
					<span class="post-by"><?php echo esc_html_x( 'by', 'post author', 'themelia' ) ?></span>
					<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
					<?php
					}
				?>
				<?php themelia_comments_link(); ?>
				<?php themelia_edit_link(); ?>
			</div><!-- .entry-byline -->

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

		</header><!-- .entry-header -->

		<?php get_the_image( array( 'size' => 'large', 'image_class' => 'gallery-post-thumbnail', 'split_content' => true, 'scan_raw' => true, 'scan' => true, 'order' => array( 'featured', 'scan_raw', 'scan', 'attachment' ) ) ); ?>

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php $count = hybrid_get_gallery_item_count(); ?>
			<p class="gallery-count"><?php printf( esc_html( _n( 'This gallery contains %s item.', 'This gallery contains %s items.', $count, 'themelia' ) ), $count ); ?></p>
			<?php the_excerpt(); ?>


		</div><!-- .entry-summary -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
