<?php
namespace EllensLentze\Widgets\Action_Buttons\Includes\Render;

use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

        $title = $settings['title'];
        $description = $settings['description'];
        
        // Background Pattern
        if ( ! empty( $settings['bg_pattern']['url'] ) ) {
             $pattern_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'bg_pattern' );
             // Add class to image
             $pattern_html = str_replace( 'class="', 'class="action-buttons__bg-pattern ', $pattern_html );
        } else {
             $pattern_html = '';
        }

        $widget->add_render_attribute( 'wrapper', 'class', 'action-buttons p-md pt-2xl' );
        $widget->add_render_attribute( 'card', 'class', 'action-buttons__card' );
        $widget->add_render_attribute( 'header', 'class', 'action-buttons__header' );
        $widget->add_render_attribute( 'title', 'class', 'action-buttons__title' );
        $widget->add_render_attribute( 'description', 'class', 'action-buttons__description' );
        $widget->add_render_attribute( 'list', 'class', 'action-buttons__list' );

		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            <div <?php $widget->print_render_attribute_string( 'card' ); ?>>
                <?php if ( ! empty( $pattern_html ) ) echo $pattern_html; ?>
                
                <div <?php $widget->print_render_attribute_string( 'header' ); ?>>
                    <?php if ( ! empty( $title ) ) : ?>
                        <h2 <?php $widget->print_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $title ); ?></h2>
                    <?php endif; ?>

                    <?php if ( ! empty( $description ) ) : ?>
                        <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $description ); ?></div>
                    <?php endif; ?>
                </div>

                <div <?php $widget->print_render_attribute_string( 'list' ); ?>>
                    <?php 
                    if ( $settings['buttons'] ) {
                        foreach ( $settings['buttons'] as $item ) {
                             $link_key = 'link_' . $item['_id'];
                             $widget->add_link_attributes( $link_key, $item['link'] );
                             $widget->add_render_attribute( $link_key, 'class', [ 'action-buttons__item', 'btn', 'btn--outline' ] );
                            ?>
                            <a <?php $widget->print_render_attribute_string( $link_key ); ?>>
                                <?php echo esc_html( $item['text'] ); ?>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
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
