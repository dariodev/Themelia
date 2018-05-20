<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline small">
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

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => '<span>,</span> ',  'text' => __( '<span class="title">Posted in: </span>%s', 'themelia' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => '<span>,</span> ', 'text' => __( '<span class="title">Tagged: </span>%s', 'themelia' ), 'before' => '<br />' ) ); ?>
		</footer><!-- .entry-footer -->

		<?php get_template_part( 'misc/author-box' ); ?>

	<?php else : // If not viewing a single post. ?>

		<header class="entry-header">

			<div class="entry-byline small">
				<?php hybrid_post_format_link(); ?>
				<?php themelia_comments_link(); ?>
				<?php themelia_edit_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
