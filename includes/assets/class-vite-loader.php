<?php
namespace EllensLentze\Includes\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Vite_Loader {

    private static $instance = null;
    private $manifest = null;
    private $is_dev = false;
    private $dist_path;
    private $dist_url;

    public function __construct() {
        $base_path = dirname( dirname( __DIR__ ) );
        $this->dist_path = $base_path . '/assets/dist';
        $this->dist_url = plugins_url( 'assets/dist', $base_path . '/ellens-lentze.php' );
        
        // Normalize path (resolve any relative paths) - only if path exists
        $resolved_path = realpath( $this->dist_path );
        if ( $resolved_path !== false ) {
            $this->dist_path = $resolved_path;
        }
        
        // Check for explicit dev mode flag
        if ( defined( 'VITE_DEV_MODE' ) && VITE_DEV_MODE ) {
            $this->is_dev = true;
            return;
        }
        
        // Check if manifest exists - if it does, we're in production mode
        $manifest_path_vite = $this->dist_path . '/.vite/manifest.json';
        $manifest_path_root = $this->dist_path . '/manifest.json';
        
        $manifest_vite_exists = file_exists( $manifest_path_vite );
        $manifest_root_exists = file_exists( $manifest_path_root );
        
        if ( $manifest_vite_exists || $manifest_root_exists ) {
            // Manifest exists, we're in production mode
            $this->is_dev = false;
            $this->load_manifest();
            
            // Double-check: if manifest failed to load, fall back to dev mode
            if ( ! $this->manifest ) {
                if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                    error_log( 'Vite Loader: Manifest file exists but failed to load. Falling back to dev mode. Path: ' . ( $manifest_vite_exists ? $manifest_path_vite : $manifest_path_root ) );
                }
                $this->is_dev = true;
            }
        } else {
            // No manifest found, assume dev mode
            if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                error_log( 'Vite Loader: No manifest found. Checked: ' . $manifest_path_vite . ' and ' . $manifest_path_root . '. Using dev mode.' );
            }
            $this->is_dev = true;
        }
    }

    public static function get_instance() {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function load_manifest() {
        $manifest_path = $this->dist_path . '/.vite/manifest.json'; // Vite 5+ puts it in .vite
        if ( ! file_exists( $manifest_path ) ) {
             $manifest_path = $this->dist_path . '/manifest.json'; // Fallback
        }

        if ( file_exists( $manifest_path ) ) {
            $manifest_content = file_get_contents( $manifest_path );
            $this->manifest = json_decode( $manifest_content, true );
            
            // Check if JSON decode failed
            if ( json_last_error() !== JSON_ERROR_NONE ) {
                error_log( 'Vite Loader: Failed to parse manifest.json - ' . json_last_error_msg() );
                $this->manifest = null;
            }
        } else {
            error_log( 'Vite Loader: Manifest file not found at ' . $manifest_path );
        }
    }

    /**
     * Enqueue a style via Vite
     */
    public static function enqueue_style( $handle, $entry_key, $deps = [], $ver = '1.0.0', $media = 'all' ) {
        $instance = self::get_instance();
        $url = $instance->get_asset_url( $entry_key, 'css' );

         if ( $url ) {
            // In dev mode, Vite serves the file as is requested.
            // In build mode, we might get an array of css files for an entry, but usually just one for simple css entries.
            // If it's a JS entry that imports CSS, Vite manifest handles that differently.
            // Here we assume $entry_key points to a CSS file in the input config.
             wp_enqueue_style( $handle, $url, $deps, $instance->is_dev ? time() : $ver, $media );
         }
    }
    
    /**
    * Register a style via Vite (but don't enqueue yet)
    */
    public static function register_style( $handle, $entry_key, $deps = [], $ver = '1.0.0', $media = 'all' ) {
         $instance = self::get_instance();
         $url = $instance->get_asset_url( $entry_key, 'css' );
 
          if ( $url ) {
              wp_register_style( $handle, $url, $deps, $instance->is_dev ? time() : $ver, $media );
          }
    }

    /**
     * Enqueue a script via Vite
     */
    /**
     * Enqueue a script via Vite
     * 
     * @param string $handle
     * @param string $entry_key relative path to file
     * @param array $deps
     * @param string $ver
     * @param array|bool $args Script arguments (in_footer bool or array with strategy)
     */
    public static function enqueue_script( $handle, $entry_key, $deps = [], $ver = '1.0.0', $args = [] ) {
        $instance = self::get_instance();
        
        // Backwards compatibility for bool $args
        if ( is_bool( $args ) ) {
            $args = [ 'in_footer' => $args ];
        }
        
        // Default to defer if not specified
        if ( ! isset( $args['strategy'] ) && ! isset( $args['in_footer'] ) ) {
             $args['strategy'] = 'defer';
             $args['in_footer'] = true;
        }

        if ( $instance->is_dev ) {
            // In dev mode, we need to enqueue the client first if not already done
            if ( ! wp_script_is( 'vite-client', 'enqueued' ) ) {
                wp_enqueue_script( 'vite-client', 'http://localhost:5173/@vite/client', [], null, false );
            }
        }

        $url = $instance->get_asset_url( $entry_key, 'js' );
        if ( $url ) {
            wp_enqueue_script( $handle, $url, $deps, $instance->is_dev ? time() : $ver, $args );
            
             // If we are in dev mode, we need to treat it as a module
            if ( $instance->is_dev ) {
                add_filter( 'script_loader_tag', [ $instance, 'filter_script_loader_tag' ], 10, 3 );
            }
        }
    }

    private function get_manifest_entry( $entry_key ) {
        if ( ! $this->manifest || ! isset( $this->manifest[ $entry_key ] ) ) {
            return null;
        }
        return $this->manifest[ $entry_key ];
    }

    /**
     * Register a style that is generated/extracted from a JS entry (e.g. imported CSS).
     */
    public static function register_style_from_js_entry( $handle, $entry_key, $deps = [], $ver = '1.0.0', $media = 'all' ) {
         $instance = self::get_instance();
         
         if ( $instance->is_dev ) {
             // In dev mode, CSS is injected by JS. We register a placeholder handle so dependencies don't break.
             wp_register_style( $handle, false, $deps, $ver, $media );
             return;
         }
         
         $entry = $instance->get_manifest_entry( $entry_key );
         if ( $entry && ! empty( $entry['css'] ) ) {
             // Register the first CSS file found
             $css_file = $entry['css'][0];
             $css_url = $instance->dist_url . '/' . $css_file;
             wp_register_style( $handle, $css_url, $deps, $instance->is_dev ? time() : $ver, $media );
         } else {
             // Fallback if no CSS found (prevent broken deps)
             wp_register_style( $handle, false, $deps, $ver, $media );
         }
    }

    /**
     * Register a script via Vite
     */
    public static function register_script( $handle, $entry_key, $deps = [], $ver = '1.0.0', $args = [] ) {
        $instance = self::get_instance();

        // Backwards compatibility for bool $args
        if ( is_bool( $args ) ) {
            $args = [ 'in_footer' => $args ];
        }

        // Default to defer if not specified
        if ( ! isset( $args['strategy'] ) && ! isset( $args['in_footer'] ) ) {
             $args['strategy'] = 'defer';
             $args['in_footer'] = true;
        }

        // Note: CSS dependencies from Manifest are now handled explicitly via register_style_from_js_entry
        // avoiding invalid script dependencies.

        $url = $instance->get_asset_url( $entry_key, 'js' );
        if ( $url ) {
            wp_register_script( $handle, $url, $deps, $instance->is_dev ? time() : $ver, $args );
             if ( $instance->is_dev ) {
                add_filter( 'script_loader_tag', [ $instance, 'filter_script_loader_tag' ], 10, 3 );
            }
        }
    }


    public function filter_script_loader_tag( $tag, $handle, $src ) {
        if ( strpos( $src, 'localhost:5173' ) !== false ) {
            // Add type="module"
            $tag = str_replace( '<script ', '<script type="module" ', $tag );
        }
        return $tag;
    }

    private function get_asset_url( $entry_key, $type = 'js' ) {
        if ( $this->is_dev ) {
            return 'http://localhost:5173/' . $entry_key;
        }

        // Production mode - must have manifest
        if ( ! $this->manifest ) {
            if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                error_log( 'Vite Loader: get_asset_url called in production mode but manifest is null. Entry: ' . $entry_key );
            }
            return null;
        }

        // Check if entry exists in manifest
        if ( isset( $this->manifest[ $entry_key ] ) ) {
            $entry = $this->manifest[ $entry_key ];
            $file = $entry['file']; // e.g., 'assets/hero.12345.css'
            $url = $this->dist_url . '/' . $file;
            
            if ( defined( 'WP_DEBUG' ) && WP_DEBUG && defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
                error_log( 'Vite Loader: Resolved ' . $entry_key . ' to ' . $url );
            }
            
            return $url;
        }
        
        // Entry not found in manifest
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( 'Vite Loader: Entry "' . $entry_key . '" not found in manifest. Available keys: ' . implode( ', ', array_keys( $this->manifest ) ) );
        }
        
        return null; 
    }
}
