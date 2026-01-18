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

		$widget->add_render_attribute( 'wrapper', 'class', 'contact-info d-flex flex-row flex-wrap items-start gap-md w-full' );
		$widget->add_render_attribute( 'primary', 'class', 'contact-info__primary d-flex flex-column gap-md' );
		$widget->add_render_attribute( 'header', 'class', 'contact-info__header d-flex flex-column items-start gap-md w-full flex-shrink-0' );
		$widget->add_render_attribute( 'heading', 'class', 'contact-info__heading m-0' );
		$widget->add_render_attribute( 'description', 'class', 'contact-info__description m-0' );
		$widget->add_render_attribute( 'items', 'class', 'contact-info__items d-flex flex-column items-start gap-sm flex-shrink-0' );
		$widget->add_render_attribute( 'item', 'class', 'contact-info__item d-flex items-start gap-sm max-w-full' );
		$widget->add_render_attribute( 'hours-container', 'class', 'contact-info__hours-container d-flex flex-column justify-center w-full' );
		$widget->add_render_attribute( 'hours-title', 'class', 'contact-info__hours-title m-0' );
		$widget->add_render_attribute( 'hours-list', 'class', 'contact-info__hours-list d-flex flex-column w-full' );
		$widget->add_render_attribute( 'hours-item', 'class', 'contact-info__hours-item d-flex justify-start' );
		$widget->add_render_attribute( 'financial', 'class', 'contact-info__financial d-flex flex-column gap-sm mt-md max-w-full' );
		$widget->add_render_attribute( 'financial-item', 'class', 'contact-info__financial-item d-flex flex-column' );
		$widget->add_render_attribute( 'financial-label', 'class', 'contact-info__financial-label m-0' );
		$widget->add_render_attribute( 'financial-value', 'class', 'contact-info__financial-value m-0' );

		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
			<div <?php $widget->print_render_attribute_string( 'primary' ); ?>>
				<div <?php $widget->print_render_attribute_string( 'header' ); ?>>
					<?php if ( ! empty( $heading ) ) : ?>
						<h2 <?php $widget->print_render_attribute_string( 'heading' ); ?>><?php echo esc_html( $heading ); ?></h2>
					<?php endif; ?>

					<?php if ( ! empty( $description ) ) : ?>
						<div <?php $widget->print_render_attribute_string( 'description' ); ?>><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
					<?php endif; ?>
				</div>

				<div <?php $widget->print_render_attribute_string( 'items' ); ?>>
					<?php if ( ! empty( $address ) ) : ?>
						<div <?php $widget->print_render_attribute_string( 'item' ); ?>>
							<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
							<span><?php echo wp_kses_post( nl2br( $address ) ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $email ) ) : ?>
						<div <?php $widget->print_render_attribute_string( 'item' ); ?>>
							<i class="fas fa-envelope" aria-hidden="true"></i>
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $phone ) ) : ?>
						<div <?php $widget->print_render_attribute_string( 'item' ); ?>>
							<i class="fas fa-phone" aria-hidden="true"></i>
							<a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
						</div>
					<?php endif; ?>
				</div>


				<?php if ( ! empty( $settings['opening_hours_title'] ) || ! empty( $settings['opening_hours_list'] ) ) : ?>
					<div <?php $widget->print_render_attribute_string( 'hours-container' ); ?>>
						<?php if ( ! empty( $settings['opening_hours_title'] ) ) : ?>
							<h3 <?php $widget->print_render_attribute_string( 'hours-title' ); ?>><?php echo esc_html( $settings['opening_hours_title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $settings['opening_hours_list'] ) ) : ?>
							<div <?php $widget->print_render_attribute_string( 'hours-list' ); ?>>
								<?php foreach ( $settings['opening_hours_list'] as $item ) : ?>
									<div <?php $widget->print_render_attribute_string( 'hours-item' ); ?>>
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
				<div <?php $widget->print_render_attribute_string( 'financial' ); ?>>
					<?php if ( ! empty( $btw_number ) ) : ?>
						<div <?php $widget->print_render_attribute_string( 'financial-item' ); ?>>
							<span <?php $widget->print_render_attribute_string( 'financial-label' ); ?>><?php esc_html_e( 'BTW nummer', 'ellens-lentze' ); ?></span>
							<span <?php $widget->print_render_attribute_string( 'financial-value' ); ?>><?php echo esc_html( $btw_number ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $bank_account_details ) ) : ?>
						<div <?php $widget->print_render_attribute_string( 'financial-item' ); ?>>
							<?php if ( ! empty( $bank_account_label ) ) : ?>
								<span <?php $widget->print_render_attribute_string( 'financial-label' ); ?>><?php echo esc_html( $bank_account_label ); ?></span>
							<?php endif; ?>
							<span <?php $widget->print_render_attribute_string( 'financial-value' ); ?>><?php echo wp_kses_post( $bank_account_details ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}
}
