<?php
namespace EllensLentze\Widgets\Image_Text_Block\Includes\Render;

use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

        $widget->add_render_attribute( 'wrapper', 'class', 'image-text-block p-md' );
        $widget->add_render_attribute( 'container', 'class', 'image-text-block__container' );

        // Layout Switch
        if ( 'right' === $settings['image_position'] ) {
            $widget->add_render_attribute( 'container', 'class', 'image-text-block__container--reverse' );
        }

		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            <div <?php $widget->print_render_attribute_string( 'container' ); ?>>
                
                <!-- Image Wrapper -->
                <div class="image-text-block__image-wrapper">
                    <?php if ( ! empty( $settings['image']['url'] ) ) : ?>
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image' ); ?>
                    <?php endif; ?>
                </div>

                <!-- Content Wrapper -->
                <div class="image-text-block__content-wrapper p-2xl">
                    <?php if ( ! empty( $settings['title'] ) ) : ?>
                        <h2 class="image-text-block__title m-0"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <div class="image-text-block__description m-0"><?php echo wp_kses_post( $settings['description'] ); ?></div>
                    <?php endif; ?>

                    <div class="image-text-block__actions pb-2xl">
                        <!-- Primary Button -->
                        <?php if ( ! empty( $settings['btn_primary_text'] ) ) : 
                            $btn_primary_style = isset( $settings['btn_primary_style'] ) ? $settings['btn_primary_style'] : 'primary';
                            $btn_primary_class = 'btn--' . $btn_primary_style;
                            $widget->add_link_attributes( 'btn_primary', $settings['btn_primary_link'] );
                            $widget->add_render_attribute( 'btn_primary', 'class', [ 'image-text-block__button', 'btn', $btn_primary_class ] );
                        ?>
                            <a <?php $widget->print_render_attribute_string( 'btn_primary' ); ?>>
                                <?php echo esc_html( $settings['btn_primary_text'] ); ?>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>

                        <!-- Secondary Button -->
                        <?php if ( 'yes' === $settings['show_btn_secondary'] && ! empty( $settings['btn_secondary_text'] ) ) : 
                            $btn_secondary_style = isset( $settings['btn_secondary_style'] ) ? $settings['btn_secondary_style'] : 'secondary';
                            $btn_secondary_class = 'btn--' . $btn_secondary_style;
                            $widget->add_link_attributes( 'btn_secondary', $settings['btn_secondary_link'] );
                            $widget->add_render_attribute( 'btn_secondary', 'class', [ 'image-text-block__button', 'btn', $btn_secondary_class ] );
                        ?>
                            <a <?php $widget->print_render_attribute_string( 'btn_secondary' ); ?>>
                                <?php echo esc_html( $settings['btn_secondary_text'] ); ?>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
		</div>
		<?php
	}
}
