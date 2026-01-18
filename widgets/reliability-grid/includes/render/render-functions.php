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

		<div class="ellens-rg">
			<?php if ( ! empty( $settings['main_title'] ) ) : ?>
				<h2 class="ellens-rg-title"><?php echo esc_html( $settings['main_title'] ); ?></h2>
			<?php endif; ?>

			<div class="ellens-rg-container">
				<!-- Left Features -->
				<div class="ellens-rg-column ellens-rg-column--left">
					<?php foreach ( $left_features as $index => $item ) : ?>
						<?php self::render_feature_item( $item ); ?>
					<?php endforeach; ?>
				</div>

				<!-- Center Image -->
				<div class="ellens-rg-column ellens-rg-column--center">
					<?php if ( ! empty( $settings['center_image']['url'] ) ) : ?>
						<div class="ellens-rg-image-wrapper">
							<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'center_image', 'center_image' ); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Right Features -->
				<div class="ellens-rg-column ellens-rg-column--right">
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
		<div class="ellens-rg-feature elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
			<div class="ellens-rg-feature__icon">
				<?php Icons_Manager::render_icon( $item['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
			<div class="ellens-rg-feature__content">
				<h3 class="ellens-rg-feature__title m-0">
					<span class="ellens-rg-feature__title-text"><?php echo esc_html( $item['feature_title'] ); ?></span>
					<?php if ( ! empty( $item['feature_subtitle'] ) ) : ?>
						<span class="ellens-rg-feature__subtitle"><?php echo esc_html( $item['feature_subtitle'] ); ?></span>
					<?php endif; ?>
				</h3>
				<?php if ( ! empty( $item['feature_description'] ) ) : ?>
					<p class="ellens-rg-feature__desc m-0"><?php echo esc_html( $item['feature_description'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
