# AerieCura — WordPress / Flatsome Handoff

> Doel: dit document beschrijft hoe het HTML-prototype (`AerieCura Website.html`) wordt omgezet naar een productie-klaar Flatsome child theme + bijbehorende plugins. Bedoeld als briefing voor Claude Code of een ontwikkelaar.

---

## 1. Architectuur op hoofdlijnen

```
┌─────────────────────────────────────────────────────────────────┐
│  WordPress (Flatsome parent theme)                              │
│  ├── flatsome-aeriecura  (child theme — deze repo)              │
│  │     ├── style.css           ← theme-header + import core css  │
│  │     ├── functions.php       ← enqueue, ACF init, CPT registr. │
│  │     ├── assets/                                               │
│  │     │     ├── css/aeriecura.css   (Flatsome-scoped CSS)       │
│  │     │     ├── css/tokens.css       (kleuren / typografie)     │
│  │     │     ├── js/aeriecura.js      (login modal, modal helper)│
│  │     │     └── img/                                            │
│  │     ├── inc/                                                  │
│  │     │     ├── cpt-productcategorie.php                        │
│  │     │     ├── acf-fields.php                                  │
│  │     │     ├── menu-locations.php                              │
│  │     │     └── login-button.php                                │
│  │     ├── templates/                                            │
│  │     │     ├── page-home.php                                   │
│  │     │     ├── page-over.php                                   │
│  │     │     ├── page-producten.php                              │
│  │     │     ├── page-zorgverleners.php                          │
│  │     │     ├── page-contact.php                                │
│  │     │     └── single-productcategorie.php                     │
│  │     └── parts/                                                │
│  │           ├── hero-split.php                                  │
│  │           ├── hero-editorial.php                              │
│  │           ├── hero-dark.php                                   │
│  │           ├── category-grid-compact.php                       │
│  │           ├── category-grid-detailed.php                      │
│  │           ├── category-grid-featured.php                      │
│  │           ├── value-props.php                                 │
│  │           ├── trust-strip.php                                 │
│  │           ├── stats-band.php                                  │
│  │           ├── cta-band.php                                    │
│  │           └── news-grid.php                                   │
│  │                                                                │
│  ├── plugins/                                                    │
│  │     ├── aeriecura-b2b/        ← LATER, via Claude Code         │
│  │     │     │  (klantportaal, contractprijzen, ordergeschiedenis)│
│  │     │     ├── aeriecura-b2b.php                               │
│  │     │     ├── includes/                                       │
│  │     │     ├── templates/                                      │
│  │     │     └── assets/                                         │
│  │     │                                                          │
│  │     └── aeriecura-admin/      ← LATER, via Claude Code         │
│  │           (de "Inloggen" plugin uit de briefing — bv. SSO, 2FA,│
│  │            of een custom admin-dashboard voor inkoop)         │
│  │           ├── aeriecura-admin.php                             │
│  │           ├── includes/                                       │
│  │           └── assets/                                         │
│  │                                                                │
│  └── content (database)                                          │
│        ├── Pages          (Home, Over, Producten, …)             │
│        ├── Posts          (Nieuws)                               │
│        ├── productcategorie (CPT — Bloeddrukmeters, ECG, …)      │
│        └── ACF Options    (Footer, contactgegevens, certificaten)│
└─────────────────────────────────────────────────────────────────┘
```

**Twee duidelijke uitbreidingsroutes naar later:**
1. `aeriecura-b2b` — nieuwe plugin, levert het B2B-platform achter de pagina "Voor zorgverleners".
2. `aeriecura-admin` — nieuwe plugin, hangt achter de "Inloggen"-knop rechtsboven. Het child theme heeft alleen een **link** naar `wp_login_url()` (of een filter-hook waar deze plugin op aanhaakt).

---

## 2. Bestanden vanuit prototype → WordPress

| Prototype bestand                | Bestemming                                                                |
|----------------------------------|---------------------------------------------------------------------------|
| `styles.css`                     | `flatsome-aeriecura/assets/css/aeriecura.css` (zie `FLATSOME-MAPPING.md`) |
| `assets/colors_and_type.css`     | `flatsome-aeriecura/assets/css/tokens.css`                                |
| `assets/logo-wordmark.svg`       | upload naar Customizer → Site Identity → Logo                             |
| `assets/logo-mark-blue.svg`      | upload naar Customizer → Site Identity → Favicon                          |
| `components.jsx` (icoonset)      | iconen worden ge-render als inline SVG via een `aeriecura_icon( $name )` helper of als `<i class="icon-…">` met een lokaal icon-font |
| `shell.jsx` (Header / Footer)    | Flatsome **Header Builder** + **Footer Builder** (UI), niet als template |
| `pages-home.jsx` (HomePage)      | pagina "Home" met UX Builder, samengesteld uit de `parts/*.php`           |
| `pages-rest.jsx` (Over/Producten/B2B/Nieuws/Contact) | overeenkomstige pagina's via UX Builder       |
| `LoginModal`                     | wordt **niet** een modal — vervangen door `wp_login_url()` redirect       |

