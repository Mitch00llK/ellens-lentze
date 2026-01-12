---
trigger: always_on
---

Elementor Integratie en Controls
Kritieke Elementor Rules
GEEN CUSTOM TYPOGRAPHY CONTROLS:

Elementor handelt ALLE typografische styling af
GEEN font-family controls toevoegen
GEEN font-size controls toevoegen
GEEN font-weight controls toevoegen
GEEN letter-spacing controls toevoegen
GEEN line-height controls toevoegen

Laat Elementor het typography systeem volledig beheren.
Verplichte Widget Structuur
php<?php
namespace PluginName\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_Hero extends Widget_Base {
  
  /**
   * Get widget name.
   */
  public function get_name() {
    return 'hero';
  }
  
  /**
   * Get widget title.
   */
  public function get_title() {
    return __( 'Hero Section', 'plugin-name' );
  }
  
  /**
   * Get widget icon.
   */
  public function get_icon() {
    return 'eicon-image-bold';
  }
  
  /**
   * Register widget controls.
   */
  protected function register_controls() {
    // Content tab
    $this->start_controls_section( 'content_section', [
      'label' => __( 'Content', 'plugin-name' ),
      'tab'   => Controls_Manager::TAB_CONTENT,
    ]);
    
    $this->add_control( 'title', [
      'label'       => __( 'Title', 'plugin-name' ),
      'type'        => Controls_Manager::TEXT,
      'default'     => __( 'Hero Title', 'plugin-name' ),
      'placeholder' => __( 'Enter title', 'plugin-name' ),
    ]);
    
    $this->end_controls_section();
    
    // Style tab
    $this->start_controls_section( 'style_section', [
      'label' => __( 'Style', 'plugin-name' ),
      'tab'   => Controls_Manager::TAB_STYLE,
    ]);
    
    $this->add_group_control( Group_Control_Typography::get_type(), [
      'name'     => 'title_typography',
      'label'    => __( 'Title Typography', 'plugin-name' ),
      'selector' => '{{WRAPPER}} .hero-title',
    ]);
    
    $this->add_control( 'title_color', [
      'label'     => __( 'Title Color', 'plugin-name' ),
      'type'      => Controls_Manager::COLOR,
      'default'   => 'var(--color-primary-500)',
      'selectors' => [
        '{{WRAPPER}} .hero-title' => 'color: {{VALUE}};',
      ],
    ]);
    
    $this->end_controls_section();
  }
  
  /**
   * Render widget output on the frontend.
   */
  protected function render() {
    $settings = $this->get_settings_for_display();
    
    echo '<div class="elementor-widget-hero">';
    echo '<h1 class="hero-title">' . 
      esc_html( $settings['title'] ) . 
    '</h1>';
    echo '</div>';
  }
}
Elementor Controls voor Elk Element
Verplicht: Voeg Elementor controls toe voor alle customizable elementen, en geef ze een eigen sectie in plaats van alles in een tab te verwerken.
php// Basale tekst controls
$this->add_control( 'heading_text', [
  'label'       => __( 'Heading Text', 'plugin-name' ),
  'type'        => Controls_Manager::TEXT,
  'default'     => '',
  'placeholder' => __( 'Enter text', 'plugin-name' ),
]);

// Select/dropdown controls
$this->add_control( 'alignment', [
  'label'   => __( 'Alignment', 'plugin-name' ),
  'type'    => Controls_Manager::SELECT,
  'default' => 'left',
  'options' => [
    'left'   => __( 'Left', 'plugin-name' ),
    'center' => __( 'Center', 'plugin-name' ),
    'right'  => __( 'Right', 'plugin-name' ),
  ],
]);

// Color controls
$this->add_control( 'background_color', [
  'label'     => __( 'Background Color', 'plugin-name' ),
  'type'      => Controls_Manager::COLOR,
  'default'   => 'var(--color-primary-500)',
  'selectors' => [
    '{{WRAPPER}} .element' => 'background-color: {{VALUE}};',
  ],
]);

// Image controls
$this->add_control( 'image', [
  'label'   => __( 'Choose Image', 'plugin-name' ),
  'type'    => Controls_Manager::MEDIA,
  'default' => [],
]);

// Repeater controls
$repeater = new \Elementor\Repeater();

$repeater->add_control( 'item_title', [
  'label'       => __( 'Title', 'plugin-name' ),
  'type'        => Controls_Manager::TEXT,
  'default'     => '',
  'placeholder' => __( 'Item title', 'plugin-name' ),
]);

$this->add_control( 'list_items', [
  'label'       => __( 'List Items', 'plugin-name' ),
  'type'        => Controls_Manager::REPEATER,
  'fields'      => $repeater->get_controls(),
  'title_field' => '{{{ item_title }}}',
]);

// Responsive controls
$this->add_responsive_control( 'padding', [
  'label'      => __( 'Padding', 'plugin-name' ),
  'type'       => Controls_Manager::DIMENSIONS,
  'size_units' => [ 'px', 'em', 'rem' ],
  'default'    => [
    'top'    => '15',
    'right'  => '10',
    'bottom' => '15',
    'left'   => '10',
    'unit'   => 'px',
  ],
  'selectors'  => [
    '{{WRAPPER}} .element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
  ],
]);

// Typography group control
$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
  'name'     => 'heading_typography',
  'label'    => __( 'Typography', 'plugin-name' ),
  'selector' => '{{WRAPPER}} .heading',
] );

// Border group control
$this->add_group_control( \Elementor\Group_Control_Border::get_type(), [
  'name'     => 'border',
  'label'    => __( 'Border', 'plugin-name' ),
  'selector' => '{{WRAPPER}} .element',
] );

// Box shadow group control
$this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(), [
  'name'     => 'box_shadow',
  'label'    => __( 'Box Shadow', 'plugin-name' ),
  'selector' => '{{WRAPPER}} .element',
] );
Script & Style Dependencies
php/**
 * Get script dependencies.
 */
public function get_script_depends() {
  return [ 'hero-slider', 'main-app' ];
}

/**
 * Get style dependencies.
 */
public function get_style_depends() {
  return [ 'hero-component', 'base-styles' ];
}
Voorwaardelijk Laden
php/**
 * Render widget output on the frontend.
 */
protected function render() {
  // Scripts/styles geladen door Elementor conditional loading
  wp_enqueue_script( 'hero-slider' );
  wp_enqueue_style( 'hero-component' );
  
  // Render widget
  // ...
}