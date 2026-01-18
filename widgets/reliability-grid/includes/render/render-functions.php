<?php
namespace EllensLentze\Widgets\Reliability_Grid\Includes\Render;

use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render Functions for Reliability Grid.
 */
class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();
		$features = $settings['features_list'];
		
		// Split features into two groups for left and right side
		$left_features = array_slice( $features, 0, 2 );
		$right_features = array_slice( $features, 2 );
		?>

		<div class="feature-grid p-md">
			<?php if ( ! empty( $settings['main_title'] ) ) : ?>
				<h2 class="feature-grid__title"><?php echo esc_html( $settings['main_title'] ); ?></h2>
			<?php endif; ?>

			<div class="feature-grid__container">
				<!-- Left Features -->
				<div class="feature-grid__column feature-grid__column--left">
					<?php foreach ( $left_features as $index => $item ) : ?>
						<?php self::render_feature_item( $item ); ?>
					<?php endforeach; ?>
				</div>

				<!-- Center Image -->
				<div class="feature-grid__column feature-grid__column--center">
					<?php if ( ! empty( $settings['center_image']['url'] ) ) : ?>
						<div class="feature-grid__image-wrapper">
							<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'center_image', 'center_image' ); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Right Features -->
				<div class="feature-grid__column feature-grid__column--right">
					<?php foreach ( $right_features as $index => $item ) : ?>
						<?php self::render_feature_item( $item ); ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php
	}

	private static function render_feature_item( $item ) {
		?>
		<div class="feature-grid__item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
			<div class="feature-grid__item-icon">
				<?php Icons_Manager::render_icon( $item['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
			<div class="feature-grid__item-content">
				<h3 class="feature-grid__item-title m-0">
					<span class="feature-grid__item-title-text"><?php echo esc_html( $item['feature_title'] ); ?></span>
					<?php if ( ! empty( $item['feature_subtitle'] ) ) : ?>
						<span class="feature-grid__item-subtitle"><?php echo esc_html( $item['feature_subtitle'] ); ?></span>
					<?php endif; ?>
				</h3>
				<?php if ( ! empty( $item['feature_description'] ) ) : ?>
					<p class="feature-grid__item-desc m-0"><?php echo esc_html( $item['feature_description'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
