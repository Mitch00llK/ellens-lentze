<?php
namespace EllensLentze\Widgets\Contact_Info\Includes\Render;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();


		// Get content settings
		$heading = isset( $settings['heading'] ) ? $settings['heading'] : '';
		$description = isset( $settings['description'] ) ? $settings['description'] : '';
		$address = isset( $settings['address'] ) ? $settings['address'] : '';
		$email   = isset( $settings['email'] ) ? $settings['email'] : '';
		$phone   = isset( $settings['phone'] ) ? $settings['phone'] : '';

		$widget->add_render_attribute( 'wrapper', 'class', 'contact-info' );

		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="contact-info__primary">
				<div class="contact-info__header">
					<?php if ( ! empty( $heading ) ) : ?>
						<h2 class="contact-info__heading"><?php echo esc_html( $heading ); ?></h2>
					<?php endif; ?>

					<?php if ( ! empty( $description ) ) : ?>
						<div class="contact-info__description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
					<?php endif; ?>
				</div>

				<div class="contact-info__items">
					<?php if ( ! empty( $address ) ) : ?>
						<div class="contact-info__item">
							<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
							<span><?php echo wp_kses_post( nl2br( $address ) ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $email ) ) : ?>
						<div class="contact-info__item">
							<i class="fas fa-envelope" aria-hidden="true"></i>
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $phone ) ) : ?>
						<div class="contact-info__item">
							<i class="fas fa-phone" aria-hidden="true"></i>
							<a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
						</div>
					<?php endif; ?>
				</div>


				<?php if ( ! empty( $settings['opening_hours_title'] ) || ! empty( $settings['opening_hours_list'] ) ) : ?>
					<div class="contact-info__hours-container">
						<?php if ( ! empty( $settings['opening_hours_title'] ) ) : ?>
							<h3 class="contact-info__hours-title"><?php echo esc_html( $settings['opening_hours_title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $settings['opening_hours_list'] ) ) : ?>
							<div class="contact-info__hours-list">
								<?php foreach ( $settings['opening_hours_list'] as $item ) : ?>
									<div class="contact-info__hours-item">
										<span class="contact-info__day"><?php echo esc_html( $item['day'] ); ?></span>
										<span class="contact-info__time"><?php echo esc_html( $item['hours'] ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $settings['opening_hours_footer'] ) ) : ?>
							<div class="contact-info__hours-footer">
								<?php echo wp_kses_post( wpautop( $settings['opening_hours_footer'] ) ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php
			$btw_number = $settings['btw_number'] ?? '';
			$bank_account_label = $settings['bank_account_label'] ?? '';
			$bank_account_details = $settings['bank_account_details'] ?? '';
			?>

			<?php if ( ! empty( $btw_number ) || ! empty( $bank_account_details ) ) : ?>
				<div class="contact-info__financial">
					<?php if ( ! empty( $btw_number ) ) : ?>
						<div class="contact-info__financial-item">
							<span class="contact-info__financial-label"><?php esc_html_e( 'BTW nummer', 'ellens-lentze' ); ?></span>
							<span class="contact-info__financial-value"><?php echo esc_html( $btw_number ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $bank_account_details ) ) : ?>
						<div class="contact-info__financial-item">
							<?php if ( ! empty( $bank_account_label ) ) : ?>
								<span class="contact-info__financial-label"><?php echo esc_html( $bank_account_label ); ?></span>
							<?php endif; ?>
							<span class="contact-info__financial-value"><?php echo wp_kses_post( $bank_account_details ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}
}
