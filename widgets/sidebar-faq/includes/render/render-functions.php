<?php
namespace EllensLentze\Widgets\Sidebar_FAQ\Includes\Render;

use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

		?>
		<section class="sidebar-faq-section">
            <div class="sidebar-faq-container d-flex items-start mx-auto gap-3xl">
                
                <!-- Sidebar Sidebar (Moved to Left) -->
                <aside class="sidebar-faq-sidebar w-30 shrink-0">
                    <div class="dis-card">
                        <!-- Card Image -->
                        <?php if ( isset( $settings['show_card_image'] ) && 'yes' === $settings['show_card_image'] ) : ?>
                            <div class="dis-card__image">
                                <?php if ( ! empty( $settings['card_image']['id'] ) ) : ?>
                                    <?php echo wp_get_attachment_image( $settings['card_image']['id'], 'full' ); ?>
                                <?php elseif ( ! empty( $settings['card_image']['url'] ) ) : ?>
                                    <img src="<?php echo esc_url( $settings['card_image']['url'] ); ?>" alt="">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- CTA Box -->
                        <div class="dis-card__cta">
                            <?php if ( ! empty( $settings['card_title'] ) ) : ?>
                                <h3 class="dis-card__title"><?php echo esc_html( $settings['card_title'] ); ?></h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['card_description'] ) ) : ?>
                                <p class="dis-card__description"><?php echo esc_html( $settings['card_description'] ); ?></p>
                            <?php endif; ?>
                            
                            <?php if ( isset( $settings['show_card_button'] ) && 'yes' === $settings['show_card_button'] && ! empty( $settings['card_btn_text'] ) ) : 
                                $widget->add_link_attributes( 'button', $settings['card_btn_link'] );
                                $button_style = isset( $settings['button_style'] ) ? $settings['button_style'] : 'btn--primary';
                                $widget->add_render_attribute( 'button', 'class', [ 'dis-card__button', 'btn', $button_style ] );
                            ?>
                                <a <?php $widget->print_render_attribute_string( 'button' ); ?>>
                                    <?php echo esc_html( $settings['card_btn_text'] ); ?>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Manual USPs Removed -->

                        <!-- Generated Navigation (from Sections) -->
                        <?php 
                        $sections = array_filter( $settings['faq_items'], function( $item ) {
                            return isset( $item['item_type'] ) && $item['item_type'] === 'section';
                        });
                        
                        if ( ! empty( $sections ) ) : ?>
                            <nav class="sidebar-faq__nav">
                                <ul class="sidebar-faq__nav-list d-flex flex-column gap-sm">
                                    <?php foreach ( $sections as $section ) : 
                                        $sec_id = ! empty( $section['section_id'] ) ? $section['section_id'] : sanitize_title( $section['section_title'] );
                                    ?>
                                        <li class="sidebar-faq__nav-item">
                                            <a href="#<?php echo esc_attr( $sec_id ); ?>" class="sidebar-faq__nav-link">
                                                <?php echo esc_html( $section['section_title'] ); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    </div>
                </aside>

                <!-- FAQ Content Area (Right) -->
                <div class="sidebar-faq-content flex-1">
                    <?php if ( ! empty( $settings['title'] ) ) : ?>
                        <h2 class="sidebar-faq-title"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <p class="sidebar-faq-description"><?php echo esc_html( $settings['description'] ); ?></p>
                    <?php endif; ?>

                    <div class="faq-accordion" role="tablist">
                        <?php foreach ( $settings['faq_items'] as $index => $item ) : 
                            // Handle Section Header
                            if ( isset( $item['item_type'] ) && $item['item_type'] === 'section' ) :
                                $sec_id = ! empty( $item['section_id'] ) ? $item['section_id'] : sanitize_title( $item['section_title'] );
                                ?>
                                <h3 id="<?php echo esc_attr( $sec_id ); ?>" class="sidebar-faq__section-header">
                                    <?php echo esc_html( $item['section_title'] ); ?>
                                </h3>
                                <?php
                                continue; // Skip accordion markup for sections
                            endif;

                            // Handle Question Item (Default)
                            $tab_count = $index + 1;
                            $tab_id = 'elementor-tab-title-' . $widget->get_id() . $tab_count;
                            $content_id = 'elementor-tab-content-' . $widget->get_id() . $tab_count;
                        ?>
                            <div class="faq-accordion__item" id="<?php echo esc_attr( $tab_id ); ?>" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
                                <button class="faq-accordion__header" 
                                        type="button"
                                        aria-expanded="false" 
                                        aria-controls="<?php echo esc_attr( $content_id ); ?>">
                                    <span class="faq-accordion__title" itemprop="name">
                                        <?php echo esc_html( $item['question'] ); ?>
                                    </span>
                                    <span class="faq-accordion__icon"><i class="fas fa-plus" aria-hidden="true"></i></span>
                                </button>
                                <div class="faq-accordion__content" 
                                     id="<?php echo esc_attr( $content_id ); ?>" 
                                     hidden 
                                     itemprop="acceptedAnswer" 
                                     itemscope 
                                     itemtype="https://schema.org/Answer">
                                    <div class="faq-accordion__inner" itemprop="text">
                                        <?php echo wp_kses_post( $item['answer'] ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
		</section>
		<?php
	}
}
