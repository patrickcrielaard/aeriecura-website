# Changelog — AerieCura (Flatsome child)

Alle wijzigingen aan het theme, nieuwste bovenaan. Het versienummer staat in
`style.css` (regel `Version:`) en is in WP-admin te zien onder
**Weergave → Thema's → AerieCura → Themadetails**.

Versienummers volgen `MAJOR.MINOR.PATCH`:
- **PATCH** (2.1.0 → 2.1.1): kleine correctie — tekst, link, bugfix.
- **MINOR** (2.1 → 2.2): nieuwe sectie, pagina-template of zichtbare uitbreiding.
- **MAJOR** (2 → 3): ingrijpende herbouw; vraagt mogelijk werk in WP-admin.

Elke versie heeft een git-tag (`v2.1.1` enz.) op GitHub, zodat je per versie
precies kunt zien welke code er live stond.

---

## 2.1.1 — 2026-10-10

- Footer, kolom "Beheer": link **API-documentatie** verwijderd.
- Versienummer wordt nu alleen uit `style.css` gelezen. Bij een nieuwe versie
  halen browsers daardoor automatisch de nieuwe CSS op in plaats van een oude
  versie uit hun cache.

## 2.1.0 — 2026-06-20

*Destijds uitgerold met versienummer 2.0.0; achteraf als 2.1.0 vastgelegd.*

- Assortiment uitgebreid van vijf naar **zes categorieën** (Bloedsuikermeters
  erbij) in footer, homepage-tegels en categorie-overzicht.
- Artikelaantallen op categorietegels vervangen door label **"MDR conform"**.
- Footer: kop "Producten" → "Assortiment", BTW-nummer weg, link
  **MDR-conformiteit** erbij.
- Footer, kolom "Beheer": "Inloggen op WordPress" vervangen door
  **B2B-portaal** (b2b.aeriecura.nl) en API-documentatie.
- Login-knop in de header wijst naar het B2B-portaal.
- Nieuwe iconen: droplet, boxes, search, headset, clock, stethoscope,
  external-link.
- Nieuwe CSS voor de MDR-documentenlijst en de Webshops-pagina.

## 2.0.0 — 2026-06-12

- Eerste versie van het child theme op basis van Flatsome, inclusief
  security-review fixes.
