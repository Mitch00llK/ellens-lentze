<?php
namespace EllensLentze\Widgets\Action_Buttons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Action Buttons Widget Wrapper.
 *
 * @package EllensLentze\Widgets\Action_Buttons
 * @since 1.0.0
 */
class Action_Buttons_Wrapper {

    public static function load() {
        require_once __DIR__ . '/action-buttons-widget.php';
    }
}