---

## 3. Custom Post Type — `productcategorie`

```php
// inc/cpt-productcategorie.php
register_post_type( 'productcategorie', [
  'label'         => 'Productcategorieën',
  'public'        => true,
  'has_archive'   => 'producten',           // /producten/ overzicht
  'rewrite'       => [ 'slug' => 'producten' ],
  'menu_icon'     => 'dashicons-heart',
  'show_in_rest'  => true,
  'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
] );
```

Vooraf in te voeren records (komen overeen met `CATEGORIES` in het prototype):

| Title           | slug             | menu_order | acf: icon       | acf: count |
|-----------------|------------------|------------|-----------------|------------|
| Bloeddrukmeters | bloeddrukmeters  | 10         | heart-pulse     | 42         |
| Thermometers    | thermometers     | 20         | thermometer     | 18         |
| Saturatiemeters | saturatiemeters  | 30         | wind            | 12         |
| ECG-apparatuur  | ecg              | 40         | activity        |  9         |
| Weegschalen     | weegschalen      | 50         | scale           | 14         |

---

## 4. ACF velden

> Wij gaan uit van ACF Pro (Flatsome heeft dit niet by default — los aanschaffen).

### 4.1 Field group: **Productcategorie meta** — locatie `Post Type == productcategorie`
| Naam (label)           | name           | type          | Toelichting                         |
|------------------------|----------------|---------------|-------------------------------------|
| Icoon                  | icon           | select        | choices: heart-pulse, thermometer, wind, activity, scale, package, shield-check |
| Korte beschrijving     | short_desc     | text          | max 90 tekens — gebruikt in tegels  |
| Aantal artikelen       | item_count     | number        | of dynamisch via gerelateerd CPT    |
| Hoofdmerken            | brands         | repeater      | naam, logo (image)                  |
| Voorbeeld-SKU's        | sample_skus    | repeater      | naam, artikelnummer, mdr_class      |

### 4.2 Field group: **Homepage** — locatie `Page == Home`
| Naam                  | name           | type          | Toelichting                          |
|-----------------------|----------------|---------------|--------------------------------------|
| Hero variant          | hero_variant   | radio         | choices: split, editorial, dark      |
| Hero eyebrow          | hero_eyebrow   | text          | "Specialistische groothandel"        |
| Hero titel            | hero_title     | text          |                                      |
| Hero tekst            | hero_lead      | textarea      |                                      |
| Primair CTA (label)   | hero_cta_label | text          |                                      |
| Primair CTA (link)    | hero_cta_url   | page_link     |                                      |
| Productcategorie layout | cat_layout   | radio         | choices: compact, detailed, featured |
| Featured categorie    | cat_featured   | post_object   | post_type productcategorie           |
| Stat 1 nummer / label | stat_1_*       | text          | (idem 2, 3, 4)                       |

### 4.3 Field group: **Site opties** — locatie `Options Page == "AerieCura"`
| Naam                  | name                | type        |
|-----------------------|---------------------|-------------|
| Telefoonnummer        | phone               | text        |
| E-mailadres           | email               | email       |
| Adres regel 1         | address_line1       | text        |
| Adres regel 2         | address_line2       | text        |
| KvK                   | kvk                 | text        |
| BTW                   | btw                 | text        |
| Certificeringen       | certifications      | repeater (label) |
| Leveranciers logo's   | supplier_logos      | repeater (name, image) |
| Webshop links         | webshops            | repeater (name, url) |

ACF Options page registreren in `functions.php`:
```php
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( [
        'page_title' => 'AerieCura',
        'menu_slug'  => 'aeriecura-options',
        'icon_url'   => 'dashicons-heart',
    ] );
}
```

### 4.4 Field group: **Nieuws meta** — locatie `Post Type == post`
| Naam     | name      | type   | Toelichting                                 |
|----------|-----------|--------|---------------------------------------------|
| Type     | post_type | select | productupdate, regelgeving, klantverhaal, inzicht, bedrijfsnieuws |
| Leestijd | read_time | number | minuten                                     |

(Categorie kan ook via ingebouwde WP-categorieën — kies één van beide en wees consistent.)

---

## 5. Menu's

In **Uiterlijk → Menu's** twee menu's aanmaken:

**Primary menu** (`primary`)
- Home → `/`
- Producten → `/producten/`  *(archive van CPT)*
- Over ons → `/over/`
- Voor zorgverleners → `/voor-zorgverleners/`
- Nieuws → `/nieuws/`
- Contact → `/contact/`

