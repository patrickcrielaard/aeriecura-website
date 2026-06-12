# AerieCura — Flatsome child theme

**Versie 2.0** — UX Builder edit-flow. Geen ACF Pro nodig (ACF Free volstaat, of helemaal geen ACF).

## Wat is er nieuw t.o.v. v1.x

- ❌ **Geen ACF Pro meer nodig** — site-instellingen via WordPress Customizer
- ❌ **Geen hardcoded page templates** — pagina's worden WP-pagina's, opgebouwd uit shortcodes in UX Builder
- ✅ **Demo content** (XML) die de 5 pagina's importeert met alle secties als shortcodes
- ✅ **Iedere sectie heeft attributen** — tekst aanpassen in UX Builder zonder PHP aan te raken
- ✅ **5 productcategorieën** worden meegeïmporteerd

## Installatie (volgorde belangrijk!)

### 1. Theme installeren
1. Flatsome (parent) installeren en activeren
2. Deze `flatsome-aeriecura.zip` uploaden via WP-admin → Uiterlijk → Thema's → Nieuw → Uploaden
3. **Activeren** als AerieCura (Flatsome child)

### 2. Permalinks
- Instellingen → **Permalinks** → opslaan (vereist voor `/producten/` CPT slug)

### 3. Demo content importeren (optioneel maar aanbevolen)
- Tools → Plugins → **WordPress Importer** installeren
- Tools → Import → WordPress → kies `aeriecura-demo-content.xml`
- Importeert: Home, Over ons, Voor zorgverleners, Contact, Nieuws + 5 productcategorieën

### 4. Front-page instellen
- Instellingen → Lezen → "Op je startpagina toont" → **Een statische pagina**
- Voorpagina: **Home**
- Berichten-pagina: **Nieuws**

### 5. Bedrijfsgegevens invullen
- Uiterlijk → **Customizer** → AerieCura — Bedrijfsgegevens (telefoon, e-mail, adres, KvK, BTW, tagline)
- Uiterlijk → Customizer → AerieCura — Lijsten (leveranciers, certificeringen, webshops)

### 6. Menu aanmaken
- Uiterlijk → Menu's → Nieuw menu "Primair" → vink alle pagina's aan → toewijzen aan locatie "Primair menu"

## Beschikbare shortcodes (drop in UX Builder)

| Shortcode | Wat |
|---|---|
| `[aeriecura_hero variant="a" title="..." lead="..." cta_label="..." cta_url="..."]` | Hero met productkaart-illustratie |
| `[aeriecura_trust_strip]` | Leveranciers-balk (data uit Customizer) |
| `[aeriecura_categories bg="alt"]` | 5-koloms productcategorie-grid |
| `[aeriecura_value_props eyebrow="..." title="..." lead="..." bg="alt"]` | 6 value-cards |
| `[aeriecura_stats eyebrow="..." title="..." lead="..."]` | 4 stats + certificeringen |
| `[aeriecura_news]` | Laatste 3 berichten |
| `[aeriecura_cta_band eyebrow="..." title="..." text="..." cta_label="..." cta_url="..."]` | Donkere offerte-CTA |
| `[aeriecura_page_header eyebrow="..." title="..." subtitle="..." crumb="..."]` | Page header met breadcrumb |
| `[aeriecura_contact_info]` | Adres/tel/e-mail block (uit Customizer) |
| `[aeriecura_icon name="heart-pulse" size="20"]` | Inline Lucide SVG icon |
| `[aeriecura_login]` | Login-link in header |

## Tekst aanpassen — drie manieren

1. **Per pagina via UX Builder** — open een pagina in UX Builder, klik op een `[aeriecura_*]` shortcode-blok en bewerk de attributen (`title`, `lead`, etc.). Of bewerk een `[ux_html]` blok om bespoke HTML te wijzigen.
2. **Site-wide via Customizer** — Uiterlijk → Customizer → AerieCura (telefoon, e-mail, leveranciers, certificeringen, webshops). Header en footer updaten automatisch.
3. **Vaste fallback-content** — in `parts/*.php` (waar geen shortcode-attribuut is). Bijvoorbeeld de 4 hero-illustratie tegeltjes of de 6 value-cards.

## Productcategorieën uitbreiden

- WP-admin → **Productcategorieën** → Nieuwe toevoegen
- Velden via ACF Free (als geïnstalleerd): icon (select), short_desc (text), item_count (number)
- Verschijnt automatisch op homepage en in /producten/ archive
- Sample SKU's en merken (repeater) vereisen ACF Pro — anders aanvullen in de WP-editor met HTML

## Theme structuur

```
flatsome-aeriecura/
├── style.css                ← theme header
├── functions.php            ← enqueue, includes
├── header.php               ← AerieCura header (top-bar + main bar)
├── footer.php               ← 5-koloms footer
├── page.php                 ← rendert UX Builder content of fallback page-header
├── index.php                ← blog index
├── archive-productcategorie.php
├── single-productcategorie.php
├── parts/                   ← shortcode-renderbare secties
│   ├── hero.php
│   ├── trust-strip.php
│   ├── categories.php
│   ├── value-props.php
│   ├── stats-band.php
│   ├── news-grid.php
│   └── cta-band.php
├── inc/
│   ├── icons.php            ← 20 inline Lucide SVG iconen
│   ├── nav-walker.php       ← minimal nav walker
│   ├── customizer.php       ← Customizer settings (vervangt ACF Options)
│   ├── cpt-productcategorie.php
│   ├── acf-fields.php       ← ACF Free compatible
│   ├── login-button.php
│   └── shortcodes.php       ← alle [aeriecura_*] shortcodes
└── assets/css/
    ├── tokens.css
    ├── aeriecura-core.css
    └── aeriecura.css
```
