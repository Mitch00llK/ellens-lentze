<?php
namespace EllensLentze\Widgets\Post_Grid\Includes\Render;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

        $title = $settings['title'];
        $btn_text = $settings['button_text'];
        $btn_link = $settings['button_link'];
        
        $posts_per_page = $settings['posts_per_page'];
        $category = $settings['category_filter'];

        // Query Args
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        if ( ! empty( $category ) ) {
            $args['category_name'] = $category;
        }

        $query = new \WP_Query( $args );

        // Attributes
        $widget->add_render_attribute( 'wrapper', 'class', 'ellens-post-grid-wrapper p-md pt-3xl pb-3xl' );
        
        if ( ! empty( $btn_text ) ) {
            $button_style = isset( $settings['button_style'] ) ? $settings['button_style'] : 'primary';
            $button_class = 'btn--' . $button_style;
            $widget->add_render_attribute( 'header_btn', 'class', [ 'btn', $button_class, 'post-grid-header-btn' ] );
            if ( ! empty( $btn_link['url'] ) ) {
                $widget->add_link_attributes( 'header_btn', $btn_link );
            }
        }

		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            <!-- Header -->
            <div class="ellens-post-grid-header mx-auto">
                <?php if ( ! empty( $title ) ) : ?>
                    <h2 class="section-title m-0"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <?php if ( ! empty( $btn_text ) ) : ?>
                    <a <?php $widget->print_render_attribute_string( 'header_btn' ); ?>>
                        <?php echo esc_html( $btn_text ); ?>
                        <!-- Ensure icon matches global style or override -->
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Grid -->
            <?php
            $post_count = $query->post_count;
            $grid_class = 'ellens-post-grid-container';
            if ( $post_count > 0 ) {
                $grid_class .= ' ellens-grid-cols-' . min( $post_count, 3 ); // Cap at 3 for class logic
            }
            ?>
            <div class="<?php echo esc_attr( $grid_class ); ?> mx-auto">
                <?php if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                        $categories = get_the_category();
                        $cat_name = ! empty( $categories ) ? $categories[0]->name : 'Actueel';
                        $image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    ?>
                        <div class="post-card">
                            <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="<?php the_title_attribute(); ?>">
                                <div class="post-card-inner">
                                    <!-- Left Column: Content -->
                                    <div class="post-content-column">
                                        <span class="post-category"><?php echo esc_html( $cat_name ); ?></span>
                                        <h3 class="post-title"><?php the_title(); ?></h3>
                                        
                                        <?php
                                        $card_btn_style = isset( $settings['card_button_style'] ) ? $settings['card_button_style'] : 'light';
                                        $card_btn_class = 'btn--' . $card_btn_style;
                                        ?>
                                        <div class="post-read-more-btn btn <?php echo esc_attr( $card_btn_class ); ?>">
                                            <?php esc_html_e( 'Lees meer', 'ellens-lentze' ); ?>
                                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                    <!-- Right Column: Image -->
                                    <div class="post-image-column">
                                        <?php if ( $image_url ) : ?>
                                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                        <?php else : ?>
                                            <div class="post-image-placeholder"></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php esc_html_e( 'No posts found.', 'ellens-lentze' ); ?></p>
                <?php endif; ?>
            </div>
		</div>
		<?php
	}
}
