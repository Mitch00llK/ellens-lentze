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
                            $widget->add_render_attribute( $item_key, 'class', [
								'services-cluster__card-wrapper',
								'elementor-repeater-item-' . $item['_id'],
							] );
                            
                            // Card Link
                            $link_tag = 'div';
                            if ( ! empty( $item['link']['url'] ) ) {
                                $link_tag = 'a';
                                $widget->add_link_attributes( $item_key, $item['link'] );
                            }
                            ?>
                            <div <?php $widget->print_render_attribute_string( $item_key ); ?>>
                                <<?php echo $link_tag; ?> class="services-cluster__card">
                                    <div class="services-cluster__header">
                                        <?php if ( ! empty( $item['icon']['value'] ) ) : ?>
                                            <div class="services-cluster__icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <span class="services-cluster__title"><?php echo esc_html( $item['title'] ); ?></span>
                                    </div>
                                    
                                    <?php if ( ! empty( $item['description'] ) ) : ?>
                                        <div class="services-cluster__description"><?php echo wp_kses_post( $item['description'] ); ?></div>
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
