<?php
namespace EllensLentze\Widgets\Hero\Includes\Render;

use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render( $widget ) {
		$settings = $widget->get_settings_for_display();

        $subtitle = $settings['subtitle'];
        $title = $settings['title'];
        $description = $settings['description'];
        $button_text = $settings['link_text'];
        $button_url = $settings['link_url'];
        
        // Background Image
        if ( ! empty( $settings['image']['url'] ) ) {
			$widget->add_render_attribute( 'image_wrapper', 'class', 'hero__bg-image-wrapper' );
            $image_html =   \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image' );
		} else {
            $image_html = '';
        }

        // Graphic Overlay
        if ( ! empty( $settings['graphic_overlay']['url'] ) ) {
            // Check if SVG
            $ext = pathinfo($settings['graphic_overlay']['url'], PATHINFO_EXTENSION);
            if( $ext === 'svg' ) {
                 $graphic_html = \Elementor\Utils::get_image_html( $settings, 'graphic_overlay', 'graphic_overlay', [ 'class' => 'hero__card-pattern' ] );
            } else {
                 $graphic_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'graphic_overlay' );
            }
        } else {
            $graphic_html = '';
        }

        $widget->add_render_attribute( 'wrapper', 'class', 'hero' );
        $widget->add_render_attribute( 'title', 'class', 'hero__title' );
        $widget->add_render_attribute( 'subtitle', 'class', 'hero__subtitle' );
        $widget->add_render_attribute( 'description', 'class', 'hero__description' );
        
        // Button Attributes
        $widget->add_render_attribute( 'button', 'class', 'hero__button' );
        if ( ! empty( $button_url['url'] ) ) {
			$widget->add_link_attributes( 'button', $button_url );
		}

		?>
		<section <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            
            <div class="hero__bg-container">
                 <?php // If image_html is not standard img logic (Elementor output includes wrapper often), we might just output it. 
                       // Actually getting raw URL for background-image is often better for cover, but 
                       // for standard SEO img element:
                       if ( ! empty( $image_html ) ) : ?>
                           <div class="hero__bg-image-wrapper">
                                <?php echo $image_html; ?>
                           </div>
                       <?php endif; ?>
            </div>

            <div class="hero__container">
                <div class="hero__card">
                     <div class="hero__card-bg">
                        <?php if ( ! empty( $graphic_html ) ) echo $graphic_html; ?>
                     </div>
                     <div class="hero__content">
                        <?php if ( ! empty( $subtitle ) ) : ?>
                            <span <?php $widget->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $subtitle ); ?></span>
                        <?php endif; ?>

                        <?php if ( ! empty( $title ) ) : ?>
                            <h2 <?php $widget->print_render_attribute_string( 'title' ); ?>><?php echo $title; // Term 'Title' allows standard HTML ?></h2>
                        <?php endif; ?>

                        <?php if ( ! empty( $description ) ) : ?>
                            <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo $description; // WYSIWYG output ?></div>
                        <?php endif; ?>

                        <?php if ( ! empty( $button_text ) ) : ?>
                            <a <?php $widget->print_render_attribute_string( 'button' ); ?>>
                                <?php echo esc_html( $button_text ); ?>
                                <span class="hero__button-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7H13M13 7L7 1M13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </a>
                        <?php endif; ?>
                     </div>
                </div>
            </div>

		</section>
		<?php
	}
}