**Footer producten** — automatisch genereren in `parts/footer.php` via `get_posts( ['post_type' => 'productcategorie', 'orderby' => 'menu_order'] )`.

---

## 6. Header & Footer in Flatsome Header Builder

### Header — bovenste balk (`top-bar`)
- **Left**: leeg
- **Right**:
  - Custom HTML: `<i class="icon-phone"></i> +31 (0)182 000 000`
  - Custom HTML: `<i class="icon-email"></i> info@aeriecura.nl`
  - Custom HTML: `🌐 NL`

### Header — hoofdbalk (`main`)
- **Left**: Logo
- **Center**: Menu (Primary)
- **Right**:
  - Custom HTML — **inloggen** (zie sectie 8)
  - Button — "Offerte aanvragen" → `/contact/`, primary class `btn btn-primary btn-sm`

### Footer
Vijf kolommen via UX Builder:
1. Logo + tagline + bedrijfsgegevens (ACF Options)
2. Menu "Producten" — opgehaald uit CPT
3. Menu "Bedrijf"
4. Menu "Webshops" — uit ACF Options repeater `webshops`
5. Menu "Beheer" — inclusief link naar `<?php echo wp_login_url(); ?>` met label "Inloggen op WordPress"

Onderbalk: copyright + links naar privacy / voorwaarden / cookies.

---

## 7. Pagina templates — wat waar wordt opgebouwd

| Pagina prototype       | WP pagina | Template                  | Hoe samengesteld                              |
|------------------------|-----------|---------------------------|-----------------------------------------------|
| Home                   | "Home"    | `page-home.php` *(of UX Builder)* | hero, trust-strip, categories, value-props, stats, news, cta |
| Producten              | "Producten" / CPT archive | `archive-productcategorie.php` | Loop over CPT — gebruikt `parts/category-section.php` |
| Productcategorie detail| `single-productcategorie.php` | rendert ACF velden + producten | (toekomst — als straks WooCommerce wordt toegevoegd) |
| Over ons               | "Over ons"| `page-over.php` *(UX Builder)*    | sections: missie, tijdlijn, certificeringen |
| Voor zorgverleners     | "Voor zorgverleners" | `page-zorgverleners.php` *(UX Builder)* | hero met "in ontwikkeling"-pill, features, cta |
| Nieuws                 | "Nieuws"  | `home.php` of `archive.php`       | standaard WP loop met `news-row` markup |
| Contact                | "Contact" | `page-contact.php` *(UX Builder)* | contact-info links + WPForms / Contact Form 7 rechts |

**Belangrijk:** Flatsome **UX Builder** is de primaire content-tool. Page templates worden alleen aangemaakt waar de structuur strict is (single-productcategorie). Voor de rest werken we met **Custom HTML blocks** + **Row/Column** met onze CSS classes — zie `FLATSOME-MAPPING.md`.

---

## 8. De "Inloggen"-knop — voorbereiding op de admin-plugin

In het prototype opent dit een modal. Voor de eerste versie van de productie-site:

```php
// inc/login-button.php
function aeriecura_login_link() {
    /**
     * Filter laat de toekomstige aeriecura-admin plugin de URL en het label vervangen.
     * Default: gewoon wp_login_url() — gaat naar /wp-admin/.
     */
    $url   = apply_filters( 'aeriecura_login_url',   wp_login_url() );
    $label = apply_filters( 'aeriecura_login_label', __( 'Inloggen', 'aeriecura' ) );
    $icon  = apply_filters( 'aeriecura_login_icon',  'lock' );

    if ( is_user_logged_in() ) {
        $url   = apply_filters( 'aeriecura_logged_in_url',   admin_url() );
        $label = apply_filters( 'aeriecura_logged_in_label', __( 'Mijn account', 'aeriecura' ) );
        $icon  = apply_filters( 'aeriecura_logged_in_icon',  'user' );
    }

    printf(
        '<a class="login-link" href="%s" title="%s">%s %s</a>',
        esc_url( $url ),
        esc_attr__( 'Inloggen op het beheer', 'aeriecura' ),
        aeriecura_icon( $icon, 13 ),
        esc_html( $label )
    );
}
```

**Zo gebruikt:** In Header Builder → Custom HTML block (HTML-blocks voeren geen PHP uit, gebruik de shortcode):
```
[aeriecura_login]
```
In eigen PHP-templates kan wel direct `aeriecura_login_link();` worden aangeroepen — zo doet `header.php` van het child theme dat ook.

**Toekomst:** zodra `aeriecura-admin` plugin wordt gebouwd, kan die de filters overschrijven om bv. naar een SSO-pagina of een custom dashboard te wijzen — zónder het theme aan te raken.

---

## 9. Stappen-volgorde voor implementatie

Voor Claude Code (of de developer) — in deze volgorde:

