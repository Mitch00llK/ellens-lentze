<?php
namespace EllensLentze\Widgets\Detailed_Info_Section\Includes\Render;

use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

		?>
		<section class="dis-section">
            <div class="dis-container">
                
                <!-- Main Content Area -->
                <div class="dis-content">
                    <?php 
                    $content_source = isset( $settings['content_source'] ) ? $settings['content_source'] : 'manual';
                    
                    if ( 'current_post' === $content_source ) : ?>
                        <div class="dis-content__block dis-content__post-content">
                            <?php 
                            // Use get_post_field to ensure we get the content of the current post loop/preview
                            // simpler than get_the_content() inside some widget contexts
                            $content = get_post_field( 'post_content', get_the_ID() );
                            echo apply_filters( 'the_content', $content ); 
                            ?>
                        </div>
                    <?php elseif ( ! empty( $settings['content_blocks'] ) ) : ?>
                        <?php foreach ( $settings['content_blocks'] as $block ) : ?>
                            <div class="dis-content__block">
                                <?php if ( ! empty( $block['block_title'] ) ) : ?>
                                    <h2 class="dis-content__title m-0"><?php echo esc_html( $block['block_title'] ); ?></h2>
                                <?php endif; ?>
                                <?php if ( ! empty( $block['block_content'] ) ) : ?>
                                    <div class="dis-content__text"><?php echo wp_kses_post( $block['block_content'] ); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Sidebar Sidebar -->
                <aside class="dis-sidebar">
                    <div class="dis-card">
                        <!-- Card Image -->
                        <div class="dis-card__image">
                            <?php if ( ! empty( $settings['card_image']['url'] ) ) : ?>
                                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'card_image' ); ?>
                            <?php endif; ?>
                        </div>

                        <!-- CTA Box -->
                        <div class="dis-card__cta p-lg">
                            <?php 
                            $card_type = isset( $settings['card_type'] ) ? $settings['card_type'] : 'cta';
                            
                            if ( 'contact' === $card_type ) : ?>
                                <!-- Contact Card Content -->
                                <?php if ( ! empty( $settings['card_title'] ) ) : ?>
                                    <h3 class="dis-card__title dis-card__title--contact"><?php echo esc_html( $settings['card_title'] ); ?></h3>
                                <?php endif; ?>

                                <?php if ( ! empty( $settings['contact_items'] ) ) : ?>
                                    <div class="dis-card__contact-list">
                                        <?php foreach ( $settings['contact_items'] as $item ) : ?>
                                            <div class="dis-contact-item">
                                                <?php if ( ! empty( $item['icon'] ) ) : ?>
                                                    <span class="dis-contact-item__icon">
                                                        <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                    </span>
                                                <?php endif; ?>
                                                
                                                <?php if ( ! empty( $item['link']['url'] ) ) : ?>
                                                    <a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="dis-contact-item__text dis-contact-item__link" <?php echo $widget->get_render_attribute_string( 'contact_link' ); ?>>
                                                        <?php echo esc_html( $item['text'] ); ?>
                                                    </a>
                                                <?php else : ?>
                                                    <span class="dis-contact-item__text">
                                                        <?php echo esc_html( $item['text'] ); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            <?php else : ?>
                                <!-- Standard CTA Content -->
                                <?php if ( ! empty( $settings['card_title'] ) ) : ?>
                                    <h3 class="dis-card__title m-0"><?php echo esc_html( $settings['card_title'] ); ?></h3>
                                <?php endif; ?>
                                <?php if ( ! empty( $settings['card_description'] ) ) : ?>
                                    <p class="dis-card__description m-0"><?php echo esc_html( $settings['card_description'] ); ?></p>
                                <?php endif; ?>
                                
                                <?php if ( ! empty( $settings['card_btn_text'] ) ) : 
                                    $widget->add_link_attributes( 'button', $settings['card_btn_link'] );
                                    $button_style = isset( $settings['button_style'] ) ? $settings['button_style'] : 'btn--primary';
                                    $widget->add_render_attribute( 'button', 'class', [ 'dis-card__button', 'btn', $button_style ] );
                                ?>
                                    <a <?php $widget->print_render_attribute_string( 'button' ); ?>>
                                        <?php echo esc_html( $settings['card_btn_text'] ); ?>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <!-- USPs -->
                        <?php if ( ! empty( $settings['usps'] ) ) : ?>
                            <ul class="dis-card__usps p-lg m-0">
                                <?php foreach ( $settings['usps'] as $usp ) : ?>
                                    <li class="dis-card__usp-item">
                                        <i class="fas fa-check" aria-hidden="true"></i>
                                        <span><?php echo esc_html( $usp['usp_text'] ); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </aside>

            </div>
		</section>
		<?php
	}
}
