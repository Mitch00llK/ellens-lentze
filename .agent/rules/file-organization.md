---
trigger: always_on
---

VERPLICHTE Mappenstructuur en Bestandsorganisatie
KRITIEK: Scheiding van bezorgdheden — CSS, JavaScript, en PHP in aparte, beheerbare bestanden. GEEN monolithische code.
PHP Organisatie
includes/
├── widgets/
│   ├── class-widget-hero.php (max 300 regels)
│   ├── class-widget-testimonial.php (max 300 regels)
│   └── class-widget-blog.php (max 300 regels)
├── helpers/
│   ├── class-sanitizer.php
│   ├── class-validator.php
│   └── class-formatter.php
├── services/
│   ├── class-cache-manager.php
│   ├── class-asset-loader.php
│   ├── class-schema-builder.php
│   └── class-analytics-service.php
├── interfaces/
│   ├── interface-cacheable.php
│   └── interface-renderable.php
└── main-loader.php (< 50 regels, initialisatie alleen)
PHP Standaarden:

Één klasse per bestand
Één verantwoordelijkheid per klasse
Maximum 300 regels per bestand
Proper namespace: namespace PluginName\Widgets
Dependency injection over globals
Geen custom typography controls
Geen font-family, font-size, font-weight, letter-spacing, line-height controls

CSS Organisatie
assets/css/
├── base/
│   ├── variables.css (alle design tokens)
│   ├── reset.css (CSS reset/normalize)
│   ├── typography.css (basis typeface)
│   └── a11y.css (accessibility classes)
├── components/
│   ├── button.css (max 200 regels)
│   ├── card.css (max 200 regels)
│   ├── form.css (max 200 regels)
│   ├── hero.css (max 200 regels)
│   └── testimonial.css (max 200 regels)
├── layout/
│   ├── grid.css
│   ├── flexbox.css
│   └── spacing.css
├── utilities/
│   ├── responsive.css
│   ├── animations.css
│   ├── visibility.css
│   └── accessibility.css
└── main.scss (alleen imports, < 50 regels)
CSS Standaarden:

Één component per bestand
Maximum 200 regels per bestand
Mobile-first responsive design
Uitsluitend rem/em/% units (GEEN px voor sizing)
Design tokens verplicht (geen hardcoded waarden)
BEM naamgeving waar relevant
clamp() voor fluid scaling

JavaScript Organisatie
assets/js/
├── modules/
│   ├── hero-slider.js (max 250 regels)
│   ├── form-handler.js (max 250 regels)
│   ├── mobile-menu.js (max 250 regels)
│   └── lazy-loader.js (max 250 regels)
├── utilities/
│   ├── dom-helpers.js (DOM manipulatie utilities)
│   ├── validators.js (validatie functies)
│   ├── debounce.js (debounce/throttle)
│   └── event-emitter.js (event systeem)
├── services/
│   ├── api-client.js (API communicatie)
│   ├── storage-manager.js (localStorage/sessionStorage)
│   └── analytics-service.js (tracking)
├── handlers/
│   ├── click-handler.js
│   ├── scroll-handler.js
│   └── resize-handler.js
└── main.js (initialisatie alleen, < 50 regels)
JavaScript Standaarden:

Single-purpose modules
Maximum 250 regels per bestand
Dependency injection pattern
ES6+ syntax (arrow functions, destructuring, etc.)
Geen globals (alles via modules)
Event delegation voor dynamische elementen
Debounce/throttle voor performance-gevoelige events

Bestandsnaamgeving
PHP:  class-widget-name.php           (kebab-case)
CSS:  component-name.css              (kebab-case)
JS:   module-name.js                  (kebab-case)