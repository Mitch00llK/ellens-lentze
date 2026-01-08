<?php
namespace EllensLentze\Widgets\Services_Cluster;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Services Cluster Widget Wrapper.
 *
 * @since 1.0.0
 */
class Services_Cluster_Wrapper {

    public static function load() {
        require_once __DIR__ . '/services-cluster-widget.php';
    }
}
