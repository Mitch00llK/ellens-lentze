<?php
namespace EllensLentze\Widgets\Team_Slider\Includes\Render;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( Widget_Base $widget ) {
		$settings = $widget->get_settings_for_display();

        $args = [
            'post_type'      => 'ellens_team',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'post_status'    => 'publish',
        ];

        $team_query = new \WP_Query( $args );

        if ( ! $team_query->have_posts() ) {
            return;
        }

        // Slider Attributes
        $slider_settings = [
            'autoplay' => 'yes' === $settings['autoplay'] ? [ 'delay' => $settings['autoplay_speed'] ] : false,
        ];

		?>
		<div class="ellens-team-slider-wrapper">
            <!-- Header Section -->
            <div class="team-slider-header">
                <h2 class="section-title"><?php esc_html_e( 'Het team van Ellens & Lentze', 'ellens-lentze' ); ?></h2>
                <a href="/over-ons" class="ellens-btn">
                    <?php esc_html_e( 'Over ons', 'ellens-lentze' ); ?>
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>

            <!-- Slider (Splide structure) -->
            <div class="splide ellens-team-slider" data-settings='<?php echo wp_json_encode( $slider_settings ); ?>'>
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php while ( $team_query->have_posts() ) : $team_query->the_post(); 
                            $job_title = get_post_meta( get_the_ID(), '_ellens_team_function', true );
                            $image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        ?>
                            <li class="splide__slide team-card">
                                <div class="team-card-inner">
                                    <?php if ( $image_url ) : ?>
                                        <div class="team-image-wrapper">
                                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                        </div>
                                    <?php endif; ?>
                                    <div class="team-info">
                                        <h3 class="team-name"><?php the_title(); ?></h3>
                                        <?php if ( $job_title ) : ?>
                                            <p class="team-job"><?php echo esc_html( $job_title ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Arrow Button -->
                                    <a href="<?php the_permalink(); ?>" class="team-arrow" aria-label="<?php esc_attr_e( 'View profile', 'ellens-lentze' ); ?>">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
		</div>
		<?php
	}
}
