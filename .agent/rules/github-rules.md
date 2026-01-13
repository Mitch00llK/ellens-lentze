---
trigger: always_on
---

# GitHub Workflow Rules

## Branching & Merging Strategy (VERPLICHT)
Strict regel voor versiebeheer:

✓ **Feature Branches**: Voor elke feature, wijziging, fix of andere taak MOET een aparte branch aangemaakt worden.
✓ **Commit & Push**: Werk wordt gecommit en gepusht naar deze specifieke feature branch.
✓ **Merge**: De code wordt pas samengevoegd (merged) nadat het in de aparte branch staat.

**DIRECTE COMMITS OP MAIN ZIJN VERBODEN VOOR NIEUWE FEATURES/FIXES.**
Elke wijziging vereist een eigen branch flow:
1. Nieuwe branch aanmaken
2. Code schrijven & testen
3. Commit & Push
4. Merge