1. **Setup**
   - [ ] Flatsome parent theme installeren
   - [ ] Child theme `flatsome-aeriecura` aanmaken met `style.css` header + `functions.php`
   - [ ] ACF Pro installeren
   - [ ] CSS bestanden enqueuen (zie `FLATSOME-MAPPING.md` voor scoping)

2. **Content modellen**
   - [ ] CPT `productcategorie` registreren
   - [ ] ACF field groups aanmaken (sectie 4)
   - [ ] ACF Options page registreren
   - [ ] 5 productcategorieën aanmaken met content uit prototype

3. **Site identity**
   - [ ] Logo + favicon uploaden
   - [ ] Site Title + Tagline instellen
   - [ ] Customizer kleuren matchen aan tokens (`--ac-blue` = `#1b5faa`)

4. **Menu's & header/footer**
   - [ ] Primary menu + Footer menu's
   - [ ] Header Builder configureren (sectie 6)
   - [ ] `aeriecura_login_link()` plaatsen
   - [ ] Footer Builder configureren

5. **Pagina's**
   - [ ] Pagina's aanmaken (Home, Over, Producten, Voor zorgverleners, Contact, Nieuws)
   - [ ] Met UX Builder + de classes uit `FLATSOME-MAPPING.md` opbouwen
   - [ ] Per pagina ACF velden invullen waar nodig

6. **Contactformulier**
   - [ ] WPForms Lite of CF7 installeren
   - [ ] Formulier maken met dezelfde velden (voornaam, achternaam, e-mail, organisatie, onderwerp, bericht)
   - [ ] CSS class `contact-form` aan formulier-wrapper geven

7. **QA**
   - [ ] Responsive testen op 1180 / 1024 / 940 / 720 / 375
   - [ ] WAVE / Lighthouse — focus states, ARIA, kleurcontrast
   - [ ] Cross-browser (Chrome, Safari, Firefox)
   - [ ] Cache headers / WP Rocket compatibel
   - [ ] WPML voorbereiding (alle strings via `__( '…', 'aeriecura' )`)

---

## 10. Voorbereiding op toekomstige plugins

### 10.1 `aeriecura-b2b` (klantportaal)
Wat dit theme **nu al** doet om dat straks soepel te ondersteunen:

- **Pagina "Voor zorgverleners"** is een aparte pagina met eigen template. De plugin kan de inhoud overrulen via:
  ```php
  add_filter( 'template_include', function( $template ) {
      if ( is_page( 'voor-zorgverleners' ) && defined( 'AERIECURA_B2B_VERSION' ) ) {
          return AERIECURA_B2B_PATH . '/templates/portal-landing.php';
      }
      return $template;
  } );
  ```
- **CSS classes** zoals `.b2b-mock`, `.b2b-features`, `.b2b-hero` zijn al gedefinieerd — de plugin kan ze hergebruiken voor de live versie van het portaal.
- **REST endpoints** worden door de plugin geregistreerd onder `/wp-json/aeriecura/v1/orders`, `/customers`, `/contracts`.

### 10.2 `aeriecura-admin` (de "Inloggen"-plugin)
- Haakt aan op de filters in `aeriecura_login_link()` (sectie 8).
- Kan eigen wp-admin pagina toevoegen via `add_menu_page()`.
- Kan een custom `/login` route bouwen die mooier oogt dan wp-login.php (optioneel).

---

## 11. Niet-functionele eisen

- **MDR / WKKGZ compliance** — alle productpagina's tonen de juiste documentatie. Niet hardgecodeerd: ACF veld op CPT.
- **Performance** — Critical CSS voor above-the-fold (Flatsome Lazy CSS optie + WP Rocket).
- **AVG** — geen externe fonts indien mogelijk; Quicksand zelf-hosten via `webfont-loader`.
- **Toegankelijkheid** — WCAG 2.1 AA — minimum kleurcontrast is al gegarandeerd door de tokens.
- **Vertaalbaar** — alle strings door `__()` of `_e()`, één tekstdomein `aeriecura`.

---

## 12. Open vragen voor de klant

> Vóór implementatie laten beantwoorden:

1. ACF Pro licentie aanwezig? Zo niet — alternatief is Meta Box of Pods.
2. WooCommerce uiteindelijk wel of niet? Beïnvloedt de CPT structuur — als ja, dan productcategorieën als WC-taxonomy.
3. Hosting (managed WP host bv. Kinsta vs. eigen server)? Beïnvloedt cache-strategie.
4. Welke contact-formulier-plugin? WPForms / CF7 / Gravity?
5. Meertaligheid op korte termijn? (WPML vs. Polylang vs. niet nu)
6. Cookie banner — eigen oplossing of plugin (Complianz, CookieYes)?
7. Welke analytics? GA4 / Plausible / Matomo?

---

**Versie:** 1.0 · 14 mei 2026
**Gebaseerd op prototype:** `AerieCura Website.html`
