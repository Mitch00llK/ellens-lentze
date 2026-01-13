---
trigger: always_on
---

Systemische Design Tokens (VERPLICHT)
KRITIEK:

Gebruik CSS custom properties, NOOIT hardcoded waarden
ALLE variabelen MOETEN in assets/css/globals/variables.css staan
GEEN eigen variabele bestanden per component of folder
Alle componenten importeren variabelen uit dezelfde bron
Dit zorgt voor consistentie en onderhoudsbaarheid

Waarom Centralisatie?

Één bron van waarheid — Alle tokens op één plek
Geen duplicatie — Geen colors.css, spacing.css, buttons-variables.css
Eenvoudiger onderhoud — Wijzigingen werken overal door
Consistentie — Geen conflicterende waarden
Performance — Efficiënter cachen en laden

Token Naamgeving Structuur
css--{category}-{property}-{value}

Categorie: Colors (STRICT - ONLY THESE COLORS PERMITTED)
Reference: [Figma Design System](https://www.figma.com/design/0MVVbfmzBHoD5wVTeD6C2u/Ellens-en-Lentze?node-id=4304-962&t=k37vJFH53gE3ajyl-4)

css/* Mandatory Palette */
--color-primary: #004590;      /* Blue */
--color-secondary: #EF8A00;    /* Orange */
--color-dark-blue: #002752;    /* Dark Blue */
--color-light-blue: #F2F7FC;   /* Light Blue */
--color-white: #FCFCFC;        /* Off-White */
--color-neutral-dark: #171717; /* Dark Gray/Black */
--color-neutral-light: #F7F8FA;/* Light Gray */

Categorie: Spacing
css--spacing-xs: 0.25rem;   /* 4px */
--spacing-sm: 0.5rem;    /* 8px */
--spacing-md: 1rem;      /* 16px */
--spacing-lg: 1.5rem;    /* 24px */
--spacing-xl: 2rem;      /* 32px */
--spacing-2xl: 3rem;     /* 48px */
--spacing-3xl: 4rem;     /* 64px */


Categorie: Typography (STRICT)
Reference: [Figma Design System](https://www.figma.com/design/0MVVbfmzBHoD5wVTeD6C2u/Ellens-en-Lentze?node-id=4304-1009&t=k37vJFH53gE3ajyl-4)

css/* Font families */
--font-family-serif: 'DM Serif Display', serif;
--font-family-sans: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;

/* Headings (Strict) */
--h1-font-family: var(--font-family-serif);
--h1-font-size: 64px;
--h1-line-height: 58px;
--h1-letter-spacing: 2px;
--h1-font-weight: 400;

--h2-font-family: var(--font-family-serif);
--h2-font-size: 32px;
--h2-line-height: 32px;
--h2-letter-spacing: 0.64px;
--h2-font-weight: 400;

--h3-font-family: var(--font-family-serif);
--h3-font-size: 24px;
--h3-line-height: 36px;
--h3-letter-spacing: 2px;
--h3-font-weight: 400;

--h4-font-family: var(--font-family-serif);
--h4-font-size: 20px;
--h4-line-height: 36px;
--h4-letter-spacing: 2px;
--h4-font-weight: 400;

/* Body & UI (Strict) */
--body-font-family: var(--font-family-sans);
--body-font-size: 18px;
--body-line-height: 32px;
--body-letter-spacing: 1px;
--body-font-weight: 400;

--button-font-family: var(--font-family-sans);
--button-font-size: 16px;
--button-line-height: 32px;
--button-letter-spacing: 0px;
--button-font-weight: 400;


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
Token Implementatie (CORRECT PATROON)
Bestand: assets/css/globals/variables.css
css:root {
  /* Colors */
  --color-primary-500: #4f46e5;
  --color-primary-600: #4338ca;
  --color-neutral-500: #6b7280;
  
  /* Spacing */
  --spacing-xs: 0.25rem;
  --spacing-md: 1rem;
  --spacing-lg: 1.5rem;
  
  /* Borders */
  --border-radius-md: 0.5rem;
  --border-width-thin: 1px;
  
  /* Shadows */
  --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
  --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
  
  /* Transitions */
  --transition-normal: 250ms cubic-bezier(0.4, 0, 0.2, 1);
}
Bestand: assets/css/components/button.css
css/* IMPORT GLOBALS - Gebruik ENKEL tokens uit variables.css */
@import '../globals/variables.css';

.button {
  padding: var(--spacing-md) var(--spacing-lg);
  background-color: var(--color-primary-500);
  border: var(--border-width-thin) solid var(--color-primary-600);
  border-radius: var(--border-radius-md);
  transition: background-color var(--transition-normal);
  font-family: var(--font-family-sans);
  box-shadow: var(--shadow-sm);
}

.button:hover {
  background-color: var(--color-primary-600);
  box-shadow: var(--shadow-md);
}

/* ✓ CORRECT: Alle waarden via tokens */
Anti-Pattern (NOOIT DOEN)
css/* ❌ NOOIT in component bestand */
:root {
  --local-padding: 1rem;        /* FOUT! */
  --button-color: #4f46e5;      /* FOUT! */
  --btn-border: 1px solid;      /* FOUT! */
}

/* ❌ NOOIT lokale variabelen */
.button {
  --padding: var(--spacing-md); /* FOUT! */
  --bg: #4f46e5;                /* FOUT! */
  padding: var(--padding);
  background: var(--bg);
}

/* ❌ NOOIT duplicate bestanden */
/* assets/css/components/button-colors.css - FOUT! */
/* assets/css/components/button-spacing.css - FOUT! */
/* assets/css/colors/button.css - FOUT! */
Regels voor Token Beheer

ALLE tokens in één bestand: assets/css/globals/variables.css
GEEN andere variabele bestanden in project
GEEN component-specifieke tokens in component CSS
Importeer globals in alle component CSS bestanden
Hergebruik tokens — maak geen duplicaten
Naamgeving consistent — volg --{category}-{property}-{value} patroon
Documenteer toevoegingen — comment bij nieuwe tokens

Tokens Uitbreiden (CORRECT PATROON)
Stap 1: Token toevoegen in assets/css/globals/variables.css
css:root {
  /* Existing tokens... */
  
  /* Nieuwe token */
  --color-accent-500: #ec4899;
}
Stap 2: Token gebruiken in component
css@import '../globals/variables.css';

.hero-accent {
  color: var(--color-accent-500); /* ✓ Werkt! */
}
NOOIT:
css/* ❌ Dit doen */
.hero-accent {
  --color-accent-500: #ec4899; /* Fout! */
  color: var(--color-accent-500);
}