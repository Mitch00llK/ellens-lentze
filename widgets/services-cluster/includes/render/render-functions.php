<?php
namespace EllensLentze\Widgets\Services_Cluster\Includes\Render;

use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

        $widget->add_render_attribute( 'wrapper', 'class', 'services-cluster' );
        $widget->add_render_attribute( 'container', 'class', 'services-cluster__container' );

        // Mask Style if provided
        $mask_style = '';
        if ( ! empty( $settings['mask_image']['url'] ) ) {
            $mask_url = esc_url( $settings['mask_image']['url'] );
            $mask_style = "mask-image: url('{$mask_url}'); -webkit-mask-image: url('{$mask_url}');";
        }

		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            <div <?php $widget->print_render_attribute_string( 'container' ); ?>>
                
                <!-- Cluster Title -->
                <?php if ( ! empty( $settings['cluster_title'] ) ) : ?>
                    <div class="services-cluster__title-wrapper">
                        <?php
                        $title_tag = \Elementor\Utils::validate_html_tag( $settings['cluster_title_tag'] );
                        printf( '<%1$s class="services-cluster__main-title m-0">%2$s</%1$s>', $title_tag, esc_html( $settings['cluster_title'] ) );
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Central Visuals -->
                <div class="services-cluster__visuals">
                    <?php if ( ! empty( $settings['center_image']['url'] ) ) : ?>
                         <img src="<?php echo esc_url( $settings['center_image']['url'] ); ?>" 
                              alt="<?php echo esc_attr( \Elementor\Control_Media::get_image_alt( $settings['center_image'] ) ); ?>" 
                              class="services-cluster__mask-image"
                              style="<?php echo esc_attr( $mask_style ); ?>" >
                    <?php endif; ?>
                </div>

                <!-- Service Cards -->
                <div class="services-cluster__cards">
                    <?php 
                    if ( $settings['items'] ) {
                        foreach ( $settings['items'] as $index => $item ) {
                            $item_key = 'item_' . $index;
                            $descriptive_classes = [
                                'services-cluster__card-wrapper',
                                'services-cluster__card-wrapper--index-' . ($index + 1),
                                'elementor-repeater-item-' . $item['_id'],
                            ];

                            if ( ! empty( $item['title'] ) ) {
                                $descriptive_classes[] = 'services-cluster__card-wrapper--' . sanitize_title( $item['title'] );
                            }

                            $widget->add_render_attribute( $item_key, 'class', $descriptive_classes );


                            
                            // Card Link
                            $link_tag = 'div';
                            if ( ! empty( $item['link']['url'] ) ) {
                                $link_tag = 'a';
                                $widget->add_link_attributes( $item_key, $item['link'] );
                            }
                            ?>
                            <div <?php $widget->print_render_attribute_string( $item_key ); ?>>
                                <<?php echo $link_tag; ?> class="services-cluster__card p-xl">
                                    <div class="services-cluster__header mb-sm">
                                        <?php if ( ! empty( $item['icon']['value'] ) ) : ?>
                                            <div class="services-cluster__icon m-0">
                                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <span class="services-cluster__title"><?php echo esc_html( $item['title'] ); ?></span>
                                    </div>
                                    
                                    <?php if ( ! empty( $item['description'] ) ) : ?>
                                        <div class="services-cluster__description m-0"><?php echo wp_kses_post( $item['description'] ); ?></div>
                                    <?php endif; ?>
                                </<?php echo $link_tag; ?>>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>
		</div>
		<?php
	}
}
