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

        // Slider attributes
        $slider_settings = [
            'autoplay' => 'yes' === $settings['autoplay'] ? [ 'delay' => $settings['autoplay_speed'] ] : false,
        ];

        // Dynamic content
        $section_title = $settings['section_title'];
        $button_text   = $settings['button_text'];
        $button_link   = $settings['button_link']['url'];
        
        // Link attributes
        $btn_link_attrs = '';
        if ( ! empty( $button_link ) ) {
            $widget->add_link_attributes( 'button_link', $settings['button_link'] );
            $widget->add_render_attribute( 'button_link', 'class', 'btn' );
        }

		?>
		<div class="ellens-team-slider-wrapper p-md mt-md mb-md mx-auto w-full">
            <!-- Header Section -->
            <div class="team-slider-header d-flex justify-between items-center mb-xl">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h2 class="section-title m-0"><?php echo esc_html( $section_title ); ?></h2>
                <?php endif; ?>

                <?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) :
                    $button_style = isset( $settings['button_style'] ) ? $settings['button_style'] : 'primary';
                    $button_class = 'btn--' . $button_style;
                ?>
                    <a href="<?php echo esc_url( $button_link ); ?>" class="team-slider__button btn <?php echo esc_attr( $button_class ); ?>">
                        <?php echo esc_html( $button_text ); ?>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
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
                                        <h3 class="team-name mb-xs"><?php the_title(); ?></h3>
                                        <?php if ( $job_title ) : ?>
                                            <p class="team-job m-0"><?php echo esc_html( $job_title ); ?></p>
                                        <?php endif; ?>
                                        <!-- Arrow Button -->
                                        <a href="<?php the_permalink(); ?>" class="team-arrow" aria-label="<?php esc_attr_e( 'View profile', 'ellens-lentze' ); ?>">
                                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
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
