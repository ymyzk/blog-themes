<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<?php twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			// Custom start
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			if ( class_exists( 'Jetpack_Likes' ) ) {
				$custom_likes = new Jetpack_Likes;
				echo $custom_likes->post_likes( '' );
			}
			// Custom end

			the_content();

		// Custom start
                ?>
                        <aside>
                          <div style="font-size: 12px;">広告</div>
                          <style>
                          .blog-single-footer { padding: 0; width: 250px; height: 250px; }
                          @media(min-width: 320px) { .blog-single-footer { width: 300px; height: 250px; } }
                          @media(min-width: 356px) { .blog-single-footer { width: 336px; height: 280px; } }
                          </style>
                          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                          <!-- Blog Single footer -->
                          <ins class="adsbygoogle blog-single-footer"
                          style="display:inline-block"
                          data-ad-client="ca-pub-7757732440953348"
                          data-ad-slot="4830889717"></ins>
                          <script>
                          (adsbygoogle = window.adsbygoogle || []).push({});
                          </script>
                        </aside>
                <?php
                        // Related posts
                        echo do_shortcode( '[jetpack-related-posts]' );
                        // Sharing
                        if ( function_exists( 'sharing_display' ) ) {
                                sharing_display( '', true );
                        }
                        if ( class_exists( 'Jetpack_Likes' ) ) {
                                $custom_likes = new Jetpack_Likes;
                                echo $custom_likes->post_likes( '' );
                        }
                // Custom end

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php twentysixteen_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
