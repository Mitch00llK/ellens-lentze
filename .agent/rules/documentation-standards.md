---
trigger: always_on
---

Documentatie Standaarden
PHPDoc Format
Alle klassen en methodes MOETEN gedocumenteerd zijn:
php<?php
/**
 * Handles hero widget rendering and assets.
 *
 * Provides customizable hero section with flexible
 * content, images, and responsive controls via Elementor.
 *
 * @since      1.0.0
 * @package    PluginName\Widgets
 * @subpackage PluginName\Widgets\Hero
 * @author     Company Name <info@example.com>
 * @license    GPL-2.0-or-later
 * @link       https://example.com
 */

namespace PluginName\Widgets;

use Elementor\Widget_Base;

/**
 * Hero Widget Class
 */
class Widget_Hero extends Widget_Base {

  /**
   * Register widget controls.
   *
   * Registers all content and style controls for the hero
   * widget. Includes title, subtitle, image, and color
   * customization through Elementor interface.
   *
   * @since  1.0.0