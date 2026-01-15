<?php
namespace EllensLentze\Widgets\USP_Grid\Includes\Render;

use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

        $widget->add_render_attribute( 'wrapper', 'class', 'usp-grid py-2xl' );
        $widget->add_render_attribute( 'container', 'class', 'usp-grid__container' );

		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            <div <?php $widget->print_render_attribute_string( 'container' ); ?>>
                <?php 
                if ( $settings['usps'] ) {
                    foreach ( $settings['usps'] as $item ) {
                         $item_key = 'item_' . $item['_id'];
                         $widget->add_render_attribute( $item_key, 'class', 'usp-grid__item' );
                        ?>
                        <div <?php $widget->print_render_attribute_string( $item_key ); ?>>
                            <?php if ( ! empty( $item['icon']['value'] ) ) : ?>
                                <div class="usp-grid__icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="usp-grid__content">
                                <?php if ( ! empty( $item['title'] ) ) : ?>
                                    <h3 class="usp-grid__title"><?php echo esc_html( $item['title'] ); ?></h3>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['description'] ) ) : ?>
                                    <div class="usp-grid__description"><?php echo wp_kses_post( $item['description'] ); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
		</div>
		<?php
	}
}
