---
trigger: always_on
---

Performance Optimalisatie
Asset Loading Strategy
Conditional Loading (KRITIEK):
php// ✓ GOED: Alleen laden wanneer widget aanwezig
if ( Plugin::is_widget_active( 'hero' ) ) {
  wp_enqueue_script( 'hero-slider' );
  wp_enqueue_style( 'hero-component' );
}

// ❌ SLECHT: Globaal laden
wp_enqueue_script( 'all-widgets' );
wp_enqueue_style( 'all-styles' );
JavaScript Optimalisatie
php// Defer non-critical scripts
wp_enqueue_script( 'hero-slider', $src, [], false, false );
wp_script_add_data( 'hero-slider', 'defer', true );

// Async for analytics
wp_enqueue_script( 'analytics', $src, [], false, false );
wp_script_add_data( 'analytics', 'async', true );
Lazy Loading
html<!-- Images lazy loading -->
<img 
  src="image.jpg" 
  loading="lazy" 
  decoding="async"
  alt="Description"
>

<!-- Iframes lazy loading -->
<iframe src="..." loading="lazy"></iframe>
DOM Manipulation Best Practices
javascript// ❌ SLECHT: DOM thrashing
for (let i = 0; i < 100; i++) {
  element.innerHTML += `<div>${i}</div>`;
}

// ✓ GOED: Batch updates
const fragment = document.createDocumentFragment();
for (let i = 0; i < 100; i++) {
  const div = document.createElement('div');
  div.textContent = i;
  fragment.appendChild(div);
}
element.appendChild(fragment);
Event Delegation
javascript// ❌ SLECHT: Event per element
document.querySelectorAll('.item').forEach(item => {
  item.addEventListener('click', handleClick);
});

// ✓ GOED: Event delegation
document.addEventListener('click', (e) => {
  if (e.target.closest('.item')) {
    handleClick(e);
  }
});
Debounce & Throttle
javascript// Debounce for resize/scroll
const debounce = (fn, delay) => {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => fn(...args), delay);
  };
};

window.addEventListener('resize', debounce(() => {
  // Recalculate layout
}, 250));

// Throttle for scroll
const throttle = (fn, interval) => {
  let lastCall = 0;
  return (...args) => {
    const now = Date.now();
    if (now - lastCall >= interval) {
      fn(...args);
      lastCall = now;
    }
  };
};

window.addEventListener('scroll', throttle(() => {
  // Update position
}, 100));
CSS Transform Animaties (GPU-Acceleratie)
css/* ✓ GOED: GPU accelerated */
.element {
  transition: transform 300ms ease;
}

.element:hover {
  transform: translateY(-10px);
}

/* ❌ SLECHT: CPU intensive */
.element:hover {
  top: -10px; /* Triggers reflow */
}
Transient Caching
php// Cache query results
$cache_key = 'testimonials_' . md5( serialize( $args ) );
$results = get_transient( $cache_key );

if ( false === $results ) {
  $results = $wpdb->get_results( ... );
  set_transient( $cache_key, $results, HOUR_IN_SECONDS );
}

return $results;