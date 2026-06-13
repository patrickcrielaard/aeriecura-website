# Deploy-handleiding — GitHub → live site via WP Pusher

Deze repo is de **bron** van het Flatsome child theme. Met de gratis plugin
[WP Pusher](https://wppusher.com/) haal je wijzigingen van GitHub naar de live
WordPress-site — met een **handmatige "Update now"-knop** als veiligheidscheck,
zodat er nooit per ongeluk iets live gaat.

```
Jij zegt iets → Claude past code aan → commit → push naar GitHub
                                                      │
                                          (jij klikt "Update now" in WP Pusher)
                                                      ▼
                                                 Live website
```

---

## Belangrijk: wat wél en niet via deze route gaat

| Via Git/WP Pusher (deze repo) | Níet via Git — staat in WordPress zelf |
|---|---|
| Theme-code: templates, PHP, CSS, layout, kleuren | Paginateksten, nieuwsberichten, afbeeldingen |
| Structuur van hero/footer/secties, shortcodes | Wat je in WP-admin typt of in UX Builder bouwt |
| Bedrijfslogica, iconen, nav-walker | Menu-items, Customizer-waarden, media |

Kort: **"verander de knopkleur" of "voeg een footer-kolom toe"** = code = deze route.
**"wijzig de homepage-tekst" of "plaats een nieuwsbericht"** = inhoud = doe je in WP-admin.

## Bron van waarheid

WP Pusher installeert rechtstreeks vanuit de **broncode** in
`handoff/flatsome-aeriecura/`. De `.zip`-bestanden in de repo-root zijn alléén
voor handmatige upload als terugvaloptie — die worden door WP Pusher genegeerd.
Na een code-wijziging worden de zips niet automatisch ververst; dat hoeft ook
niet voor deze route.

---

## Eenmalige opzet (± 10 minuten, in WP-admin)

### Voorwaarden
- Het **Flatsome parent-theme** is al geïnstalleerd en gelicentieerd op de site
  (dit is een *child* theme — het kan niet zonder de parent).
- Je hebt admin-toegang tot WordPress.
- De site is bereikbaar vanaf internet (dat is een live site per definitie).

### Stap 1 — WP Pusher installeren
1. Download de plugin-zip op <https://wppusher.com/> (gratis account → "Download").
2. WP-admin → **Plugins → Nieuwe plugin → Plugin uploaden** → kies de zip → **Nu installeren** → **Activeren**.

> De repo is **publiek**, dus je hoeft géén GitHub-token of account te koppelen.
> Dat is alleen nodig voor privé-repos (betaalde WP Pusher-versie).

### Stap 2 — Theme koppelen
WP-admin → **WP Pusher → Install Theme** en vul exact in:

| Veld | Waarde |
|---|---|
| Repository host | **GitHub** |
| Repository | `patrickcrielaard/aeriecura-website` |
| Repository branch | `main` |
| Repository subdirectory | `handoff/flatsome-aeriecura` |
| Push-to-Deploy | **uit laten** (zie hieronder) |
| Link installation | optioneel aanvinken |

Klik **Install theme**. WP Pusher haalt de broncode binnen en installeert het
child theme.

### Stap 3 — Activeren
WP-admin → **Weergave → Thema's** → activeer **AerieCura (Flatsome child)**.

> Stond er al een handmatig geüploade kopie van het theme? Verwijder die om
> dubbele mappen te voorkomen — laat alleen de WP Pusher-versie staan.

---

## Een wijziging live zetten (de dagelijkse flow)

1. Je vraagt hier een aanpassing; ik wijzig de code, commit en push naar `main`.
2. In WP-admin → **WP Pusher → Themes** zie je het theme staan.
3. Klik **Update now**. WP Pusher haalt de nieuwste `main` op en vervangt het theme.
4. Controleer de site. Klaar.

De knop is je veiligheidscheck: er gaat niets live tot jíj erop klikt.

---

## Later: volautomatisch maken (optioneel)

Wil je op termijn dat elke push meteen live gaat (zonder knop), zet dan
**Push-to-Deploy** aan:

1. WP Pusher → Themes → open het theme → vink **Push-to-Deploy** aan.
2. WP Pusher toont een **Webhook-URL**.
3. GitHub → repo **Settings → Webhooks → Add webhook** → plak de URL,
   Content type `application/json`, event "Just the push event" → **Add webhook**.

Vanaf dan deployt elke push naar `main` automatisch. Aangeraden om dit pas te
doen als je het ritme vertrouwt — voor een medische-groothandel-site is de
handmatige knop een prettige rem.

---

## Problemen oplossen

| Symptoom | Oorzaak / oplossing |
|---|---|
| "Theme not found in repository" | Subdirectory-pad klopt niet — moet exact `handoff/flatsome-aeriecura` zijn. |
| Theme is wit / parent ontbreekt | Flatsome parent-theme is niet geïnstalleerd of niet geactiveerd-baar. |
| Twee AerieCura-thema's in de lijst | Oude handmatige upload nog aanwezig — verwijder de niet-WP-Pusher-versie. |
| "Update now" doet niks | Cache/permalinks: ververs de WP Pusher-pagina; check of de push echt op `main` staat. |
| Privé-repo nodig in de toekomst | Vereist betaalde WP Pusher + een GitHub personal access token in WP Pusher-instellingen. |

---

*Voor de inhoudelijke architectuur, zie `handoff/WORDPRESS-HANDOFF.md`.*
