<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

get_header();

while ( have_posts() ) {
	the_post();

	// If related posts should be inside the content
	$heaven11_related_position = heaven11_get_theme_option( 'related_position' );
	if ( strpos( $heaven11_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', get_post_format() ), get_post_format() );

	// If related posts should be inside the content
	if ( strpos( $heaven11_related_position, 'inside' ) === 0 ) {
		$heaven11_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'heaven11_action_related_posts' );
		$heaven11_related_content = ob_get_contents();
		ob_end_clean();

		$heaven11_related_position_inside = max( 0, min( 9, heaven11_get_theme_option( 'related_position_inside' ) ) );
		if ( 0 == $heaven11_related_position_inside ) {
			$heaven11_related_position_inside = mt_rand( 1, 9 );
		}
		
		$heaven11_p_number = 0;
		$heaven11_related_inserted = false;
		for ( $i = 0; $i < strlen( $heaven11_content ) - 3; $i++ ) {
			if ( $heaven11_content[ $i ] == '<' && $heaven11_content[ $i + 1 ] == 'p' && in_array( $heaven11_content[ $i + 2 ], array( '>', ' ' ) ) ) {
				$heaven11_p_number++;
				if ( $heaven11_related_position_inside == $heaven11_p_number ) {
					$heaven11_related_inserted = true;
					$heaven11_content = ( $i > 0 ? substr( $heaven11_content, 0, $i ) : '' )
										. $heaven11_related_content
										. substr( $heaven11_content, $i );
				}
			}
		}
		if ( ! $heaven11_related_inserted ) {
			$heaven11_content .= $heaven11_related_content;
		}

		heaven11_show_layout( $heaven11_content );
	}

	// Previous/next post navigation.
	$heaven11_show_posts_navigation = ! heaven11_is_off( heaven11_get_theme_option( 'show_posts_navigation' ) );
	$heaven11_fixed_posts_navigation = ! heaven11_is_off( heaven11_get_theme_option( 'fixed_posts_navigation' ) ) ? 'nav-links-fixed fixed' : '';
	if ( $heaven11_show_posts_navigation ) {
		?>
		<div class="nav-links-single<?php echo ' ' . esc_attr( $heaven11_fixed_posts_navigation ); ?>">
			<?php
			the_post_navigation(
				array(
					'next_text' => '<span class="nav-arrow"></span>'
						. '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'heaven11' ) . '</span> '
						. '<h6 class="post-title">%title</h6>'
						. '<span class="post_date">%date</span>',
					'prev_text' => '<span class="nav-arrow"></span>'
						. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'heaven11' ) . '</span> '
						. '<h6 class="post-title">%title</h6>'
						. '<span class="post_date">%date</span>',
				)
			);
			?>
		</div>
		<?php
	}

	// Related posts
	if ( 'below_content' == $heaven11_related_position ) {
		do_action( 'heaven11_action_related_posts' );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
