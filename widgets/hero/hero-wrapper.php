<?php
namespace EllensLentze\Widgets\Hero;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Hero Widget Wrapper.
 *
 * Ensures the widget class is loaded safely.
 *
 * @since 1.0.0
 */
class Hero_Wrapper {

    /**
     * Load the widget.
     *
     * @since 1.0.0
     * @return void
     */
    public static function load() {
        require_once __DIR__ . '/hero-widget.php';
    }
}
