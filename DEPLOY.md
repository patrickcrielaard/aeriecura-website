# Deploy-handleiding — GitHub → live site via theme-zip

Deze repo is de **bron** van het Flatsome child theme. Wijzigingen gaan live door
een verse theme-zip te uploaden in WP-admin. Er draait geen plugin of koppeling
met GitHub: er gaat pas iets live als jíj de zip uploadt.

```
Jij zegt iets → Claude past code aan → bouwt flatsome-aeriecura.zip → commit → push
                                                      │
                                   (jij uploadt de zip in WP-admin)
                                                      ▼
                                                 Live website
```

---

## Belangrijk: wat wél en niet via deze route gaat

| Via de theme-zip (deze repo) | Níet via de zip — staat in WordPress zelf |
|---|---|
| Theme-code: templates, PHP, CSS, layout, kleuren | Paginateksten, nieuwsberichten, afbeeldingen |
| Structuur van hero/footer/secties, shortcodes | Wat je in WP-admin typt of in UX Builder bouwt |
| Bedrijfslogica, iconen, nav-walker | Menu-items, Customizer-waarden, media |

Kort: **"verander de knopkleur" of "voeg een footer-kolom toe"** = code = deze route.
**"wijzig de homepage-tekst" of "plaats een nieuwsbericht"** = inhoud = doe je in WP-admin.

## Bron van waarheid

De broncode staat in `handoff/flatsome-aeriecura/`. De zip
`flatsome-aeriecura.zip` in de repo-root is daar een afgeleide van en moet na
**elke** code-wijziging opnieuw gebouwd worden — anders upload je een oude versie.

### Zip bouwen

Vanuit de repo-root:

```bash
cd handoff && rm -f ../flatsome-aeriecura.zip && zip -qr ../flatsome-aeriecura.zip flatsome-aeriecura -x "*.DS_Store"
```

De zip bevat één map `flatsome-aeriecura/` met daarin `style.css` — dat is wat
WordPress verwacht.

---

## Een wijziging live zetten (de dagelijkse flow)

1. Je vraagt hier een aanpassing; Claude wijzigt de code, verhoogt het
   versienummer, werkt de changelog bij, bouwt de zip opnieuw, commit, zet een
   versietag en pusht naar `main` (zie **Versiebeheer** hieronder).
2. WP-admin → **Weergave → Thema's → Nieuw thema → Thema uploaden**.
3. Kies `flatsome-aeriecura.zip` → **Nu installeren**.
4. WordPress ziet dat het thema al bestaat → klik **Vervang huidige met geüploade**.
5. Controleer de site (hard refresh met Cmd+Shift+R, of leeg de cache van de
   caching-plugin). Klaar.

Instellingen en inhoud blijven staan; alleen de theme-bestanden worden vervangen.
Gaat er iets mis, dan staat elke vorige versie in de git-geschiedenis.

Na de upload toont **Weergave → Thema's → AerieCura → Themadetails** het nieuwe
versienummer. Zo zie je welke versie er live staat.

---

## Versiebeheer

Bij **elke** theme-wijziging die live gaat:

1. **Versienummer verhogen** in `handoff/flatsome-aeriecura/style.css`
   (regel `Version:`). Dit is de enige plek; `functions.php` leest het daaruit.
   Patch (x.y.**Z**) voor kleine correcties, minor (x.**Y**.0) voor nieuwe
   onderdelen, major (**X**.0.0) voor een herbouw.
2. **Changelog bijwerken** in
   [`handoff/flatsome-aeriecura/CHANGELOG.md`](handoff/flatsome-aeriecura/CHANGELOG.md):
   nieuwe kop `## <versie> — <datum>` bovenaan, met in gewone taal wat er
   veranderd is.
3. **Zip bouwen** (commando hierboven), committen en pushen.
4. **Tag zetten** op die commit en pushen:

   ```bash
   git tag -a v2.1.1 -m "v2.1.1" && git push origin v2.1.1
   ```

Op GitHub zie je alle versies onder **Tags**, en het verschil tussen twee
versies via `https://github.com/patrickcrielaard/aeriecura-website/compare/v2.1.0...v2.1.1`.
Wijzigingen buiten het theme (prototype, documentatie, WP-admin-snippets)
krijgen geen versienummer.

### Voorwaarden
- Het **Flatsome parent-theme** is geïnstalleerd en gelicentieerd op de site
  (dit is een *child* theme — het kan niet zonder de parent).
- Je hebt admin-toegang tot WordPress.

---

## Problemen oplossen

| Symptoom | Oorzaak / oplossing |
|---|---|
| Wijziging niet zichtbaar na upload | Cache: hard refresh, of leeg de cache van de caching-plugin. Check ook of de zip na de wijziging opnieuw is gebouwd. |
| Geen knop "Vervang huidige met geüploade" | De mapnaam in de zip wijkt af van het geïnstalleerde thema — moet `flatsome-aeriecura/` zijn. |
| Theme is wit / parent ontbreekt | Flatsome parent-theme is niet geïnstalleerd of niet activeerbaar. |
| "Het pakket kon niet worden geïnstalleerd. Het thema mist het stylesheet style.css." | Zip is verkeerd gebouwd (bijv. de bestanden zonder de map ervoor). Bouw opnieuw met het commando hierboven. |
| Uploadlimiet overschreden | Vraag de hostingpartij de upload-limiet te verhogen, of upload de map via SFTP naar `wp-content/themes/`. |

---

*Voor de inhoudelijke architectuur, zie `handoff/WORDPRESS-HANDOFF.md`.*
