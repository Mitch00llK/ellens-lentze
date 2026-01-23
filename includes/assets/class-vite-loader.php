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
        $this->dist_path = dirname( dirname( __DIR__ ) ) . '/assets/dist';
        $this->dist_url = plugins_url( 'assets/dist', dirname( dirname( __DIR__ ) ) . '/ellens-lentze.php' );
        
        // rudimentary dev check: if dist folder doesn't exist or we have a flag, assume dev.
        // Better: check if port 5173 is accessible or use a simpler WP_DEBUG check for now + check for absence of manifest.
        // For this implementation, we'll try to load manifest. If it fails or if specific constant is set, we use dev.
        
        if ( defined( 'VITE_DEV_MODE' ) && VITE_DEV_MODE ) {
            $this->is_dev = true;
        } elseif ( ! file_exists( $this->dist_path . '/.vite/manifest.json' ) && ! file_exists( $this->dist_path . '/manifest.json' )  ) {
             // If no manifest, likely in dev mode or fresh clone
            $this->is_dev = true;
        }
        
        if ( ! $this->is_dev ) {
             $this->load_manifest();
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
            $this->manifest = json_decode( file_get_contents( $manifest_path ), true );
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
    public static function enqueue_script( $handle, $entry_key, $deps = [], $ver = '1.0.0', $in_footer = true ) {
        $instance = self::get_instance();
        
        if ( $instance->is_dev ) {
            // In dev mode, we need to enqueue the client first if not already done
            if ( ! wp_script_is( 'vite-client', 'enqueued' ) ) {
                wp_enqueue_script( 'vite-client', 'http://localhost:5173/@vite/client', [], null, false );
            }
        }

        $url = $instance->get_asset_url( $entry_key, 'js' );
        if ( $url ) {
            wp_enqueue_script( $handle, $url, $deps, $instance->is_dev ? time() : $ver, $in_footer );
            
             // If we are in dev mode, we need to treat it as a module
            if ( $instance->is_dev ) {
                add_filter( 'script_loader_tag', [ $instance, 'filter_script_loader_tag' ], 10, 3 );
            }
        }
    }

      /**
     * Register a script via Vite
     */
    public static function register_script( $handle, $entry_key, $deps = [], $ver = '1.0.0', $in_footer = true ) {
        $instance = self::get_instance();

        // Note: For register_script to work with Vite Dev Server (ES modules), we might need to verify if WP supports type="module" easily during registration only.
        // Usually we enqueue. But let's support register.
        
        $url = $instance->get_asset_url( $entry_key, 'js' );
        if ( $url ) {
            wp_register_script( $handle, $url, $deps, $instance->is_dev ? time() : $ver, $in_footer );
             if ( $instance->is_dev ) {
                add_filter( 'script_loader_tag', [ $instance, 'filter_script_loader_tag' ], 10, 3 );
            }
        }
    }


    public function filter_script_loader_tag( $tag, $handle, $src ) {
        if ( strpos( $src, 'localhost:5173' ) !== false ) {
            return '<script type="module" src="' . esc_url( $src ) . '"></script>';
        }
        return $tag;
    }

    private function get_asset_url( $entry_key, $type = 'js' ) {
        if ( $this->is_dev ) {
            // In dev, we simply point to localhost:5173/path/to/file
            // We need to know the relative path from root. 
            // The user passes the entry key which in our vite config we mapped to strict paths.
            // But here we need to map back the 'entry_key' (like 'hero') to the actual file path relative to project root?
            // Or simpler: We should change how we call this. Pass the relative path to the file.
            
            // Wait, in vite.config.js inputs:
            // 'hero': path.resolve(__dirname, 'widgets/hero/assets/css/hero.css')
            // If I request 'hero', I want Vite to serve it.
            // Vite dev server serves files by path.
            // But if I use the alias, does it work? No, Dev server requests need real paths usually.
            
            // Let's refine the input. It's better if the user passes the real relative path.
            // But our vite config uses aliases.
            
            // ACTUALLY: The best way for WP + Vite is to just pass the relative path to file as the ID.
            
            // Let's try to find the path based on the aliases I defined in vite.config.js? No I can't parse JS easily here.
            
            // ALTERNATIVE:
            // Update vite.config.js to NOT use aliases for input, but just use an array or object with paths.
            // And here we pass the path.
            
            // Let's stick to the aliases plan but we need a mapping because I defined them in JS.
            // Checking my vite.config.js again...
            // 'hero': .../hero.css
            
            // If I am in dev mode:
            // I should point to http://localhost:5173/widgets/hero/assets/css/hero.css
            
            // So my PHP should receive 'widgets/hero/assets/css/hero.css' instead of 'hero'.
            // AND my vite.config.js input should probably trigger based on that?
            // Actually, if I pass 'hero', I can't easily know the path unless I duplicate the map.
            
            // DECISION: I will duplicate the map here for simplicity, OR I will change arguments to accept the Relative Path.
            // Relative path is safer and more "Vite-like".
            
            // But for `manifest.json` lookups (Production), the key IS the relative path (usually) or the name.
            // "widgets/hero/assets/css/hero.css": { "file": "assets/hero-....css", ... }
            
            // So, I should definitely use Relative Paths as keys in PHP.
            // And in vite.config.js, I should probably just let Vite discover them or explicitly list them but the Manifest keys will be the relative paths.
            
            return 'http://localhost:5173/' . $entry_key;
        }

        // Production
        if ( ! $this->manifest ) {
            return null;
        }

        if ( isset( $this->manifest[ $entry_key ] ) ) {
            $file = $this->manifest[ $entry_key ]['file']; // e.g., 'assets/hero.12345.css'
            return $this->dist_url . '/' . $file;
        }
        
        // Sometimes CSS is inside a JS entry in manifest? 
        // If requesting CSS but key points to JS? 
        // For now assume direct mapping.
        
        return null; 
    }
}
