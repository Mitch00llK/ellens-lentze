<?php
namespace EllensLentze\Widgets\Services_Grid\Includes\Render;

use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Services_Grid {

	public static function render( $settings ) {
		// Output the widget styling
		?>
		<div class="ellens-services-grid pt-3xl pb-3xl w-full relative mx-auto">
            <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                <h2 class="ellens-services-grid__title"><?php echo esc_html( $settings['section_title'] ); ?></h2>
            <?php endif; ?>

            <div class="ellens-services-grid__container d-grid gap-lg w-full">
                <?php foreach ( $settings['cards_list'] as $card ) : ?>
                    <?php
                    // Skip hidden cards
                    if ( ! empty( $card['card_hide'] ) && 'yes' === $card['card_hide'] ) {
                        continue;
                    }

                    $has_link = ! empty( $card['card_link']['url'] );
                    $link_tag = $has_link ? 'a' : 'div';
                    $link_attrs = '';
                    $is_featured = ! empty( $card['card_is_featured'] ) && 'yes' === $card['card_is_featured'];
                    $show_as_image = ! empty( $card['card_show_as_image'] ) && 'yes' === $card['card_show_as_image'];
                    $card_classes = 'ellens-service-card';
                    
                    if ( $is_featured ) {
                        $card_classes .= ' ellens-service-card--featured';
                    }

                    if ( $show_as_image ) {
                        $card_classes .= ' ellens-service-card--image';
                    }

                    if ( $has_link ) {
                        $link_url = $card['card_link']['url'];
                        $link_target = $card['card_link']['is_external'] ? ' target="_blank"' : '';
                        $link_nofollow = $card['card_link']['nofollow'] ? ' rel="nofollow"' : '';
                        $link_attrs = ' href="' . esc_url( $link_url ) . '"' . $link_target . $link_nofollow;
                    }

                    // Only add padding if not showing as image
                    $padding_class = $show_as_image ? '' : ' p-xl';
                    ?>
                    <<?php echo $link_tag; ?> class="<?php echo esc_attr( $card_classes . $padding_class ); ?>"<?php echo $link_attrs; ?>>
                        <?php if ( $show_as_image && ! empty( $card['card_image']['id'] ) ) : ?>
                            <?php
                            $image_id = $card['card_image']['id'];
                            $image_size = 'full';
                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                            if ( empty( $image_alt ) ) {
                                $image_alt = ! empty( $card['card_title'] ) ? esc_attr( $card['card_title'] ) : '';
                            }
                            ?>
                            <div class="ellens-service-card__image-wrapper">
                                <?php echo wp_get_attachment_image( 
                                    $image_id, 
                                    $image_size, 
                                    false, 
                                    [ 
                                        'class' => 'ellens-service-card__image',
                                        'alt' => $image_alt
                                    ] 
                                ); ?>
                            </div>
                        <?php elseif ( $show_as_image && ! empty( $card['card_image']['url'] ) ) : ?>
                            <div class="ellens-service-card__image-wrapper">
                                <img 
                                    src="<?php echo esc_url( $card['card_image']['url'] ); ?>" 
                                    alt="<?php echo esc_attr( ! empty( $card['card_title'] ) ? $card['card_title'] : '' ); ?>" 
                                    class="ellens-service-card__image" 
                                />
                            </div>
                        <?php else : ?>
                            <?php if ( $is_featured && ! empty( $card['card_bg_graphic']['url'] ) ) : ?>
                                <div class="ellens-service-card__bg-graphic">
                                    <img src="<?php echo esc_url( $card['card_bg_graphic']['url'] ); ?>" alt="" aria-hidden="true" />
                                </div>
                            <?php endif; ?>

                            <div class="ellens-service-card__icon mb-sm">
                                <?php Icons_Manager::render_icon( $card['card_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                            <div class="ellens-service-card__content">
                                <?php if ( ! empty( $card['card_title'] ) ) : ?>
                                    <h3 class="ellens-service-card__title m-0"><?php echo esc_html( $card['card_title'] ); ?></h3>
                                <?php endif; ?>

                                <?php if ( ! empty( $card['card_description'] ) ) : ?>
                                    <div class="ellens-service-card__description">
                                        <?php echo wp_kses_post( $card['card_description'] ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="ellens-service-card__action">
                                 <div class="ellens-service-card__arrow">
                                    <div class="ellens-service-card__arrow-content">
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="ellens-service-card__arrow-hover">
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </<?php echo $link_tag; ?>>
                <?php endforeach; ?>
            </div>
		</div>
		<?php
	}
}
