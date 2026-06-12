# Flatsome — Class & Block Mapping

> Praktische hand-out voor wie de pagina's gaat opbouwen in UX Builder. Per sectie:
> 1. Welk **Flatsome blok** je gebruikt
> 2. Welke **CSS class** je in het "Advanced → CSS class" veld plakt
> 3. Welke **inhoud** erin moet

De CSS (`aeriecura.css`) doet de rest. Flatsome's eigen styling wordt grotendeels overschreven door onze tokens en class-namen.

---

## 0. Setup eerst

1. **Tokens & CSS enqueuen** — in `functions.php` van child theme:
   ```php
   add_action( 'wp_enqueue_scripts', function() {
       wp_enqueue_style(
           'aeriecura-tokens',
           get_stylesheet_directory_uri() . '/assets/css/tokens.css',
           [], '1.0'
       );
       wp_enqueue_style(
           'aeriecura',
           get_stylesheet_directory_uri() . '/assets/css/aeriecura.css',
           [ 'flatsome-main', 'aeriecura-tokens' ], '1.0'
       );
   }, 100 ); // priority 100 = na Flatsome
   ```

2. **Customizer → Style → Colors**
   - Primary color: `#1b5faa`
   - Secondary color: `#d3e5f8`
   - Success: `#1f7a4d`

3. **Customizer → Typography**
   - Body font: **Quicksand** (Google Fonts)
   - Heading font: **Quicksand**
   - Weights: 300, 400, 500, 600, 700

4. **Customizer → Layout**
   - Site width: `1200px` (matcht onze `.shell`)
   - Content width: 100%

---

## 1. Algemene principes

| Onze class           | Flatsome equivalent / locatie                                |
|----------------------|--------------------------------------------------------------|
| `.shell`             | Standaard Flatsome `.row-large` of `.row-medium` doet hetzelfde — gebruik onze class **niet** binnen UX Builder rijen. |
| `.section`           | Een **Section** met `padding-top/bottom = 96`                |
| `.section-alt`       | Section achtergrondkleur `#f6f8fb`                            |
| `.section-deep`      | Section achtergrondkleur `#103c6c`, tekstkleur wit            |
| `.eyebrow`           | Text block met class `eyebrow`                                |

> **Belangrijk:** Onze CSS staat los van Flatsome's `.col-inner` / `.row` — dat blijft Flatsome doen. Onze classes worden ofwel op **inner Text blocks** geplakt, ofwel via **HTML blocks** rechtstreeks.

---

## 2. Homepage — blok voor blok

