---
trigger: always_on
---

# Elementor Widget Development Standards

## Core Principles
Expert Elementor widget developer creating high-quality, modular, performant, SEO-optimized code following WordPress and modern web standards.

---

## Development Standards

### Web Standards & Best Practices
- Semantic HTML5 with proper heading hierarchy (h1-h6)
- WCAG 2.2 Level AA accessibility compliance
- Modern CSS (Flexbox, Grid, CSS Custom Properties)
- Mobile-first responsive design
- JSON-LD schema markup for SEO
- Core Web Vitals optimization (LCP <2.5s, FID <100ms, CLS <0.1)
- WordPress security: sanitize inputs, escape outputs, use nonces
- Elementor hook integration with proper control organization

### Design Tokens (MANDATORY)
Use CSS custom properties, never hardcode values:
- **Colors**: `--color-{name}-{shade}` (e.g., `--color-primary-500`)
- **Spacing**: `--spacing-{size}` (e.g., `--spacing-xs`, `--spacing-md`)
- **Typography**: `--font-{property}-{value}` (e.g., `--font-size-lg`)
- **Borders**: `--border-radius-{size}`, `--border-width-{size}`
- **Shadows**: `--shadow-{intensity}` (e.g., `--shadow-sm`)
- **Z-index**: `--z-{layer}` (e.g., `--z-dropdown`, `--z-modal`)

---

## File Structure (MANDATORY SEPARATION OF CONCERNS)

**CRITICAL: CSS, JavaScript, and PHP in separate, manageable files. NO monolithic code.**

### PHP Organization
```
includes/
├── widgets/ (one widget per file, max 300 lines)
├── helpers/ (utility classes)
├── services/ (caching, assets, schema, analytics)
├── interfaces/ (extensibility)
└── main-loader.php (initialization only, <50 lines)
```

**Standards:**
- One class per file, one responsibility per class
- Use dependency injection over globals
- Maximum 300 lines per file
- Namespace properly: `namespace PluginName\Widgets`

### CSS Organization
```
assets/css/
├── base/ (variables.css, reset, typography, a11y)
├── components/ (one per file, max 200 lines)
├── layout/ (grid, spacing, flexbox)
├── utilities/ (responsive, animations, visibility)
└── main.scss (imports only, <50 lines)
```

### JavaScript Organization
```
assets/js/
├── modules/ (single-purpose, max 250 lines)
├── utilities/ (dom-helpers, validators, debounce)
├── services/ (api-client, storage, analytics)
├── handlers/ (event handlers)
└── main.js (initialization only, <50 lines)
```

### File Naming
- **PHP**: `class-widget-name.php` (kebab-case)
- **CSS**: `component-name.css` (kebab-case)
- **JS**: `module-name.js` (kebab-case)

---

## Code Quality & Modularity

### Modular Architecture Requirements
**MUST VERIFY BEFORE FINALIZING:**
1. Each module/class has ONE clear purpose
2. No duplicate logic exists (DRY principle)
3. Dependencies form logical hierarchy (no circular refs)
4. All modules are actually used
5. All files respect size limits
6. Entry points contain ONLY initialization

**DO NOT PROCEED if:**
- Code is monolithic or tightly coupled
- Files exceed size limits
- Multiple responsibilities per class/file
- Circular dependencies exist
- Business logic mixed with initialization

### Performance Optimization
**Asset Loading:**
- Load CSS/JS conditionally (only when widget present)
- Defer non-critical JavaScript
- Implement lazy loading for images (`loading="lazy"`)
- Cache with WordPress transients

**Code Optimization:**
- Minimize DOM queries and manipulation
- Use event delegation for dynamic elements
- Debounce/throttle resize/scroll handlers
- Use CSS transforms for animations (GPU acceleration)
- Remove unused CSS selectors and dead code

### SEO Optimization
- Use semantic HTML with proper structure
- Implement JSON-LD schema markup
- Include descriptive alt text on images
- Optimize for Core Web Vitals
- Use descriptive heading hierarchy
- Implement breadcrumb schema where applicable

---

## WordPress & Elementor Integration

### Security (MANDATORY)
```php
// Sanitize input
$user_input = sanitize_text_field( $_POST['field'] );

// Escape output
echo esc_html( $variable );
echo esc_attr( $attribute );
echo esc_url( $url );

// Nonce verification
check_ajax_referer( 'nonce_name' );
wp_verify_nonce( $_POST['nonce'], 'nonce_name' );

// Capability checking
if ( ! current_user_can( 'manage_options' ) ) {
  wp_die( 'Unauthorized' );
}
```

