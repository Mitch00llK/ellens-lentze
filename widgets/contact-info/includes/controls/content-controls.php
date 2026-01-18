<?php
namespace EllensLentze\Widgets\Contact_Info\Includes\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Content_Controls {

	public static function register( $widget ) {
        // Load split control files
        require_once __DIR__ . '/primary-contact-controls.php';
        require_once __DIR__ . '/opening-hours-controls.php';
        require_once __DIR__ . '/financial-controls.php';

        // Register each section
        Primary_Contact_Controls::register( $widget );
        Opening_Hours_Controls::register( $widget );
        Financial_Controls::register( $widget );
	}
}
