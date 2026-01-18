<?php
namespace EllensLentze\Widgets\Image_Text_Block;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Image Text Block Widget Wrapper.
 *
 * @package EllensLentze\Widgets\Image_Text_Block
 * @since 1.0.0
 */
class Image_Text_Block_Wrapper {

    public static function load() {
        require_once __DIR__ . '/image-text-block-widget.php';
    }
}
