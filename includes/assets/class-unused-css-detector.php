<?php
namespace EllensLentze\Includes\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Unused CSS Detector
 * 
 * Scans CSS files and checks if selectors are actually used in PHP/HTML files.
 * 
 * @since 1.0.0
 */
class Unused_CSS_Detector {

	/**
	 * Plugin root directory
	 *
	 * @var string
	 */
	private $plugin_root;

	/**
	 * Excluded CSS selectors (utility classes, pseudo-selectors, etc.)
	 *
	 * @var array
	 */
	private $excluded_selectors = [
		':hover',
		':focus',
		':active',
		':before',
		':after',
		'@media',
		'@keyframes',
		'@import',
		'@font-face',
		'@supports',
	];

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->plugin_root = dirname( dirname( dirname( __DIR__ ) ) );
	}

	/**
	 * Detect unused CSS across all CSS files
	 *
	 * @param array $options Optional configuration:
	 *                      - 'css_paths' (array): Specific CSS files to check (default: all in project)
	 *                      - 'scan_paths' (array): Paths to scan for usage (default: all PHP files)
	 *                      - 'exclude_utilities' (bool): Exclude utility classes (default: true)
	 *                      - 'output_format' (string): 'array', 'json', 'html' (default: 'array')
	 * @return array|string Unused CSS report
	 */
	public function detect_unused_css( $options = [] ) {
		$defaults = [
			'css_paths'        => $this->get_all_css_files(),
			'scan_paths'       => $this->get_scan_paths(),
			'exclude_utilities' => true,
			'output_format'    => 'array',
		];

		$options = wp_parse_args( $options, $defaults );

		$unused_css = [];
		$total_selectors = 0;
		$unused_selectors = 0;

		foreach ( $options['css_paths'] as $css_file ) {
			$file_results = $this->analyze_css_file( $css_file, $options );
			
			if ( ! empty( $file_results['unused'] ) ) {
				$unused_css[ $css_file ] = $file_results;
				$total_selectors += $file_results['total_selectors'];
				$unused_selectors += count( $file_results['unused'] );
			}
		}

		$report = [
			'summary' => [
				'total_css_files'    => count( $options['css_paths'] ),
				'files_with_unused'  => count( $unused_css ),
				'total_selectors'    => $total_selectors,
				'unused_selectors'   => $unused_selectors,
				'usage_percentage'   => $total_selectors > 0 ? round( ( ( $total_selectors - $unused_selectors ) / $total_selectors ) * 100, 2 ) : 0,
			],
			'unused_css' => $unused_css,
		];

		return $this->format_output( $report, $options['output_format'] );
	}

	/**
	 * Analyze a single CSS file for unused selectors
	 *
	 * @param string $css_file Path to CSS file
	 * @param array  $options  Detection options
	 * @return array Analysis results
	 */
	private function analyze_css_file( $css_file, $options = [] ) {
		$full_path = $this->plugin_root . '/' . ltrim( $css_file, '/' );
		
		if ( ! file_exists( $full_path ) ) {
			return [
				'error' => 'File not found',
				'unused' => [],
				'total_selectors' => 0,
			];
		}

		$css_content = file_get_contents( $full_path );
		$selectors = $this->extract_selectors( $css_content, $options );
		
		$unused = [];
		$used_content = $this->get_all_scan_content( $options['scan_paths'] );

		foreach ( $selectors as $selector ) {
			if ( ! $this->is_selector_used( $selector, $used_content, $options ) ) {
				$unused[] = $selector;
			}
		}

		return [
			'unused' => $unused,
			'total_selectors' => count( $selectors ),
			'used_selectors' => count( $selectors ) - count( $unused ),
		];
	}

	/**
	 * Extract CSS selectors from CSS content
	 *
	 * @param string $css_content CSS file content
	 * @param array  $options     Detection options
	 * @return array Array of selectors
	 */
	private function extract_selectors( $css_content, $options = [] ) {
		// Remove comments
		$css_content = preg_replace( '/\/\*.*?\*\//s', '', $css_content );
		
		// Extract selectors (everything before {)
		preg_match_all( '/([^{]+)\{/s', $css_content, $matches );
		
		$selectors = [];
		if ( ! empty( $matches[1] ) ) {
			foreach ( $matches[1] as $selector_block ) {
				// Split by comma to handle multiple selectors
				$individual_selectors = array_map( 'trim', explode( ',', $selector_block ) );
				
				foreach ( $individual_selectors as $selector ) {
					$selector = trim( $selector );
					
					// Skip empty selectors
					if ( empty( $selector ) ) {
						continue;
					}

					// Skip excluded patterns
					if ( $this->should_exclude_selector( $selector, $options ) ) {
						continue;
					}

					// Clean up selector (remove extra whitespace, newlines)
					$selector = preg_replace( '/\s+/', ' ', $selector );
					$selector = trim( $selector );

					if ( ! empty( $selector ) && ! in_array( $selector, $selectors, true ) ) {
						$selectors[] = $selector;
					}
				}
			}
		}

		return $selectors;
	}

	/**
	 * Check if selector should be excluded from analysis
	 *
	 * @param string $selector CSS selector
	 * @param array  $options  Detection options
	 * @return bool True if should be excluded
	 */
	private function should_exclude_selector( $selector, $options = [] ) {
		// Check excluded patterns
		foreach ( $this->excluded_selectors as $excluded ) {
			if ( strpos( $selector, $excluded ) !== false ) {
				return true;
			}
		}

		// Exclude utility classes if option is set
		if ( ! empty( $options['exclude_utilities'] ) ) {
			// Utility classes typically start with . and are short (e.g., .m-0, .p-sm)
			if ( preg_match( '/^\.([a-z]+)-([a-z0-9]+)$/', $selector ) ) {
				return true;
			}
		}

		// Exclude CSS variables
		if ( strpos( $selector, '--' ) !== false ) {
			return true;
		}

		// Exclude @ rules
		if ( $selector[0] === '@' ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if a selector is used in scanned content
	 *
	 * @param string $selector    CSS selector to check
	 * @param string $scan_content Combined content from all scanned files
	 * @param array  $options     Detection options
	 * @return bool True if selector is used
	 */
	private function is_selector_used( $selector, $scan_content, $options = [] ) {
		// Remove leading/trailing whitespace
		$selector = trim( $selector );

		// Handle different selector types
		$search_patterns = [];

		// Class selector (.class-name)
		if ( preg_match( '/^\.([a-zA-Z0-9_-]+)/', $selector, $matches ) ) {
			$class_name = $matches[1];
			$search_patterns[] = 'class=["\'][^"\']*' . preg_quote( $class_name, '/' ) . '[^"\']*["\']';
			$search_patterns[] = 'class=\s*[' . preg_quote( $class_name, '/' ) . ']';
		}

		// ID selector (#id-name)
		if ( preg_match( '/^#([a-zA-Z0-9_-]+)/', $selector, $matches ) ) {
			$id_name = $matches[1];
			$search_patterns[] = 'id=["\'][^"\']*' . preg_quote( $id_name, '/' ) . '[^"\']*["\']';
			$search_patterns[] = 'id=\s*[' . preg_quote( $id_name, '/' ) . ']';
		}

		// Element selector (element-name)
		if ( preg_match( '/^([a-zA-Z0-9_-]+)(?:\s|$)/', $selector, $matches ) ) {
			$element_name = $matches[1];
			$search_patterns[] = '<' . preg_quote( $element_name, '/' ) . '\s';
			$search_patterns[] = '<' . preg_quote( $element_name, '/' ) . '>';
		}

		// Attribute selector [attribute]
		if ( preg_match( '/\[([a-zA-Z0-9_-]+)(?:[=\'"]?([^\]]+)[\'"]?)?\]/', $selector, $matches ) ) {
			$attr_name = $matches[1];
			$search_patterns[] = preg_quote( $attr_name, '/' ) . '=';
		}

		// If no patterns found, try direct search
		if ( empty( $search_patterns ) ) {
			// Remove CSS combinators and pseudo-selectors for search
			$clean_selector = preg_replace( '/[>\s+~]+/', ' ', $selector );
			$clean_selector = preg_replace( '/:.*/', '', $clean_selector );
			$clean_selector = trim( $clean_selector );
			
			if ( ! empty( $clean_selector ) ) {
				$search_patterns[] = preg_quote( $clean_selector, '/' );
			}
		}

		// Search for any of the patterns in content
		foreach ( $search_patterns as $pattern ) {
			if ( preg_match( '/' . $pattern . '/i', $scan_content ) ) {
				return true;
			}
		}

		// Also check for selector as string literal (might be in JS or PHP strings)
		if ( strpos( $scan_content, $selector ) !== false ) {
			return true;
		}

		return false;
	}

	/**
	 * Get content from all files to scan
	 *
	 * @param array $scan_paths Paths to scan
	 * @return string Combined content
	 */
	private function get_all_scan_content( $scan_paths ) {
		$content = '';

		foreach ( $scan_paths as $path ) {
			$full_path = $this->plugin_root . '/' . ltrim( $path, '/' );
			
			if ( is_file( $full_path ) ) {
				$content .= file_get_contents( $full_path ) . "\n";
			} elseif ( is_dir( $full_path ) ) {
				$content .= $this->get_directory_content( $full_path );
			}
		}

		return $content;
	}

	/**
	 * Recursively get content from directory
	 *
	 * @param string $directory Directory path
	 * @return string Combined content
	 */
	private function get_directory_content( $directory ) {
		$content = '';
		$files = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator( $directory, \RecursiveDirectoryIterator::SKIP_DOTS )
		);

		foreach ( $files as $file ) {
			if ( $file->isFile() && $file->getExtension() === 'php' ) {
				$content .= file_get_contents( $file->getRealPath() ) . "\n";
			}
		}

		return $content;
	}

	/**
	 * Get all CSS files in the project
	 *
	 * @return array Array of CSS file paths (relative to plugin root)
	 */
	private function get_all_css_files() {
		$css_files = [];
		$directories = [
			'assets/css',
			'widgets',
		];

		foreach ( $directories as $dir ) {
			$full_path = $this->plugin_root . '/' . $dir;
			
			if ( is_dir( $full_path ) ) {
				$files = new \RecursiveIteratorIterator(
					new \RecursiveDirectoryIterator( $full_path, \RecursiveDirectoryIterator::SKIP_DOTS )
				);

				foreach ( $files as $file ) {
					if ( $file->isFile() && $file->getExtension() === 'css' ) {
						$relative_path = str_replace( $this->plugin_root . '/', '', $file->getRealPath() );
						$css_files[] = $relative_path;
					}
				}
			}
		}

		return $css_files;
	}

	/**
	 * Get paths to scan for CSS usage
	 *
	 * @return array Array of paths to scan
	 */
	private function get_scan_paths() {
		return [
			'widgets',
			'includes',
			'ellens-lentze.php',
		];
	}

	/**
	 * Format output based on requested format
	 *
	 * @param array  $report        Report data
	 * @param string $output_format Output format
	 * @return array|string Formatted output
	 */
	private function format_output( $report, $output_format = 'array' ) {
		switch ( $output_format ) {
			case 'json':
				return wp_json_encode( $report, JSON_PRETTY_PRINT );

			case 'html':
				return $this->format_html_report( $report );

			case 'array':
			default:
				return $report;
		}
	}

	/**
	 * Format report as HTML
	 *
	 * @param array $report Report data
	 * @return string HTML formatted report
	 */
	private function format_html_report( $report ) {
		$html = '<div class="unused-css-report">';
		$html .= '<h2>Unused CSS Report</h2>';
		
		$summary = $report['summary'];
		$html .= '<div class="summary">';
		$html .= '<h3>Summary</h3>';
		$html .= '<ul>';
		$html .= '<li>Total CSS Files: ' . esc_html( $summary['total_css_files'] ) . '</li>';
		$html .= '<li>Files with Unused CSS: ' . esc_html( $summary['files_with_unused'] ) . '</li>';
		$html .= '<li>Total Selectors: ' . esc_html( $summary['total_selectors'] ) . '</li>';
		$html .= '<li>Unused Selectors: ' . esc_html( $summary['unused_selectors'] ) . '</li>';
		$html .= '<li>Usage Percentage: ' . esc_html( $summary['usage_percentage'] ) . '%</li>';
		$html .= '</ul>';
		$html .= '</div>';

		$html .= '<div class="details">';
		$html .= '<h3>Unused Selectors by File</h3>';
		
		foreach ( $report['unused_css'] as $file => $data ) {
			$html .= '<div class="css-file">';
			$html .= '<h4>' . esc_html( $file ) . '</h4>';
			$html .= '<p>Total: ' . esc_html( $data['total_selectors'] ) . ' | ';
			$html .= 'Used: ' . esc_html( $data['used_selectors'] ) . ' | ';
			$html .= 'Unused: ' . esc_html( count( $data['unused'] ) ) . '</p>';
			
			if ( ! empty( $data['unused'] ) ) {
				$html .= '<ul class="unused-selectors">';
				foreach ( $data['unused'] as $selector ) {
					$html .= '<li><code>' . esc_html( $selector ) . '</code></li>';
				}
				$html .= '</ul>';
			}
			$html .= '</div>';
		}
		
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Get unused CSS report (public static method for easy access)
	 *
	 * @param array $options Options for detection
	 * @return array|string Unused CSS report
	 */
	public static function get_report( $options = [] ) {
		$detector = new self();
		return $detector->detect_unused_css( $options );
	}
}