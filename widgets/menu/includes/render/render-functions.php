<?php
namespace EllensLentze\Widgets\Menu\Includes\Render;

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Render_Functions {

	public static function render_widget( $widget ) {
		$settings = $widget->get_settings_for_display();

        $menu_slug = $settings['menu'];
        $menu_items = [];
        if ( ! empty( $menu_slug ) ) {
            $menu_items = wp_get_nav_menu_items( $menu_slug );
        }

        // Attributes
        $widget->add_render_attribute( 'wrapper', 'class', 'menu-wrapper' );
        
		?>
		<div <?php $widget->print_render_attribute_string( 'wrapper' ); ?>>
            
            <!-- 1. Logo -->
            <div class="menu__logo">
                <?php
                if ( ! empty( $settings['logo_image']['url'] ) ) {
                    $logo_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'logo_image' );
                    $logo_link = $settings['logo_link']['url'];
                    if ( ! empty( $logo_link ) ) {
                        echo '<a href="' . esc_url( $logo_link ) . '">' . $logo_html . '</a>';
                    } else {
                        echo $logo_html;
                    }
                }
                ?>
            </div>

            <!-- 2. Desktop Utils (Phone/Email) -->
            <div class="menu__utilities">
                <?php if ( ! empty( $settings['utility_buttons'] ) ) : ?>
                    <?php foreach ( $settings['utility_buttons'] as $item ) : 
                        $link_key = 'utility_link_' . $item['_id'];
                        $widget->add_link_attributes( $link_key, $item['link'] );
                        $widget->add_render_attribute( $link_key, 'class', 'menu__utility-btn' );
                    ?>
                        <a <?php $widget->print_render_attribute_string( $link_key ); ?>>
                            <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <span><?php echo esc_html( $item['text'] ); ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- 3. Desktop Menu -->
            <nav class="menu__nav">
                <ul class="menu__nav-list">
                    <?php 
                    if ( ! empty( $menu_items ) ) : 
                        $hierarchy = [];
                        foreach ( $menu_items as $item ) {
                            $hierarchy[ $item->menu_item_parent ][] = $item;
                        }

                        foreach ( $hierarchy[0] as $item ) : 
                            $has_children = isset( $hierarchy[ $item->ID ] );
                            $item_class = 'menu__nav-item';
                            if ( $has_children ) {
                                $item_class .= ' menu__nav-item--has-children';
                            }
                        ?>
                            <li class="<?php echo esc_attr( $item_class ); ?>">
                                <a href="<?php echo esc_url( $item->url ); ?>" class="menu__nav-link">
                                    <?php echo esc_html( $item->title ); ?>
                                    <?php if ( $has_children ) : ?>
                                        <i class="fas fa-chevron-down menu__dropdown-icon"></i>
                                    <?php endif; ?>
                                </a>
                                <?php if ( $has_children ) : ?>
                                    <ul class="menu__sub-menu">
                                        <?php foreach ( $hierarchy[ $item->ID ] as $child ) : ?>
                                            <li class="menu__sub-menu-item">
                                                <a href="<?php echo esc_url( $child->url ); ?>" class="menu__sub-menu-link">
                                                    <?php echo esc_html( $child->title ); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                     <!-- Portal Link (Appended) -->
                    <?php if ( ! empty( $settings['portal_link_text'] ) ) : ?>
                         <li class="menu__nav-item menu__nav-item--portal">
                            <a href="<?php echo esc_url( $settings['portal_link_url']['url'] ); ?>" class="menu__nav-link">
                                <?php echo esc_html( $settings['portal_link_text'] ); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- 4. Right Actions (Search, Lang) -->
            <div class="menu__actions">
                <!-- Search (Static for now) -->
                <button class="menu__search-btn" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>

                <!-- Language Switcher -->
                 <?php if ( 'yes' === $settings['show_language_switcher'] ) : ?>
                    <div class="menu__lang-switcher">
                         <!-- Simplified visual representation -->
                        <button class="menu__lang-btn <?php echo ( 'nl' === $settings['current_lang'] ) ? 'is-active' : ''; ?>">
                             <span class="menu__flag">🇳🇱</span> NL
                        </button>
                        <button class="menu__lang-btn <?php echo ( 'en' === $settings['current_lang'] ) ? 'is-active' : ''; ?>">
                             <span class="menu__flag">🇬🇧</span> EN
                        </button>
                    </div>
                 <?php endif; ?>
            </div>

            <!-- Mobile Toggle -->
             <button class="menu__toggle" aria-label="Menu" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Mobile Drawer -->
            <div class="menu__drawer">
                <div class="menu__drawer-inner">
                    <!-- Mobile Nav -->
                    <nav class="menu__mobile-nav">
                        <ul class="menu__mobile-list">
                            <?php 
                            if ( ! empty( $menu_items ) ) : 
                                // Re-use hierarchy if possible, but localized scope here
                                $hierarchy = [];
                                foreach ( $menu_items as $item ) {
                                    $hierarchy[ $item->menu_item_parent ][] = $item;
                                }

                                foreach ( $hierarchy[0] as $item ) : 
                                    $has_children = isset( $hierarchy[ $item->ID ] );
                                ?>
                                    <li class="menu__mobile-item <?php echo $has_children ? 'menu__mobile-item--has-children' : ''; ?>">
                                        <a href="<?php echo esc_url( $item->url ); ?>" class="menu__mobile-link">
                                            <?php echo esc_html( $item->title ); ?>
                                            <?php if ( $has_children ) : ?>
                                                <i class="fas fa-chevron-down menu__mobile-dropdown-icon"></i>
                                            <?php endif; ?>
                                        </a>
                                        <?php if ( $has_children ) : ?>
                                            <ul class="menu__mobile-sub-menu">
                                                <?php foreach ( $hierarchy[ $item->ID ] as $child ) : ?>
                                                    <li class="menu__mobile-sub-item">
                                                        <a href="<?php echo esc_url( $child->url ); ?>" class="menu__mobile-sub-link">
                                                            <?php echo esc_html( $child->title ); ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <!-- Portal Link Mobile -->
                            <?php if ( ! empty( $settings['portal_link_text'] ) ) : ?>
                                <li class="menu__mobile-item">
                                    <a href="<?php echo esc_url( $settings['portal_link_url']['url'] ); ?>" class="menu__mobile-link">
                                        <?php echo esc_html( $settings['portal_link_text'] ); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>

                    <!-- Mobile Utilities -->
                    <div class="menu__mobile-utilities">
                         <?php if ( ! empty( $settings['utility_buttons'] ) ) : ?>
                            <?php foreach ( $settings['utility_buttons'] as $item ) : 
                                $link_key = 'mobile_utility_' . $item['_id'];
                                $widget->add_link_attributes( $link_key, $item['link'] );
                                $widget->add_render_attribute( $link_key, 'class', 'menu__utility-btn' );
                            ?>
                                <a <?php $widget->print_render_attribute_string( $link_key ); ?>>
                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <span><?php echo esc_html( $item['text'] ); ?></span>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Mobile Language Switcher -->
                         <?php if ( 'yes' === $settings['show_language_switcher'] ) : ?>
                            <div class="menu__lang-switcher menu__lang-switcher--mobile">
                                <button class="menu__lang-btn <?php echo ( 'nl' === $settings['current_lang'] ) ? 'is-active' : ''; ?>">
                                     <span class="menu__flag">🇳🇱</span> NL
                                </button>
                                <button class="menu__lang-btn <?php echo ( 'en' === $settings['current_lang'] ) ? 'is-active' : ''; ?>">
                                     <span class="menu__flag">🇬🇧</span> EN
                                </button>
                            </div>
                         <?php endif; ?>
                    </div>
                </div>
            </div>

		</div>
		<?php
	}
}
