# DOEN — v1.1 live zetten

Afvinklijst om de v1.1-update (`handoff/UPDATE-2026-06-20.md`) live te krijgen.
De **theme-code** is al gedaan en gecommit; hieronder staat alleen wat **jij in
WordPress** doet. Vink af terwijl je gaat.

---

## 0. Theme live zetten (basis voor de rest)

- [ ] `flatsome-aeriecura.zip` uit de repo downloaden (laatste versie).
- [ ] WP-admin → **Weergave → Thema's → Nieuw thema toevoegen → Thema uploaden**
      → zip kiezen → bij de melding "thema bestaat al" kies **"Huidige met
      geüploade vervangen"**.
- [ ] Controleer dat **AerieCura (Flatsome child)** actief is en de site er goed
      uitziet (footer toont nu Assortiment, B2B-portaal, geen BTW-regel).

> Hierna zijn de nieuwe CSS-classes en iconen aanwezig — nodig voor stap 4.

---

## 1. Bedrijfsgegevens — Customizer  (UPDATE §8)

WP-admin → **Weergave → Customizer → AerieCura — Bedrijfsgegevens**

- [ ] Adres regel 1 → `Zuidbaan 548 F`
- [ ] Adres regel 2 → `2841 MD Moordrecht`
- [ ] KvK-nummer → `82024995`
- [ ] BTW-nummer → **leegmaken**
- [ ] (Contactpagina: controleer dat adres/KvK kloppen; BTW-regel weg)

## 2. Lijsten — Customizer  (UPDATE §7, §1)

WP-admin → **Customizer → AerieCura — Lijsten**

- [ ] Webshops (Naam | URL), één per regel:
  ```
  Alle webshops | /webshops/
  Bloeddrukmeter.shop | https://bloeddrukmeter.shop
  Rossmax.nl | https://rossmax.nl
  Thuismonitoring.nl | /webshops/
  Incontinentiemateriaal.nl | /webshops/
  ```
- [ ] Certificeringen: voeg `EUDAMED-registratie` toe.

## 3. Productcategorie toevoegen  (UPDATE §4)

WP-admin → **Productcategorieën → Nieuwe toevoegen**

- [ ] Titel `Bloedsuikermeters` · Icoon `droplet` · Volgorde `15`
- [ ] Korte beschrijving: `Glucosemeters, teststrips en lancetten.`
- [ ] Controleer volgordes van de andere 5: 10 / 20 / 30 / 40 / 50.
- [ ] Laat bij **alle** categorieën "Aantal artikelen" **leeg** (geen aantallen meer).

## 4. Twee nieuwe pagina's  (UPDATE §1, §2)

WP-admin → **Pagina's → Nieuwe pagina** → één "Aangepaste HTML"-blok plakken.
Bron: `handoff/wp-admin-snippets/` (zie de README daar).

- [ ] Pagina **MDR-conformiteit** (slug `mdr`) — plak `mdr-page.html`.
- [ ] Pagina **Webshops** (slug `webshops`) — plak `webshops-page.html`.

## 5. Menu's  (UPDATE §9)

> Belangrijk: het theme heeft een eigen menulocatie **"Primair menu"**. Zolang
> daar **geen** menu aan gekoppeld is, toont de site een vaste fallback van 6
> items (zonder Webshops/MDR). Je wijzigingen verschijnen pas ná het koppelen.

WP-admin → **Weergave → Menu's**

- [ ] Maak een menu aan (bijv. "Hoofdmenu") — of kies een bestaand menu.
- [ ] Voeg items toe via **Aangepaste links** (of Pagina-links zodra de pagina's
      bestaan):
  - Home → `/`
  - Assortiment → `/producten/`
  - Webshops → `/webshops/`
  - Over ons → `/over/`
  - Voor zorgverleners → `/voor-zorgverleners/`
  - MDR → `/mdr/`
  - Nieuws → `/nieuws/`
  - Contact → `/contact/`
- [ ] **Koppel het menu aan de locatie "Primair menu"** (Menu-instellingen →
      Weergavelocatie, of tab "Locaties beheren") en **sla op**. ← zonder deze
      stap blijft de fallback staan.
- [ ] (Optioneel) footer-menu "Bedrijf": MDR-conformiteit toevoegen — of laat de
      ingebouwde fallback staan, die toont MDR al.

---

## Klaar?

- [ ] Klik door Home, Assortiment, Webshops, MDR, Contact — alles toont correct.
- [ ] Login-knop rechtsboven opent `https://b2b.aeriecura.nl` in nieuw tabblad.

Inhoudelijke details per sectie: `handoff/UPDATE-2026-06-20.md`.
