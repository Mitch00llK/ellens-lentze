<?php
namespace EllensLentze\Widgets\Footer\Includes\Render;

use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( Widget_Base $widget ) {
		$settings = $widget->get_settings_for_display();

        // Data Prep
        $address = $settings['address'];
        $email   = $settings['email'];
        $phone   = $settings['phone'];
        
        $cols = [ 'col2', 'col3', 'col4' ];

		?>
		<footer class="footer mt-3xl ">
            <div class="footer__container d-flex justify-between gap-3xl mx-auto w-full p-container-desktop">
                
                <!-- COL 1: Brand & Contact -->
                <div class="footer__col footer__col--brand d-flex flex-column gap-md shrink-0">
                    <div class="footer__logo-wrapper">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'logo' ); ?>
                    </div>
                    
                    <div class="footer__contact d-flex flex-column gap-sm">
                        <?php if ( ! empty( $address ) ) : ?>
                            <div class="footer__contact-item d-flex items-center gap-sm">
                                <i class="fas fa-map" aria-hidden="true"></i>
                                <span><?php echo wp_kses_post( $address ); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $email ) ) : ?>
                            <div class="footer__contact-item d-flex items-center gap-sm">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $phone ) ) : ?>
                            <div class="footer__contact-item d-flex items-center gap-sm">
                                <i class="fas fa-phone-alt" aria-hidden="true"></i>
                                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- COLS 2-4: Menus -->
                <?php foreach ( $cols as $col_id ) : 
                    $title   = $settings[ $col_id . '_title' ];
                    $menu_id = isset( $settings[ $col_id . '_menu' ] ) ? $settings[ $col_id . '_menu' ] : false;
                ?>
                    <div class="footer__col footer__col--menu d-flex flex-column gap-md flex-1">
                        <?php if ( ! empty( $title ) ) : ?>
                            <h4 class="footer__title"><?php echo esc_html( $title ); ?></h4>
                        <?php endif; ?>

                        <?php 
                        if ( $menu_id ) {
                            $menu_items = wp_get_nav_menu_items( $menu_id );
                            
                            if ( ! empty( $menu_items ) && ! is_wp_error( $menu_items ) ) : ?>
                                <ul class="footer__menu p-0 m-0 d-flex flex-column gap-sm">
                                    <?php foreach ( $menu_items as $item ) : 
                                        // Skip if not a valid object
                                        if ( empty( $item->url ) ) continue;
                                    ?>
                                        <li class="footer__menu-item">
                                            <a href="<?php echo esc_url( $item->url ); ?>" class="footer__menu-link">
                                                <?php echo esc_html( $item->title ); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; 
                        } ?>
                    </div>
                <?php endforeach; ?>

                <!-- Floating CTA -->
                <?php if ( ! empty( $settings['cta_text'] ) ) : 
                        $widget->add_link_attributes( 'cta_link', $settings['cta_link'] );
                ?>
                    <div class="footer__cta-wrapper">
                        <a <?php $widget->print_render_attribute_string( 'cta_link' ); ?> class="btn btn--secondary">
                            <?php echo esc_html( $settings['cta_text'] ); ?>
                            <i class="far fa-file-alt" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
            
		</footer>
		<?php
	}
}
