# WP-admin snippets — kant-en-klare HTML

Plak-klare HTML voor de twee nieuwe v1.1-pagina's. Dit is **geen theme-code**
(WP Pusher / de theme-zip negeert deze map) — het is bedoeld om handmatig in
WordPress in een pagina te plakken.

| Bestand | Pagina | Slug |
|---|---|---|
| `mdr-page.html` | MDR-conformiteit | `mdr` |
| `webshops-page.html` | Webshops | `webshops` |

## Zo gebruik je ze

1. WP-admin → **Pagina's → Nieuwe pagina**. Geef de titel ("MDR-conformiteit"
   of "Webshops") en controleer dat de **slug** klopt (`mdr` / `webshops`).
2. Kies een **paginabreed / zonder zijbalk** sjabloon als dat er is.
3. **Blok-editor (Gutenberg):** voeg één **"Aangepaste HTML"**-blok toe en plak
   de volledige inhoud van het bestand.
   **UX Builder (Flatsome):** voeg een **"HTML"**-element toe en plak daarin.
4. Publiceren. De opmaak komt mee — alle CSS-classes en iconen zitten al in het
   theme (zorg dat je de laatste `flatsome-aeriecura.zip` hebt geüpload).
5. Voeg de pagina toe aan het **Primary menu** (zie `../UPDATE-2026-06-20.md` §9).

De pagina-titelkop, de secties en een afsluitende CTA-band zitten allemaal in de
HTML — je hoeft niets los op te bouwen. Wil je dat de CTA-band automatisch
meeverandert met latere wijzigingen? Vervang het laatste `<section>`-blok dan
door een Text-element met de shortcode `[aeriecura_cta_band]`.
