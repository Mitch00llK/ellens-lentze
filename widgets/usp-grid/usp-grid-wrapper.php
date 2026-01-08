<?php
namespace EllensLentze\Widgets\USP_Grid;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * USP Grid Widget Wrapper.
 *
 * @since 1.0.0
 */
class USP_Grid_Wrapper {

    public static function load() {
        require_once __DIR__ . '/usp-grid-widget.php';
    }
}
