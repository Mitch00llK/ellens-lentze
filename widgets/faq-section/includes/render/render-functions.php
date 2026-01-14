<?php
/**
 * Render functions for FAQ Section widget.
 */

namespace EllensLentze\Widgets\FAQ_Section\Includes\Render;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

		?>
		<section class="faq-section" itemscope itemtype="https://schema.org/FAQPage">
			<div class="faq-container">
				
				<!-- Left Content -->
				<div class="faq-content">
					<?php if ( ! empty( $settings['title'] ) ) : ?>
						<h2 class="faq-content__title"><?php echo esc_html( $settings['title'] ); ?></h2>
					<?php endif; ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<div class="faq-content__description"><?php echo wp_kses_post( $settings['description'] ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $settings['btn_text'] ) && ! empty( $settings['btn_link']['url'] ) ) : 
						$button_style = isset( $settings['button_style'] ) ? $settings['button_style'] : 'primary';
						$button_class = 'btn--' . $button_style;
						$widget->add_link_attributes( 'button', $settings['btn_link'] );
						$widget->add_render_attribute( 'button', 'class', [ 'faq-content__button', 'btn', $button_class ] );
					?>
						<a <?php $widget->print_render_attribute_string( 'button' ); ?>>
							<?php echo esc_html( $settings['btn_text'] ); ?>
						</a>
					<?php endif; ?>
				</div>

				<!-- Right Accordion -->
				<div class="faq-accordion">
					<?php if ( ! empty( $settings['faq_items'] ) ) : ?>
						<?php foreach ( $settings['faq_items'] as $index => $item ) : 
							$id = 'faq-item-' . $index . '-' . $widget->get_id();
						?>
							<div class="faq-accordion__item" id="<?php echo esc_attr( $id ); ?>" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
								<button class="faq-accordion__header" aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>-content">
									<span class="faq-accordion__title" itemprop="name"><?php echo esc_html( $item['question'] ); ?></span>
									<span class="faq-accordion__icon"><i class="fas fa-chevron-down" aria-hidden="true"></i></span>
								</button>
								<div class="faq-accordion__content" id="<?php echo esc_attr( $id ); ?>-content" hidden itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
									<div class="faq-accordion__inner" itemprop="text">
										<?php echo wp_kses_post( $item['answer'] ); ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

			</div>
		</section>
		<?php
	}
}