### Elementor Widget Best Practices
- Register scripts/styles in `get_script_depends()` and `get_style_depends()`
- Implement `get_name()`, `get_title()`, `get_icon()`
- Group controls in logical sections
- Use responsive controls for breakpoints
- Cache expensive queries with transients
- Render only in `render()` method, not in controls
- **NO custom typography controls** — Elementor handles all typography exclusively
- Never add font-family, font-size, font-weight, letter-spacing, line-height controls

### Database Best Practices
- Use `$wpdb->prepare()` for prepared statements
- Leverage `WP_Query` instead of raw SQL
- Cache results with transients
- Minimize database queries

---

## Code Cleanup Protocol

**BEFORE COMPLETING:**
- ✓ Remove all unused code and variables
- ✓ Delete commented-out code blocks
- ✓ Remove debug statements (`console.log()`, `var_dump()`)
- ✓ Consolidate duplicate code
- ✓ Verify all imports are used
- ✓ Remove unused CSS selectors
- ✓ Clean unnecessary whitespace

---

## Documentation

### PHPDoc Format
```php
/**
 * Handles widget rendering and asset loading.
 *
 * @since 1.0.0
 * @package PluginName\Services
 */
class Asset_Loader {

  /**
   * Register widget assets.
   *
   * @since 1.0.0
   * @return void
   */
  public function register() {
    // implementation
  }
}
```

### Documentation Requirements
- PHPDoc for all classes/methods
- Document Elementor hooks usage
- Note version dependencies
- Explain complex logic
- Keep comments synchronized with code
- Remove outdated comments

---

## Development Workflow

1. **Understand requirements** — clarify specs, performance needs, SEO requirements
2. **Plan modular structure** — map logic, identify reusable components, design dependencies
3. **Plan file organization** — sketch directory structure, define responsibilities
4. **Implement** — follow standards strictly, respect file size limits, use design tokens
5. **Code cleanup** — remove unused code, debug statements, consolidate duplicates
6. **Verify modularity** — check all requirements above; HALT if non-compliant
7. **Test** — responsive design, accessibility (WCAG 2.2 AA), performance
8. **Validate** — Core Web Vitals, schema markup, SEO, accessibility

---

## Quality Checklist

### Architecture
- ✓ Modular architecture verified
- ✓ One responsibility per file/class
- ✓ No circular dependencies
- ✓ Entry points <50 lines (init only)
- ✓ Directory structure matches requirements

### File Sizes
- ✓ No PHP file exceeds 300 lines
- ✓ No JS file exceeds 250 lines
- ✓ No CSS file exceeds 200 lines

### Code Quality
- ✓ All unused code removed
- ✓ No hardcoded CSS values
- ✓ Design tokens used throughout
- ✓ DRY principle followed
- ✓ Functions modular and reusable
- ✓ No custom typography controls

### WordPress & Elementor
- ✓ All inputs sanitized
- ✓ All outputs escaped
- ✓ Nonces implemented
- ✓ Capability checking enforced
- ✓ Proper Elementor hook integration

### Performance
- ✓ Assets loaded conditionally
- ✓ Lazy loading for images/content
- ✓ Caching strategy implemented
- ✓ DOM manipulation minimized
- ✓ Core Web Vitals targets met

### Accessibility & SEO
- ✓ Semantic HTML with proper hierarchy
- ✓ WCAG 2.2 Level AA compliant
- ✓ ARIA labels and roles
- ✓ Keyboard navigation supported
- ✓ JSON-LD schema implemented
- ✓ Alt text on images

### Documentation
- ✓ PHPDoc for classes/methods
- ✓ Elementor hooks documented
- ✓ Module purposes explained
- ✓ Comments up-to-date

---

## Common Pitfalls to Avoid

**Architecture:**
- ❌ Monolithic code, circular dependencies
- ❌ Multiple classes per file
- ❌ Business logic in entry points
- ❌ Hard-coded configuration

**Performance:**
- ❌ Global asset loading
- ❌ Synchronous scripts
- ❌ Excessive database queries
- ❌ Missing transient caching
- ❌ DOM thrashing

**Security:**
- ❌ Missing input sanitization
- ❌ Missing output escaping
- ❌ No nonce verification
- ❌ Missing capability checks

**Code Quality:**
- ❌ All CSS in one file
- ❌ All JavaScript in one file
- ❌ Hardcoded CSS values
- ❌ Duplicate code scattered
- ❌ Unused code left in files
- ❌ Custom typography controls

**SEO & Accessibility:**
- ❌ Missing semantic HTML
- ❌ No schema markup
- ❌ Poor heading hierarchy
- ❌ Missing alt text
- ❌ Keyboard navigation disabled

---

## Remember

**Clean, modular, performant code is essential.** Verify modular structure before completion. Never compromise code quality or architecture. If code doesn't meet modularity standards, STOP and refactor.

**Goal:** Maintainable, performant, accessible, SEO-optimized solutions serving both users and search engines.