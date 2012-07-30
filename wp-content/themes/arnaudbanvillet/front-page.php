<?php

/**
 * Front page for the website
 *
 * The content of the page
 * A slider for the portfolio
 * A liste a link
 *
 * No sidebar
 *
 * @package WordPress
 * @subpackage ArnaudBanvillet.com
 */

// Enqueue showcase script for the slider
wp_enqueue_script( 'twentyeleven-showcase', get_template_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );

get_header(); ?>

	<div id="primary" class="showcase">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<?php
				/**
					* We are using a heading by rendering the_content
					* If we have content for this page, let's display it.
					*/
				if ( '' != get_the_content() )
					get_template_part( 'content', 'intro' );
			?>

			<?php endwhile; ?>

			<?php
			/**
				* Begin the portfolio section.
				*
				*/

			$portfolio_args = array(
				'post_type'				=> 'portfolio',
				'post_status'			=> 'publish',
				'posts_per_page'	=> 10,
				'no_found_rows'		=> true,
			);

			// The Featured Posts query.
			$featured = new WP_Query( $portfolio_args );

			// Proceed only if published posts exist
			if ( $featured->have_posts() ) :

			/**
				* We will need to count featured posts starting from zero
				* to create the slider navigation.
				*/
			$counter_slider = 0;

			$header_image_width = get_theme_support( 'custom-header', 'width' );;

			?>

			<div class="featured-posts">
				<h1 class="showcase-heading"><?php _e( 'Portfolio', 'arnaudbanvillet' ); ?></h1>

			<?php
				// Let's roll.
				while ( $featured->have_posts() ) : $featured->the_post();

				// Increase the counter.
				$counter_slider++;

				/**
					* We're going to add a class to our featured post for featured images
					* by default it'll have the feature-text class.
					*/
				$feature_class = 'feature-text';

				if ( has_post_thumbnail() ) {
					// ... but if it has a featured image let's add some class
					$feature_class = 'feature-image small';

					// Hang on. Let's check this here image out.
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) );

					// Is it bigger than or equal to our header?
					if ( $image[1] >= $header_image_width ) {
						// If bigger, let's add a BIGGER class. It's EXTRA classy now.
						$feature_class = 'feature-image large';
					}
				}
				?>

				<section class="featured-post <?php echo $feature_class; ?>" id="featured-post-<?php echo $counter_slider; ?>">

					<?php
						/**
							* If the thumbnail is as big as the header image
							* make it a large featured post, otherwise render it small
							*/
						if ( has_post_thumbnail() ) {
							if ( $image[1] >= $header_image_width )
								$thumbnail_size = 'large-feature';
							else
								$thumbnail_size = 'small-feature';
							?>
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbnail_size ); ?></a>
							<?php
						}
					?>
					<?php get_template_part( 'content', 'featured' ); ?>
				</section>
			<?php endwhile;	?>

			<?php
				// Show slider only if we have more than one featured post.
				if ( $featured->post_count > 1 ) :
			?>
			<nav class="feature-slider">
				<ul>
				<?php

					// Reset the counter so that we end up with matching elements
						$counter_slider = 0;

					// Begin from zero
						rewind_posts();

					// Let's roll again.
						while ( $featured->have_posts() ) : $featured->the_post();
							$counter_slider++;
						if ( 1 == $counter_slider )
							$class = 'class="active"';
						else
							$class = '';
						?>
					<li><a href="#featured-post-<?php echo $counter_slider; ?>" title="<?php printf( esc_attr__( 'Featuring: %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $class; ?>></a></li>
				<?php endwhile;	?>
				</ul>
			</nav>
			<?php endif; // End check for more than one sticky post. ?>
			</div><!-- .featured-posts -->
			<?php endif; // End check for published posts. ?>


		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>
