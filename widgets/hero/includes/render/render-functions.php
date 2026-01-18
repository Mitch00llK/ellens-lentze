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
        } elseif ( 'image_overlap_card' === $layout ) {
            self::render_layout_image_overlap_card( $widget, $settings );
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
                 '<img src="%s" class="hero__card-pattern hero__svg-overlay" alt="%s" aria-hidden="true">',
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

                        <?php 
                        $show_description = isset( $settings['show_description'] ) ? $settings['show_description'] : 'yes';
                        if ( 'yes' === $show_description && ! empty( $description ) ) : ?>
                            <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $description ); ?></div>
                        <?php endif; ?>

                        <?php 
                        $show_button = isset( $settings['show_button'] ) ? $settings['show_button'] : 'yes';
                        if ( 'yes' === $show_button && ! empty( $button_text ) ) : ?>
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
     * Supports optional contact form on the right side when enabled.
     */
    public static function render_layout_full_width_blue( $widget, $settings ) {
        $subtitle = $settings['subtitle'];
        $title = $settings['title'];
        $description = $settings['description'];
        
        // Check if contact form is enabled
        $enable_contact_form = isset( $settings['enable_contact_form'] ) && 'yes' === $settings['enable_contact_form'];
        
        // Form Settings (only if form is enabled)
        $form_heading = '';
        $gravity_form_shortcode = '';
        
        if ( $enable_contact_form ) {
            $form_heading = isset( $settings['form_heading'] ) ? $settings['form_heading'] : '';
            $gravity_form_shortcode = isset( $settings['gravity_form_shortcode'] ) ? $settings['gravity_form_shortcode'] : '';
        }
        
        // Graphic Overlay (Building Pattern)
        if ( ! empty( $settings['graphic_overlay']['url'] ) ) {
            $overlay_url = esc_url( $settings['graphic_overlay']['url'] );
            $overlay_alt = \Elementor\Control_Media::get_image_alt( $settings['graphic_overlay'] );
            $pattern_class = $enable_contact_form ? 'hero-fw__pattern hero-fw__pattern--contact' : 'hero-fw__pattern';
             $graphic_html = sprintf( 
                '<img src="%s" class="%s" alt="%s" aria-hidden="true">',
                 $overlay_url,
                esc_attr( $pattern_class ),
                 esc_attr( $overlay_alt )
            );
        } else {
            $graphic_html = '';
        }

        // Add modifier class if contact form is enabled
        $wrapper_classes = [ 'hero', 'hero--template-full-width' ];
        if ( $enable_contact_form ) {
            $wrapper_classes[] = 'hero--template-full-width--with-form';
        }
        
        $widget->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
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

            <div class="hero-fw__container<?php echo $enable_contact_form ? ' hero-fw__container--with-form' : ''; ?>">
                <?php if ( $enable_contact_form ) : ?>
                    <!-- Two-column layout with contact form -->
                    <div class="hero-fw__left">
                        <div class="hero-fw__content">
                            <?php if ( ! empty( $subtitle ) ) : ?>
                                <p <?php $widget->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $subtitle ); ?></p>
                            <?php endif; ?>

                            <?php if ( ! empty( $title ) ) : ?>
                                <h1 <?php $widget->print_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $title ); ?></h1>
                            <?php endif; ?>

                            <?php 
                            $show_description = isset( $settings['show_description'] ) ? $settings['show_description'] : 'yes';
                            if ( 'yes' === $show_description && ! empty( $description ) ) : ?>
                                <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $description ); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Right Column: Contact Form -->
                    <div class="hero-fw__right">
                        <div class="hero-fw__form-card">
                            <?php if ( ! empty( $form_heading ) ) : ?>
                                <h3 class="hero-fw__form-heading"><?php echo esc_html( $form_heading ); ?></h3>
                            <?php endif; ?>
                            
                            <div class="hero-fw__form">
                                <?php 
                                if ( ! empty( $gravity_form_shortcode ) ) {
                                    echo do_shortcode( $gravity_form_shortcode );
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Single column layout (original full width blue) -->
                 <div class="hero-fw__content">
                    <?php if ( ! empty( $subtitle ) ) : ?>
                        <p <?php $widget->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>

                    <?php if ( ! empty( $title ) ) : ?>
                        <h1 <?php $widget->print_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $title ); ?></h1>
                    <?php endif; ?>

                        <?php 
                        $show_description = isset( $settings['show_description'] ) ? $settings['show_description'] : 'yes';
                        if ( 'yes' === $show_description && ! empty( $description ) ) : ?>
                        <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $description ); ?></div>
                    <?php endif; ?>
                    
                        <?php 
                        $show_button = isset( $settings['show_button'] ) ? $settings['show_button'] : 'no';
                        $button_text = isset( $settings['link_text'] ) ? $settings['link_text'] : '';
                        $button_url = isset( $settings['link_url'] ) ? $settings['link_url'] : [];
                        if ( 'yes' === $show_button && ! empty( $button_text ) ) : 
                            $button_style = isset( $settings['button_style'] ) ? $settings['button_style'] : 'primary';
                            $button_class = 'btn--' . $button_style;
                            $widget->add_render_attribute( 'button_fw', 'class', [ 'hero-fw__button', 'btn', $button_class ] );
                            if ( ! empty( $button_url['url'] ) ) {
                                $widget->add_link_attributes( 'button_fw', $button_url );
                            }
                        ?>
                            <a <?php $widget->print_render_attribute_string( 'button_fw' ); ?>>
                                <?php echo esc_html( $button_text ); ?>
                                <span class="hero-fw__button-icon" aria-hidden="true">
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        <?php endif; ?>
                 </div>
                <?php endif; ?>
            </div>

        </section>
        <?php
    }

    /**
     * Render Image Overlap Card Layout.
     * 
     * @since 1.1.0
     */
    public static function render_layout_image_overlap_card( $widget, $settings ) {
        $subtitle = $settings['subtitle'];
        $title = $settings['title'];
        $description = $settings['description'];
        
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
                 '<img src="%s" class="hero-ioc__pattern" alt="%s" aria-hidden="true">',
                 $overlay_url,
                 esc_attr( $overlay_alt )
            );
        } else {
            $graphic_html = '';
        }

        $widget->add_render_attribute( 'wrapper', 'class', [ 'hero', 'hero--template-ioc mb-xl' ] );
        $widget->add_render_attribute( 'title', 'class', 'hero-ioc__title' );
        $widget->add_render_attribute( 'subtitle', 'class', 'hero-ioc__subtitle' );
        $widget->add_render_attribute( 'description', 'class', 'hero-ioc__description' );

        ?>
        <section <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            
            <div class="hero-ioc__bg-container">
                 <?php if ( ! empty( $image_html ) ) : ?>
                     <div class="hero-ioc__bg-image-wrapper">
                          <?php echo $image_html; ?>
                     </div>
                 <?php endif; ?>
            </div>

            <div class="hero-ioc__container">
                <div class="hero-ioc__card">
                    <div class="hero-ioc__card-bg">
                        <?php if ( ! empty( $graphic_html ) ) echo $graphic_html; ?>
                    </div>
                    
                    <div class="hero-ioc__content">
                        <?php if ( ! empty( $subtitle ) ) : ?>
                            <p <?php $widget->print_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html( $subtitle ); ?></p>
                        <?php endif; ?>

                        <?php if ( ! empty( $title ) ) : ?>
                            <div class="hero-ioc__title-wrapper">
                                <h1 <?php $widget->print_render_attribute_string( 'title' ); ?>><?php echo wp_kses_post( $title ); ?></h1>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        $show_description = isset( $settings['show_description'] ) ? $settings['show_description'] : 'yes';
                        if ( 'yes' === $show_description && ! empty( $description ) ) : ?>
                             <div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( $description ); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </section>
        <?php
    }

}
