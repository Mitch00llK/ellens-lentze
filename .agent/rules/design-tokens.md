---
trigger: always_on
---

Systemische Design Tokens (VERPLICHT)
KRITIEK: Gebruik CSS custom properties, NOOIT hardcoded waarden.
Token Naamgeving Structuur
css--{category}-{property}-{value}
Categorie: Colors
css/* Primair kleurschema */
--color-primary-50: #f0f4ff;
--color-primary-100: #e0e9ff;
--color-primary-500: #4f46e5;
--color-primary-900: #1e1b4b;

/* Secundair kleurschema */
--color-secondary-500: #8b5cf6;
--color-secondary-900: #3b0764;

/* Neutraal kleurschema */
--color-neutral-50: #f9fafb;
--color-neutral-500: #6b7280;
--color-neutral-900: #111827;

/* Semantisch */
--color-success: #10b981;
--color-warning: #f59e0b;
--color-error: #ef4444;
--color-info: #3b82f6;
Categorie: Spacing
css--spacing-xs: 0.25rem;   /* 4px */
--spacing-sm: 0.5rem;    /* 8px */
--spacing-md: 1rem;      /* 16px */
--spacing-lg: 1.5rem;    /* 24px */
--spacing-xl: 2rem;      /* 32px */
--spacing-2xl: 3rem;     /* 48px */
--spacing-3xl: 4rem;     /* 64px */
Categorie: Typography
css/* Font families */
--font-family-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
--font-family-serif: 'Georgia', serif;
--font-family-mono: 'Courier New', monospace;

/* Letter spacing */
--letter-spacing-tight: -0.02em;
--letter-spacing-normal: 0;
--letter-spacing-wide: 0.05em;

/* Line height */
--line-height-tight: 1.2;
--line-height-normal: 1.5;
--line-height-relaxed: 1.75;
Categorie: Borders
css--border-radius-sm: 0.25rem;
--border-radius-md: 0.5rem;
--border-radius-lg: 1rem;
--border-radius-full: 9999px;

--border-width-thin: 1px;
--border-width-normal: 2px;
--border-width-thick: 4px;
Categorie: Shadows
css--shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
--shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
--shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
--shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
Categorie: Z-index
css--z-dropdown: 1000;
--z-modal: 1050;
--z-popover: 1100;
--z-tooltip: 1070;
Categorie: Transitions
css--transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
--transition-normal: 250ms cubic-bezier(0.4, 0, 0.2, 1);
--transition-slow: 350ms cubic-bezier(0.4, 0, 0.2, 1);
Token Implementatie
css.button {
  padding: var(--spacing-md) var(--spacing-lg);
  background-color: var(--color-primary-500);
  color: white;
  border: var(--border-width-thin) solid var(--color-primary-700);
  border-radius: var(--border-radius-md);
  transition: background-color var(--transition-normal);
  font-family: var(--font-family-sans);
}

.button:hover {
  background-color: var(--color-primary-600);
}