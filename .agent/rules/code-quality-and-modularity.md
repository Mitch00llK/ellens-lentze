---
trigger: always_on
---

Code Kwaliteit en Modulaire Architectuur
Modulariteit Checklist (VERPLICHT VOOR FINALISERING)
Voor finalisering moet elke punt geverifieerd zijn:

✓ Elk module/klasse heeft ÉÉN duidelijk doel
✓ Geen duplicate logica (DRY principe)
✓ Dependencies vormen logische hiërarchie (geen circulaire refs)
✓ Alle modules zijn daadwerkelijk gebruikt
✓ Alle bestanden respecteren groottenlimits
✓ Entry points bevatten ALLEEN initialisatie

STOP als:

Code monolithisch of sterk gekoppeld is
Bestanden groottenlimits overschrijden
Meerdere verantwoordelijkheden per klasse/bestand
Circulaire dependencies bestaan
Business logica gemengd met initialisatie

DRY Principe (Don't Repeat Yourself)
Slechts: Dupliceer NOOIT logica. Extraheer naar utility of service.
javascript// ❌ SLECHT: Duplicate code
function formatDate1(date) {
  return new Date(date).toLocaleDateString('nl-NL');
}

function formatDate2(date) {
  return new Date(date).toLocaleDateString('nl-NL');
}

// ✓ GOED: Gecentral in utility
// utilities/date-formatter.js
export const formatDate = (date) => 
  new Date(date).toLocaleDateString('nl-NL');
SOLID Principes
S - Single Responsibility: Één verantwoordelijkheid per klasse/bestand
O - Open/Closed: Open voor uitbreiding, gesloten voor wijziging
L - Liskov Substitution: Subtypen moeten verwisselbaar zijn
I - Interface Segregation: Clients afhankelijk van specifieke interfaces
D - Dependency Inversion: Afhankelijk van abstracties, niet implementaties
Bestandsgroottenlimits (HARD LIMITS)
PHP Bestanden:        maximum 300 regels
JavaScript Bestanden: maximum 250 regels
CSS Bestanden:        maximum 200 regels
Reden: Leesbaarheid, onderhoud en testbaarheid.
Code Consolidatie
javascript// ❌ SLECHT: Variabelen overal
const btn = document.querySelector('button');
const input = document.querySelector('input');
const form = document.querySelector('form');

const handleClick = () => { /* ... */ };
const handleSubmit = () => { /* ... */ };

// ✓ GOED: Georganiseerd in module
class FormHandler {
  constructor(formSelector) {
    this.form = document.querySelector(formSelector);
    this.btn = this.form.querySelector('button');
    this.input = this.form.querySelector('input');
    this.init();
  }
  
  init() {
    this.btn.addEventListener('click', (e) => this.handleClick(e));
    this.form.addEventListener('submit', (e) => this.handleSubmit(e));
  }
}