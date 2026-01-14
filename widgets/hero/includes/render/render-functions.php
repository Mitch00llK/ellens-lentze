<?php
namespace EllensLentze\Widgets\Hero\Includes\Render;

use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();
        $layout = isset( $settings['layout_template'] ) ? $settings['layout_template'] : 'default';

        if ( 'full_width_blue' === $layout ) {
            self::render_layout_full_width_blue( $widget, $settings );
        } else {
            self::render_layout_default( $widget, $settings );
        }
	}

    /**
     * Render Default Layout (Floating Card).
     */
    public static function render_layout_default( $widget, $settings ) {
        $subtitle = $settings['subtitle'];
        $title = $settings['title'];
        $description = $settings['description'];
        $button_text = $settings['link_text'];
        $button_url = $settings['link_url'];
        
        // Background Image
        if ( ! empty( $settings['image']['url'] ) ) {
            $image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image' );
		} else {
            $image_html = '';
        }

        // Graphic Overlay
        if ( ! empty( $settings['graphic_overlay']['url'] ) ) {
            $overlay_url = esc_url( $settings['graphic_overlay']['url'] );
            $overlay_alt = \Elementor\Control_Media::get_image_alt( $settings['graphic_overlay'] );
             $graphic_html = sprintf( 
                 '<img src="%s" class="hero__card-pattern ellens-hero-svg-overlay" alt="%s" aria-hidden="true">',
                 $overlay_url,
                 esc_attr( $overlay_alt )
            );
        } else {
            $graphic_html = '';
        }

        $widget->add_render_attribute( 'wrapper', 'class', 'hero' );
        $widget->add_render_attribute( 'title', 'class', 'hero__title' );
        $widget->add_render_attribute( 'subtitle', 'class', 'hero__subtitle' );
        $widget->add_render_attribute( 'description', 'class', 'hero__description' );
        
        // Button Attributes
        $button_style = isset( $settings['button_style'] ) ? $settings['button_style'] : 'primary';
        $button_class = 'btn--' . $button_style;
        $widget->add_render_attribute( 'button', 'class', [ 'hero__button', 'btn', $button_class ] );
        if ( ! empty( $button_url['url'] ) ) {
			$widget->add_link_attributes( 'button', $button_url );
		}

		?>
		<section <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            
            <div class="hero__bg-container">
                 <?php if ( ! empty( $image_html ) ) : ?>
                     <div class="hero__bg-image-wrapper">
                          <?php echo $image_html; ?>
                     </div>
                 <?php endif; ?>
            </div>

            <div class="hero__container">
                <?php 
                $show_card = isset( $settings['show_card_container'] ) ? $settings['show_card_container'] : 'yes';
                if ( 'yes' === $show_card ) : 
                ?>
                <div class="hero__card">
                     <div class="hero__card-bg">
                        <?php if ( ! empty( $graphic_html ) ) echo $graphic_html; ?>
                     </div>
                     
                     <div class="hero__content">
                        <?php if ( ! empty( $subtitle ) ) : ?>
                            <span <?php $widget->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $subtitle ); ?></span>
                        <?php endif; ?>

                        <?php if ( ! empty( $title ) ) : ?>
                            <h1 <?php $widget->print_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $title ); ?></h1>
                        <?php endif; ?>

                        <?php if ( ! empty( $description ) ) : ?>
                            <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $description ); ?></div>
                        <?php endif; ?>

                        <?php if ( ! empty( $button_text ) ) : ?>
                            <a <?php $widget->print_render_attribute_string( 'button' ); ?>>
                                <?php echo esc_html( $button_text ); ?>
                                <span class="hero__button-icon" aria-hidden="true">
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        <?php endif; ?>
                     </div>
                </div>
                <?php endif; ?>
            </div>

		</section>
		<?php
    }

    /**
     * Render Full Width Blue Layout.
     */
    public static function render_layout_full_width_blue( $widget, $settings ) {
        $subtitle = $settings['subtitle'];
        $title = $settings['title'];
        $description = $settings['description'];
        
        // Graphic Overlay (Building Pattern)
        if ( ! empty( $settings['graphic_overlay']['url'] ) ) {
            $overlay_url = esc_url( $settings['graphic_overlay']['url'] );
            $overlay_alt = \Elementor\Control_Media::get_image_alt( $settings['graphic_overlay'] );
             $graphic_html = sprintf( 
                 '<img src="%s" class="hero-fw__pattern" alt="%s" aria-hidden="true">',
                 $overlay_url,
                 esc_attr( $overlay_alt )
            );
        } else {
            $graphic_html = '';
        }

        $widget->add_render_attribute( 'wrapper', 'class', [ 'hero', 'hero--template-full-width' ] );
        $widget->add_render_attribute( 'title', 'class', 'hero-fw__title' );
        $widget->add_render_attribute( 'subtitle', 'class', 'hero-fw__subtitle' );
        $widget->add_render_attribute( 'description', 'class', 'hero-fw__description' );

        ?>
        <section <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            
            <div class="hero-fw__bg">
                 <!-- Background Color handled by CSS, Pattern Overlay here -->
                 <div class="hero-fw__pattern-container">
                     <?php if ( ! empty( $graphic_html ) ) echo $graphic_html; ?>
                 </div>
            </div>

            <div class="hero-fw__container">
                 <div class="hero-fw__content">
                    <?php if ( ! empty( $subtitle ) ) : ?>
                        <p <?php $widget->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>

                    <?php if ( ! empty( $title ) ) : ?>
                        <h1 <?php $widget->print_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $title ); ?></h1>
                    <?php endif; ?>

                    <?php if ( ! empty( $description ) ) : ?>
                        <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $description ); ?></div>
                    <?php endif; ?>
                    
                    <!-- No button in this specific layout based on Figma, but description can contain links -->
                 </div>
            </div>

        </section>
        <?php
    }
}