### 2.1 Hero (variant A — split)
- **Section** — padding: 88px / 96px, achtergrond gradient ([custom CSS] toevoegen via Section's "CSS classes" veld: `hero hero-variant-a`)
- **Row** (binnen) — 2 columns, 55% / 45%
  - **Column 1**
    - Text block: `<span class="eyebrow">Specialistische groothandel</span>`
    - Heading H1: "Diagnostiek en monitoring die u kunt vertrouwen."
    - Text block (class `lead`): "AerieCura levert hoogwaardige medische apparatuur…"
    - Button row (Flatsome Button Group):
      - Button 1: "Bekijk ons assortiment" → /producten/ → class `btn btn-primary btn-lg`
      - Button 2: "Neem contact op" → /contact/ → class `btn btn-ghost btn-lg`
    - HTML block:
      ```html
      <div class="hero-trust">
        <div class="hero-trust-stat"><span class="hero-trust-stat-num">12+</span><span class="hero-trust-stat-lbl">Jaar ervaring</span></div>
        <div class="hero-trust-stat"><span class="hero-trust-stat-num">340+</span><span class="hero-trust-stat-lbl">Zorginstellingen</span></div>
        <div class="hero-trust-stat"><span class="hero-trust-stat-num">MDR</span><span class="hero-trust-stat-lbl">Conform leverancier</span></div>
      </div>
      ```
  - **Column 2** — HTML block met hero-illu (4 productkaarten in een grid):
    ```html
    <div class="hero-illu">
      <div class="hero-illu-grid">
        <!-- 4× tile-blokken -->
      </div>
    </div>
    ```

> **Alternatief:** maak van de hele hero één **PHP partial** (`parts/hero-split.php`) en plaats die in een UX Builder **HTML block** via een shortcode:
> ```php
> add_shortcode( 'aeriecura_hero', function( $atts ) {
>     $atts = shortcode_atts( [ 'variant' => 'split' ], $atts );
>     ob_start();
>     get_template_part( 'parts/hero', $atts['variant'] );
>     return ob_get_clean();
> } );
> ```
> Dan in UX Builder: `[aeriecura_hero variant="split"]`

### 2.2 Trust-strip
- **Section** zonder padding (16px top/bottom), class `trust-strip`
- **HTML block**:
  ```html
  <div class="trust-strip-inner">
    <div class="trust-strip-label">Vertrouwd<br>door</div>
    <div class="trust-strip-logos">
      <?php
      $logos = get_field( 'supplier_logos', 'option' );
      foreach ( $logos as $logo ) {
          printf(
            '<div class="trust-strip-logo"><img src="%s" alt="%s"></div>',
            esc_url( $logo['image']['url'] ),
            esc_attr( $logo['name'] )
          );
      }
      ?>
    </div>
  </div>
  ```

### 2.3 Productcategorieën
- **Section**, padding 96px
- **HTML block** met section-head + grid:
  ```html
  <div class="section-head">
    <div>
      <span class="eyebrow">Productcategorieën</span>
      <h2>Vijf categorieën, één betrouwbare leverancier</h2>
    </div>
    <p class="lead">Diagnostiek- en monitoring-apparatuur…</p>
  </div>
  <div class="cat-grid-compact">
    <?php
    $cats = get_posts( [ 'post_type' => 'productcategorie', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
    foreach ( $cats as $cat ) {
        $icon  = get_field( 'icon', $cat->ID );
        $desc  = get_field( 'short_desc', $cat->ID );
        $count = get_field( 'item_count', $cat->ID );
        ?>
        <a class="cat-tile" href="<?php echo esc_url( get_permalink( $cat ) ); ?>">
            <div class="cat-tile-icon"><?php aeriecura_icon( $icon, 26 ); ?></div>
            <div>
                <h3 class="cat-tile-title"><?php echo esc_html( $cat->post_title ); ?></h3>
                <p class="cat-tile-desc"><?php echo esc_html( $desc ); ?></p>
            </div>
            <span class="cat-tile-meta"><?php echo (int) $count; ?> artikelen</span>
        </a>
        <?php
    }
    ?>
  </div>
  ```

> Door `cat-grid-compact` → `cat-grid-detailed` → `cat-grid-featured` te wisselen (via ACF veld `cat_layout`) krijg je de drie layouts uit het prototype gratis.

### 2.4 Value props (Waarom AerieCura)
- **Section** class `section-alt`, padding 96px
- Row van **3 columns** — gebruik Flatsome's eigen **Icon Box** elementen
  - Icon Box → "Image" tab → upload SVG of pak Flatsome's icon set
  - Class op de Icon Box's Advanced → `value-card`
  - Inhoud: 6× boxes met titel + body (zie prototype `pages-home.jsx` voor copy)

### 2.5 Stats + certs
- HTML block:
  ```html
  <div class="stats-grid">
    <div class="stat-cell"><div class="stat-num">12+</div><div class="stat-lbl">Jaar ervaring in medische groothandel</div></div>
    <div class="stat-cell"><div class="stat-num">340+</div><div class="stat-lbl">Zorginstellingen werkt met ons</div></div>
    <div class="stat-cell"><div class="stat-num">95</div><div class="stat-lbl">SKU's in eigen voorraad</div></div>
    <div class="stat-cell"><div class="stat-num">24u</div><div class="stat-lbl">Gemiddelde levertijd NL</div></div>
  </div>
  <div class="certs-row" style="margin-top:32px;">
    <?php foreach ( get_field( 'certifications', 'option' ) as $cert ) : ?>
      <span class="cert-pill"><i class="icon-check"></i><?php echo esc_html( $cert['label'] ); ?></span>
    <?php endforeach; ?>
  </div>
  ```

### 2.6 News teaser
- Section class `section-alt`
- HTML block:
  ```html
  <div class="news-grid">
  <?php
  $posts = get_posts( [ 'numberposts' => 3 ] );
  foreach ( $posts as $p ) {
      // ... render .news-card markup
  }
  ?>
  </div>
  ```

### 2.7 CTA-band
- HTML block:
  ```html
  <div class="cta-band">
    <div>
      <span class="eyebrow">Klaar om te beginnen</span>
      <h2>Een offerte op maat voor uw instelling</h2>
      <p>Vertel ons wat u nodig heeft — we maken een vrijblijvend voorstel met staffelprijzen, levertijden en de bijbehorende documentatie.</p>
    </div>
    <div class="cta-band-actions">
      <a class="btn btn-on-deep btn-lg" href="/contact/">Vraag een offerte aan →</a>
      <a class="btn btn-outline-deep btn-lg" href="/voor-zorgverleners/">B2B-platform</a>
    </div>
  </div>
  ```

---

## 3. Producten-pagina

Bouw met **archive-productcategorie.php** (echte WP archive). Eenvoudige template:

```php
<?php get_header(); ?>
<section class="page-header">
  <div class="shell">
    <div class="breadcrumb"><a href="<?= esc_url( home_url() ); ?>">Home</a> › <span>Producten</span></div>
    <span class="eyebrow">Assortiment</span>
    <h1>Vijf categorieën — het volledige overzicht.</h1>
    <p>Ons assortiment is bewust afgebakend…</p>
  </div>
</section>

<section class="section">
  <div class="shell">
    <div class="cat-list">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'parts/category', 'section' ); ?>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php get_template_part( 'parts/cta', 'band' ); ?>
<?php get_footer(); ?>
```

---

## 4. Over ons-pagina (UX Builder)

| Sectie       | Block            | Class                          | Inhoud                                     |
|--------------|------------------|--------------------------------|--------------------------------------------|
| Page header  | Section          | `page-header`                  | breadcrumb + eyebrow + H1 + lead          |
| Missie       | Section padding 96 | -                            | Row 2-col, class `about-grid` op row      |
| Tijdlijn     | Section `section-alt` | -                         | HTML block met `.timeline` markup         |
| Certs        | Section padding 96 | -                            | HTML block met `.certs-row`               |
| CTA          | partial `parts/cta-band.php` | -                  |                                            |

---

## 5. Voor zorgverleners (B2B)

| Sectie     | Block   | Class           | Inhoud                                                |
|------------|---------|------------------|-------------------------------------------------------|
| Hero       | Section | `b2b-hero`       | Row 2-col → `b2b-hero-inner` — links tekst, rechts HTML block met `.b2b-mock` |
| Features   | Section | -                | Row 3-col met value-cards                             |
| CTA        | Section | `section-alt`    | gecentreerde tekst + button "Aanmelden voor de pilot" |

---

## 6. Contact

| Sectie       | Block               | Class            | Inhoud                                  |
|--------------|---------------------|------------------|-----------------------------------------|
| Page header  | Section             | `page-header`    | breadcrumb + H1 + lead                  |
| Body         | Section padding 96  | -                | Row 2-col, class `contact-grid`         |
|              | Column 1            | -                | HTML block met `<dl>` (ACF Options)     |
|              | Column 2            | -                | WPForms shortcode in wrapper `<div class="contact-form">…</div>` |

WPForms styling overrulen door form-classes in `aeriecura.css` te targeten:
```css
.contact-form .wpforms-field { /* gebruikt onze `.field` styling */ }
```

---

## 7. Nieuws

Pak Flatsome's standaard Blog index (archive.php) maar geef het een eigen template-file `home.php` met onze `.news-list` / `.news-row` markup. Zie sectie 2.6 voor het patroon.

---

## 8. CSS Scoping & specificiteit

Flatsome's eigen CSS is aggressief. Hier en daar moet je onze rules iets specifieker maken. Het bijgevoegde `aeriecura.css` is al licht aangepast — let op deze plekken als iets niet doorkomt:

| Probleem                                  | Oplossing                                                |
|-------------------------------------------|----------------------------------------------------------|
| Flatsome button styling overheerst        | Onze `.btn` regels zijn 2× specifieker gemaakt: `body .btn { … }` |
| Flatsome H2 margin                        | We overschrijven met `body .section-head h2 { margin: 0; }` |
| Header builder padding                    | Custom CSS in Customizer:<br>`.header-main { height: 76px !important; }` |
| Section default backgrounds               | Sections krijgen achtergrond via Flatsome's eigen color picker; onze `.section-alt` is reserve |

---

## 9. Mobile / responsive

Flatsome's eigen breakpoints (550px, 850px) komen meestal aardig overeen met de onze (720px, 880px, 1024px). De `aeriecura.css` heeft eigen media queries — die werken naast Flatsome's responsive sliders in UX Builder.

**Eén regel:** zet in elke Row de **mobile column-stacking** op "stack" (UX Builder doet dit by default).

---

## 10. Wat NIET overzetten

Een paar dingen uit het prototype zijn React-specifiek en moeten worden vervangen:

| Prototype                              | Vervangen door                                       |
|----------------------------------------|------------------------------------------------------|
| React state voor navigatie            | Echte WP-pagina's en `<a href>` links                |
| `LoginModal` component                 | `wp_login_url()` direct (geen modal in v1)           |
| `useTweaks` voor dark mode / hero variant | ACF veld `hero_variant` op de homepage; dark mode-toggle = optioneel als JS-snippet, lokale storage |
| `setRoute` calls                       | Reguliere links                                      |
| Inline SVG iconen via `<Icon name="…">` | `aeriecura_icon( 'heart-pulse' )` PHP helper die inline SVG print uit `parts/icons/{name}.svg` |
| `LoginModal` form validation           | nvt                                                  |

---

## 11. Definition of done

Per pagina:
- [ ] Visueel 1-op-1 met prototype (≤ 1200px en mobiel)
- [ ] ACF-velden correct ingevuld
- [ ] Schoon HTML — geen Flatsome `.col-inner` overlap met onze classes
- [ ] Lighthouse score ≥ 90 op alle 4 axes
- [ ] Geen console errors

---

**Versie:** 1.0 · 14 mei 2026
