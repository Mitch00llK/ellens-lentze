<?php
namespace EllensLentze\Includes\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Team Custom Post Type.
 *
 * Registers the 'ellens_team' post type and handles custom meta fields.
 *
 * @since 1.0.0
 */
class CPT_Team {

	/**
	 * Register the custom post type.
	 *
	 * @since 1.0.0
	 */
	public static function register() {
		$labels = [
			'name'               => _x( 'Team', 'post type general name', 'ellens-lentze' ),
			'singular_name'      => _x( 'Team Member', 'post type singular name', 'ellens-lentze' ),
			'menu_name'          => _x( 'Team', 'admin menu', 'ellens-lentze' ),
			'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'ellens-lentze' ),
			'add_new'            => _x( 'Add New', 'team member', 'ellens-lentze' ),
			'add_new_item'       => __( 'Add New Team Member', 'ellens-lentze' ),
			'new_item'           => __( 'New Team Member', 'ellens-lentze' ),
			'edit_item'          => __( 'Edit Team Member', 'ellens-lentze' ),
			'view_item'          => __( 'View Team Member', 'ellens-lentze' ),
			'all_items'          => __( 'All Team Members', 'ellens-lentze' ),
			'search_items'       => __( 'Search Team', 'ellens-lentze' ),
			'parent_item_colon'  => __( 'Parent Team Member:', 'ellens-lentze' ),
			'not_found'          => __( 'No team members found.', 'ellens-lentze' ),
			'not_found_in_trash' => __( 'No team members found in Trash.', 'ellens-lentze' ),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => 'team' ],
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-groups',
			'supports'           => [ 'title', 'thumbnail' ], // Title = Name, Thumbnail = Photo
		];

		register_post_type( 'ellens_team', $args );

        // Register Meta Box
        add_action( 'add_meta_boxes', [ __CLASS__, 'add_meta_boxes' ] );
        add_action( 'save_post', [ __CLASS__, 'save_meta_box' ] );
	}

    /**
     * Add Meta Boxes.
     * 
     * @since 1.0.0
     */
    public static function add_meta_boxes() {
        add_meta_box(
            'ellens_team_details',
            __( 'Team Member Details', 'ellens-lentze' ),
            [ __CLASS__, 'render_meta_box' ],
            'ellens_team',
            'normal',
            'high'
        );
    }

    /**
     * Render Meta Box.
     * 
     * @param \WP_Post $post Current post object.
     * @since 1.0.0
     */
    public static function render_meta_box( $post ) {
        // Retrieve current value
        $function = get_post_meta( $post->ID, '_ellens_team_function', true );

        // Nonce field for security
        wp_nonce_field( 'ellens_team_save_meta', 'ellens_team_meta_nonce' );

        ?>
        <p>
            <label for="ellens_team_function"><?php esc_html_e( 'Job Title / Function', 'ellens-lentze' ); ?></label>
            <input type="text" id="ellens_team_function" name="ellens_team_function" value="<?php echo esc_attr( $function ); ?>" style="width:100%;" placeholder="<?php esc_attr_e( 'e.g. Notaris & registermediator', 'ellens-lentze' ); ?>">
        </p>
        <?php
    }

    /**
     * Save Meta Box Data.
     * 
     * @param int $post_id Post ID.
     * @since 1.0.0
     */
    public static function save_meta_box( $post_id ) {
        // Check nonce
        if ( ! isset( $_POST['ellens_team_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ellens_team_meta_nonce'], 'ellens_team_save_meta' ) ) {
            return;
        }

        // Check autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check permissions
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Save fields
        if ( isset( $_POST['ellens_team_function'] ) ) {
            update_post_meta( $post_id, '_ellens_team_function', sanitize_text_field( $_POST['ellens_team_function'] ) );
        }
    }
}
