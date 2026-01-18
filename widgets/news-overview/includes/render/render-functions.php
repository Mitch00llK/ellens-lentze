<?php
namespace EllensLentze\Widgets\News_Overview\Includes\Render;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

        // 1. Featured Query
        $featured_ids = [];
        $featured_query = null;

        if ( 'yes' === $settings['show_featured'] && ! empty( $settings['featured_category'] ) ) {
            $featured_args = [
                'post_type' => 'post',
                'posts_per_page' => 2,
                'category_name' => $settings['featured_category'],
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
            ];
            $featured_query = new \WP_Query( $featured_args );
            
            if ( $featured_query->have_posts() ) {
                foreach ( $featured_query->posts as $p ) {
                    $featured_ids[] = $p->ID;
                }
            }
        }

        // 2. Main Query (Exclude featured)
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => $featured_ids,
        ];
        
        $query = new \WP_Query( $args );

        // Wrapper
        $widget->add_render_attribute( 'wrapper', 'class', 'news-overview p-md pt-3xl pb-3xl gap-2xl d-flex flex-column' );
		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            
            <!-- TITLE -->
            <?php if ( ! empty( $settings['title'] ) ) : ?>
                <div class="news-overview__main-title-wrapper">
                    <h2 class="news-overview__title"><?php echo esc_html( $settings['title'] ); ?></h2>
                </div>
            <?php endif; ?>
            
            <!-- FEATURED SECTION -->
            <?php if ( 'yes' === $settings['show_featured'] && $featured_query && $featured_query->have_posts() ) : ?>
            <div class="news-overview__featured-grid">
                <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); 
                    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    $cats = get_the_category();
                    $cat_name = ! empty( $cats ) ? $cats[0]->name : '';
                ?>
                <!-- Replicating Post Grid Card Structure -->
                <div class="news-overview__featured-card">
                    <a href="<?php the_permalink(); ?>" class="news-overview__featured-link" aria-label="<?php the_title_attribute(); ?>">
                        <div class="news-overview__featured-inner">
                            <!-- Left Column: Content -->
                            <div class="news-overview__featured-content-col">
                                <?php if ( $cat_name ) : ?>
                                    <span class="news-overview__featured-cat"><?php echo esc_html( $cat_name ); ?></span>
                                <?php endif; ?>
                                <h3 class="news-overview__featured-title"><?php the_title(); ?></h3>
                                
                                <div class="news-overview__featured-btn btn btn--light">
                                    <?php esc_html_e( 'Lees meer', 'ellens-lentze' ); ?>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </div>
                            </div>

                            <!-- Right Column: Image -->
                            <div class="news-overview__featured-image-col">
                                <?php if ( $img_url ) : ?>
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                <?php else : ?>
                                    <div class="news-overview__featured-placeholder"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>

            <!-- HEADER & FILTER -->
            <?php if ( 'yes' === $settings['show_filters'] ) : ?>
            <div class="news-overview__header">
                <div class="news-overview__filter-bar">
                    <?php 
                    // Automatic Category Filtering
                    // "All" Button
                    ?>
                    <button class="news-overview__filter-btn active" data-filter="*">
                        <?php esc_html_e( 'Alle berichten', 'ellens-lentze' ); ?>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    
                    <?php
                    // Get categories excluding 'uncategorized' if desired, or all populated
                    $categories = get_categories( [
                        'orderby' => 'name',
                        'order'   => 'ASC',
                        'hide_empty' => true,
                    ] );

                    foreach ( $categories as $category ) :
                        // Skip Uncategorized if needed? usually ID 1.
                        if ( $category->slug === 'uncategorized' ) continue; 
                        ?>
                        <button class="news-overview__filter-btn" data-filter="<?php echo esc_attr( $category->slug ); ?>">
                            <?php echo esc_html( $category->name ); ?>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- MAIN GRID -->
            <?php if ( $query->have_posts() ) : ?>
                <div class="news-overview__grid">
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                        $cats = get_the_category();
                        $cat_slugs = [];
                        $cat_name = '';
                        if ( ! empty( $cats ) ) {
                            $cat_name = $cats[0]->name;
                            foreach ( $cats as $c ) $cat_slugs[] = $c->slug;
                        }
                        $cat_data = implode( ' ', $cat_slugs );
                        $img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                    ?>
                    <div class="news-overview__item" data-categories="<?php echo esc_attr( $cat_data ); ?>">
                        <a href="<?php the_permalink(); ?>" class="news-overview__item-link">
                            <div class="news-overview__item-image">
                                <?php if ( $img_url ) : ?>
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                <?php else : ?>
                                    <div class="news-overview__placeholder"></div>
                                <?php endif; ?>
                            </div>
                            <div class="news-overview__item-content">
                                <div class="news-overview__item-top">
                                    <span class="news-overview__item-cat"><?php echo esc_html( $cat_name ); ?></span>
                                    <span class="news-overview__item-date"><?php echo get_the_date( 'd F Y' ); ?></span>
                                </div>
                                <h4 class="news-overview__item-title"><?php the_title(); ?></h4>
                                <div class="news-overview__item-read-more">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>

		</div>
		<?php
	}
}
