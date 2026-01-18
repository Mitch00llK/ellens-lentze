<?php
namespace EllensLentze\Widgets\Team_Grid\Includes\Render;

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

        // Content
        $section_title = $settings['section_title'];
        $description   = $settings['section_description'];

		?>
		<div class="ellens-team-grid-wrapper p-md pt-3xl pb-3xl mx-auto w-full">
            <!-- Header Section -->
            <div class="team-grid-header mb-lg">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h2 class="section-title m-0 mb-sm"><?php echo esc_html( $section_title ); ?></h2>
                <?php endif; ?>
                
                <?php if ( ! empty( $description ) ) : ?>
                    <p class="section-description m-0"><?php echo esc_html( $description ); ?></p>
                <?php endif; ?>
            </div>

            <!-- Grid -->
            <div class="team-grid d-grid gap-md">
                <?php while ( $team_query->have_posts() ) : $team_query->the_post(); 
                    $job_title = get_post_meta( get_the_ID(), '_ellens_team_function', true );
                    $image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                ?>
                    <div class="team-card">
                        <div class="team-card-inner">
                            <?php if ( $image_url ) : ?>
                                <div class="team-image-wrapper">
                                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                            <div class="team-info">
                                <h3 class="team-name mt-0 mr-0 ml-0 mb-xs"><?php the_title(); ?></h3>
                                <?php if ( $job_title ) : ?>
                                    <p class="team-job m-0"><?php echo esc_html( $job_title ); ?></p>
                                <?php endif; ?>
                                <!-- Arrow Button -->
                                <a href="<?php the_permalink(); ?>" class="team-arrow" aria-label="<?php esc_attr_e( 'View profile', 'ellens-lentze' ); ?>">
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
		</div>
		<?php
	}
}
