# AerieCura — WordPress Handoff Package

Dit pakket bevat alles wat nodig is om het HTML-prototype van AerieCura te vertalen naar een productie-klare WordPress site op Flatsome.

## Inhoud

| Bestand                                | Voor wie               | Wat het is                                                              |
|----------------------------------------|------------------------|-------------------------------------------------------------------------|
| `WORDPRESS-HANDOFF.md`                 | Developer / Claude Code| Architectuur, CPT's, ACF velden, plugin-uitbreidingspunten              |
| `FLATSOME-MAPPING.md`                  | Developer / inhouds-bouwer | Block-voor-block instructies: welke Flatsome block, welke CSS class |
| `flatsome-aeriecura/`                  | Developer / Claude Code| Werkende child-theme boilerplate — direct te installeren                |
| `flatsome-aeriecura/assets/css/tokens.css`     | (in theme)     | Kleuren / typografie / spacing — als CSS custom properties              |
| `flatsome-aeriecura/assets/css/aeriecura.css`  | (in theme)     | Alle layout- en component-CSS uit het prototype                          |

## Aanbevolen volgorde

1. Lees eerst **WORDPRESS-HANDOFF.md** — hoog-niveau plaatje + ACF velden + plugin-routes
2. Installeer **flatsome-aeriecura/** als child theme (zie eigen README)
3. Werk daarna pagina voor pagina met **FLATSOME-MAPPING.md** ernaast

## Voor Claude Code

Beste prompt om mee te beginnen:

> *"Open de bijgevoegde handoff folder. Lees `WORDPRESS-HANDOFF.md` en `FLATSOME-MAPPING.md` integraal. Begin daarna met de TODO-lijst onderaan WORDPRESS-HANDOFF sectie 9. Werk in stappen, vraag bevestiging na elke fase. De `flatsome-aeriecura/` map is je startpunt — voeg ontbrekende partials toe in `parts/` en templates in `templates/` op basis van het prototype `AerieCura Website.html`."*

## Twee toekomstige plug-ins

Beide krijgen later hun eigen project met Claude Code:

- **`aeriecura-b2b`** — klantportaal achter `/voor-zorgverleners/`. Hangt aan via `template_include` filter.
- **`aeriecura-admin`** — vervangt de standaard wp-login achter de "Inloggen"-knop. Hangt aan via de `aeriecura_login_url` / `aeriecura_login_label` filters in `inc/login-button.php`.

Beide zijn al **voorbereid in het theme** — het theme zelf hoeft niet opnieuw aangeraakt te worden zodra de plug-ins er zijn.

---

*Versie 1.0 · 14 mei 2026 · op basis van prototype `AerieCura Website.html`*
