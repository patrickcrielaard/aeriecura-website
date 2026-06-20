/* global React, Icon, Button, Eyebrow, CertPill, CATEGORIES, NEWS, NewsGrid */
const { useState } = React;

/* ===== Page header helper ========================================== */
const PageHeader = ({ eyebrow, title, lead, crumbs, setRoute }) => (
  <section className="page-header">
    <div className="shell">
      {crumbs ? (
        <div className="breadcrumb">
          <a onClick={(e) => { e.preventDefault(); setRoute("home"); }} href="#">Home</a>
          <Icon name="chevron-right" size={12} />
          <span>{crumbs}</span>
        </div>
      ) : null}
      {eyebrow ? <Eyebrow>{eyebrow}</Eyebrow> : null}
      <h1>{title}</h1>
      {lead ? <p>{lead}</p> : null}
    </div>
  </section>
);

/* ===== OVER ONS ==================================================== */
const OverPage = ({ setRoute }) => (
  <>
    <PageHeader
      crumbs="Over ons"
      setRoute={setRoute}
      eyebrow="Over AerieCura"
      title="Een gespecialiseerde groothandel met focus op diagnostiek."
      lead="AerieCura is opgericht vanuit de overtuiging dat zorgverleners een leverancier verdienen die de techniek even goed kent als de klinische context. We leveren minder, maar beter."
    />

    <section className="section">
      <div className="shell">
        <div className="about-grid">
          <div>
            <Eyebrow>Onze missie</Eyebrow>
            <h2>Diagnostiek-apparatuur die werkt — vandaag en over tien jaar.</h2>
            <p>AerieCura is een Nederlandse specialistische groothandel in medische apparatuur, gevestigd in Moordrecht. Wij leveren bloeddrukmeters, ECG's, saturatie- en thermometers en weegschalen aan ziekenhuizen, huisartsenpraktijken, GGZ-instellingen en thuiszorgorganisaties.</p>
            <p>Onze focus is bewust smal. We zijn geen alles-onder-één-dak-leverancier; we kennen elke fabrikant in ons assortiment persoonlijk, kunnen technische vragen direct beantwoorden, en houden ons aan de afspraak dat een artikel pas wordt opgenomen als we de hele keten — van fabrikant tot service na verkoop — volledig kunnen ondersteunen.</p>
            <p>Voor inkopers betekent dat: één aanspreekpunt, één contract, voorspelbare levertijden en transparante documentatie.</p>
          </div>
          <div className="about-side">
            <h3>Waar we voor staan</h3>
            <ul>
              <li><Icon name="check" size={18} /><span><strong>MDR-conform aanbod.</strong> Geen apparaat zonder dossier.</span></li>
              <li><Icon name="check" size={18} /><span><strong>Eigen voorraad.</strong> Geen drop-shipping; we leveren wat we beloven.</span></li>
              <li><Icon name="check" size={18} /><span><strong>Heldere prijsafspraken.</strong> Staffel- en contractprijzen op maat.</span></li>
              <li><Icon name="check" size={18} /><span><strong>Service na verkoop.</strong> IJking, onderhoud en RMA via één lijn.</span></li>
              <li><Icon name="check" size={18} /><span><strong>Korte beslislijnen.</strong> Inkoper, productspecialist en logistiek werken in één team.</span></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section className="section section-alt">
      <div className="shell">
        <div className="section-head">
          <div><Eyebrow>Tijdlijn</Eyebrow><h2>Hoe AerieCura is gegroeid</h2></div>
          <p className="lead">Van een specialistische bloeddruk-leverancier tot een breed inzetbare partner voor diagnostiek en monitoring.</p>
        </div>
        <div className="timeline">
          {[
            { y: "2014", h: "Oprichting in Moordrecht",                d: "Start als specialistische groothandel met een focus op bloeddrukmeters voor de eerste lijn." },
            { y: "2017", h: "Uitbreiding naar consumentenkanaal",     d: "Lancering van Bloeddrukmeter.shop en Incontinentiemateriaal.nl." },
            { y: "2020", h: "Saturatiemeters tijdens COVID-19",       d: "Versnelde opschaling van pulsoximeter-voorraad voor ziekenhuizen en huisartsenposten." },
            { y: "2022", h: "ISO 13485-certificering",                d: "Formalisering van het kwaliteitsmanagementsysteem voor medische hulpmiddelen." },
            { y: "2024", h: "MDR-conformiteit volledig geïmplementeerd",d: "Alle artikelen in het assortiment voldoen aan EU 2017/745 met volledig dossier." },
            { y: "2026", h: "Nieuw magazijn — 60% meer voorraad",    d: "Verhuizing naar een groter pand voor uitbreiding van het ECG- en weegschaal-assortiment." },
          ].map((t) => (
            <div key={t.y} className="timeline-row">
              <div className="timeline-year">{t.y}</div>
              <div><h4>{t.h}</h4><p>{t.d}</p></div>
            </div>
          ))}
        </div>
      </div>
    </section>

    <section className="section">
      <div className="shell">
        <div className="section-head">
          <div><Eyebrow>Certificeringen</Eyebrow><h2>Volledig dossier, transparant beschikbaar</h2></div>
          <p className="lead">Alle certificaten, conformiteitsverklaringen en kwaliteitsdocumenten zijn op aanvraag beschikbaar voor inkoop- en QMS-afdelingen.</p>
        </div>
        <div className="certs-row" style={{ gap: 12 }}>
          <CertPill>MDR EU 2017/745</CertPill>
          <CertPill>ISO 13485 : 2016</CertPill>
          <CertPill>ISO 9001 : 2015</CertPill>
          <CertPill>CE-gemarkeerd assortiment</CertPill>
          <CertPill>Farmatec geregistreerd</CertPill>
          <CertPill>GDP-richtlijn</CertPill>
          <CertPill>NEN-EN 60601-1</CertPill>
        </div>
      </div>
    </section>

    <CTABand setRoute={setRoute} />
  </>
);

/* ===== ASSORTIMENT ================================================= */
const ProductenPage = ({ setRoute }) => {
  const types = {
    bloeddrukmeters:   ["Bovenarm, automatisch", "Polsmodellen", "Handmatig (aneroïde)", "24-uurs (ABPM)"],
    bloedsuikermeters: ["Glucosemeters", "Teststrips", "Lancetten", "Continue glucosemonitoring (CGM)"],
    thermometers:      ["Infrarood voorhoofd", "Oorthermometers", "Contactthermometers", "Non-contact"],
    saturatiemeters:   ["Vingertop pulsoximeters", "Handheld monitoren", "Tafelmodellen", "Pediatrische sensoren"],
    ecg:               ["Rust-ECG", "Inspannings-ECG", "Draagbaar / Holter", "12-kanaals systemen"],
    weegschalen:       ["Personenweegschalen", "Bariatrische modellen", "Stoelweegschalen", "Babyweegschalen"],
  };
  return (
    <>
      <PageHeader
        crumbs="Assortiment"
        setRoute={setRoute}
        eyebrow="Assortiment"
        title="Zes categorieën — het volledige overzicht."
        lead="Ons assortiment is bewust afgebakend. We leveren wat zorgprofessionals dagelijks nodig hebben voor diagnostiek en monitoring, en doen dat volledig."
      />

      <section className="section">
        <div className="shell">
          <div className="cat-list">
            {CATEGORIES.map((c) => (
              <div key={c.id} className="cat-section" id={c.id}>
                <div className="cat-section-head">
                  <div className="cat-section-icon"><Icon name={c.icon} size={36} strokeWidth={1.5} /></div>
                  <div className="cat-section-meta">
                    <h2>{c.title}</h2>
                    <p>{c.desc} Leverbaar in meerdere uitvoeringen van toonaangevende fabrikanten.</p>
                  </div>
                  <div>
                    <Button variant="ghost" size="md" onClick={() => setRoute("contact")} withArrow>Vraag offerte</Button>
                  </div>
                </div>
                <div className="cat-products-list">
                  {types[c.id].map((t) => (
                    <div key={t} className="cat-product-row">
                      <div className="thumb"><Icon name={c.icon} size={26} strokeWidth={1.25} /></div>
                      <div>
                        <div className="name">{t}</div>
                        <div className="meta">MDR-conform · op aanvraag leverbaar</div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <CTABand setRoute={setRoute} />
    </>
  );
};

/* ===== B2B ========================================================= */
const B2BPage = ({ setRoute }) => (
  <>
    <section className="b2b-hero">
      <div className="shell">
        <div className="b2b-hero-inner">
          <div>
            <span className="b2b-status"><span className="dot" />In ontwikkeling — verwacht Q4 2026</span>
            <h1 style={{ marginTop: 16 }}>B2B-platform voor zorginstellingen.</h1>
            <p className="lead">Een omgeving waar uw inkopers en afdelingshoofden artikelen bestellen tegen contractprijzen, bestelhistorie inzien en de status van leveringen volgen — direct gekoppeld aan uw eigen inkoopsysteem.</p>
            <div className="hero-cta" style={{ marginTop: 24 }}>
              <Button variant="primary" size="lg" onClick={() => setRoute("contact")} withArrow>Vraag een pilot aan</Button>
              <Button variant="ghost" size="lg" onClick={() => setRoute("contact")}>Praat met onze accountmanager</Button>
            </div>
          </div>

          <div className="b2b-mock">
            <div className="b2b-mock-bar">
              <span className="dot" /><span className="dot" /><span className="dot" />
              <span style={{ marginLeft: "auto", fontSize: 11, color: "var(--fg-3)", fontFamily: "var(--font-mono)" }}>portaal.aeriecura.nl</span>
            </div>
            <div className="b2b-mock-body">
              <div className="b2b-mock-row">
                <div className="b2b-mock-stat"><div className="num">42</div><div className="lbl">Open bestellingen</div></div>
                <div className="b2b-mock-stat"><div className="num">€ 18,2k</div><div className="lbl">Maandbudget</div></div>
                <div className="b2b-mock-stat"><div className="num">3</div><div className="lbl">Wachtend op goedkeuring</div></div>
              </div>
              {[
                { ico: "heart-pulse", n: "Bloeddrukmeter bovenarm",  num: "AC-BLO-101", qty: "× 12" },
                { ico: "wind",        n: "Pulsoximeter vingertop",   num: "AC-SAT-102", qty: "× 24" },
                { ico: "activity",    n: "ECG-systeem 12-kanaals",   num: "AC-ECG-101", qty: "× 2"  },
                { ico: "thermometer", n: "Oorthermometer infrarood", num: "AC-THE-103", qty: "× 18" },
              ].map((r) => (
                <div key={r.num} className="b2b-mock-line">
                  <div className="ico"><Icon name={r.ico} size={14} /></div>
                  <div>{r.n}</div>
                  <div className="num">{r.num}</div>
                  <div className="qty">{r.qty}</div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>

    <section className="section">
      <div className="shell">
        <div className="section-head">
          <div><Eyebrow>Wat te verwachten</Eyebrow><h2>Gebouwd voor inkoopprocessen die werken</h2></div>
          <p className="lead">Het platform sluit aan op hoe Nederlandse zorginstellingen daadwerkelijk inkopen — met goedkeuringsstromen, kostenplaats-codering en automatische facturen op het juiste niveau.</p>
        </div>
        <div className="b2b-features">
          {[
            { i: "users",      h: "Meerdere bestellers per organisatie", p: "Verschillende rollen voor inkopers, hoofdverpleegkundigen en afdelingsmanagers — met autorisatie-niveaus." },
            { i: "file-text",  h: "Vaste contractprijzen",                 p: "Uw afgesproken prijzen, staffels en kortingen worden automatisch toegepast bij het bestelproces." },
            { i: "boxes",      h: "Eigen artikellijsten",                  p: "Stel een 'standaard pakket' samen voor uw afdeling. Herbestellen met één klik." },
            { i: "trending-up",h: "Verbruiksinzicht",                      p: "Maandelijkse rapporten per kostenplaats. Eenvoudige export naar Exact, AFAS of uw ERP." },
            { i: "shield-check", h: "Volledige documentatie per bestelling", p: "Conformiteitsverklaring, IFU en kalibratiecertificaten direct bij elke order beschikbaar." },
            { i: "headset",    h: "Toegewezen accountmanager",             p: "Vaste contactpersoon voor uw organisatie. Korte lijnen, geen ticketsysteem." },
          ].map((f) => (
            <div key={f.h} className="value-card">
              <div className="value-card-icon"><Icon name={f.i} size={22} /></div>
              <h3>{f.h}</h3>
              <p>{f.p}</p>
            </div>
          ))}
        </div>
      </div>
    </section>

    <section className="section section-alt">
      <div className="shell-narrow" style={{ textAlign: "center" }}>
        <Eyebrow>Pilot-programma</Eyebrow>
        <h2 style={{ marginTop: 14 }}>Vroege toegang voor een select aantal organisaties</h2>
        <p className="lead" style={{ margin: "16px auto 28px" }}>We werken met een beperkte groep zorginstellingen aan een pilot-versie van het platform. Geïnteresseerd om mee te denken? Laat het ons weten.</p>
        <Button variant="primary" size="lg" onClick={() => setRoute("contact")} withArrow>Aanmelden voor de pilot</Button>
      </div>
    </section>
  </>
);

/* ===== MDR ========================================================= */
const MDRPage = ({ setRoute }) => (
  <>
    <PageHeader
      crumbs="MDR-conformiteit"
      setRoute={setRoute}
      eyebrow="Regelgeving"
      title="MDR-conformiteit — geen apparaat zonder dossier."
      lead="Elk medisch hulpmiddel in ons assortiment voldoet aan de Europese verordening medische hulpmiddelen (EU 2017/745). Wij dragen de verantwoordelijkheid van importeur en distributeur, en stellen het volledige dossier op aanvraag beschikbaar."
    />

    <section className="section">
      <div className="shell">
        <div className="about-grid">
          <div>
            <Eyebrow>Wat is de MDR</Eyebrow>
            <h2 style={{ marginTop: 12 }}>De Europese verordening medische hulpmiddelen</h2>
            <p>De Medical Device Regulation (MDR), formeel verordening EU 2017/745, is sinds 26 mei 2021 volledig van kracht en vervangt de oude richtlijn 93/42/EEG. De MDR stelt strengere eisen aan de veiligheid, prestaties en traceerbaarheid van medische hulpmiddelen gedurende hun hele levenscyclus.</p>
            <p>Voor zorginstellingen betekent dit dat ieder hulpmiddel een aantoonbaar dossier moet hebben: een geldige CE-markering onder de MDR, een unieke identificatie (UDI), een conformiteitsverklaring en een gebruiksaanwijzing. Bij een audit of incident moet die documentatie binnen handbereik zijn.</p>
            <p>Als specialistische groothandel nemen wij de rol van importeur en distributeur. Wij controleren of fabrikanten aan hun verplichtingen voldoen, houden traceerbaarheid op partijniveau bij en bewaren alle documentatie centraal — zodat u zich op de zorg kunt richten.</p>
          </div>
          <div className="about-side">
            <h3>De MDR in het kort</h3>
            <ul>
              <li><Icon name="check" size={18} /><span><strong>EU 2017/745.</strong> Volledig van kracht sinds 26 mei 2021.</span></li>
              <li><Icon name="check" size={18} /><span><strong>CE onder de MDR.</strong> Niet hetzelfde als de oude MDD-markering.</span></li>
              <li><Icon name="check" size={18} /><span><strong>UDI-plicht.</strong> Unieke identificatie per hulpmiddel, registreerbaar in EUDAMED.</span></li>
              <li><Icon name="check" size={18} /><span><strong>Traceerbaarheid.</strong> Van fabrikant tot eindgebruiker, op partijniveau.</span></li>
              <li><Icon name="check" size={18} /><span><strong>Post-market surveillance.</strong> Doorlopende bewaking na in de handel brengen.</span></li>
              <li><Icon name="check" size={18} /><span><strong>Vigilantie.</strong> Meldplicht bij incidenten en corrigerende acties.</span></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section className="section section-alt">
      <div className="shell">
        <div className="section-head">
          <div><Eyebrow>Onze verantwoordelijkheid</Eyebrow><h2>Hoe wij conformiteit borgen</h2></div>
          <p className="lead">Als importeur en distributeur hebben wij eigen verplichtingen onder de MDR. Wij vertrouwen niet blind op de fabrikant, maar verifiëren en documenteren elke schakel.</p>
        </div>
        <div className="values-grid">
          {[
            { i: "shield-check", h: "Verificatie van CE-markering", p: "Wij nemen geen artikel op zonder geldige CE-markering onder de MDR en een verklaring van overeenstemming van de fabrikant." },
            { i: "file-text",    h: "Volledig technisch dossier",   p: "Conformiteitsverklaring, IFU, certificaten van de aangemelde instantie en risicodossier — centraal bewaard en opvraagbaar." },
            { i: "boxes",        h: "UDI-registratie",               p: "Iedere referentie is voorzien van een unieke identificatie (UDI-DI). Wij houden de koppeling met partij en levering bij." },
            { i: "truck",        h: "Traceerbaarheid op partijniveau", p: "Wij registreren welke partij naar welke afnemer is gegaan, zodat een terugroepactie gericht en volledig kan verlopen." },
            { i: "search",       h: "Post-market surveillance",      p: "Wij volgen meldingen, field safety notices en updates van fabrikanten en geven relevante informatie tijdig aan u door." },
            { i: "headset",      h: "Vigilantie en meldpunt",        p: "Eén aanspreekpunt voor incidentmeldingen. Wij coördineren met fabrikant en, waar nodig, met de IGJ." },
          ].map((f) => (
            <div key={f.h} className="value-card">
              <div className="value-card-icon"><Icon name={f.i} size={22} /></div>
              <h3>{f.h}</h3>
              <p>{f.p}</p>
            </div>
          ))}
        </div>
      </div>
    </section>

    <section className="section">
      <div className="shell">
        <div className="section-head">
          <div><Eyebrow>Het dossier</Eyebrow><h2>Wat u bij elke levering ontvangt</h2></div>
          <p className="lead">Voor inkoop-, kwaliteits- en QMS-afdelingen leveren wij de documentatie die u nodig heeft om uw eigen conformiteit aan te tonen — desgewenst digitaal per bestelling.</p>
        </div>
        <div className="mdr-doclist">
          {[
            { i: "file-text",   t: "Verklaring van overeenstemming (DoC)", d: "De EU-conformiteitsverklaring van de fabrikant per hulpmiddel." },
            { i: "shield-check", t: "CE-certificaat aangemelde instantie",  d: "Voor klasse IIa en hoger: het certificaat van de notified body." },
            { i: "package",     t: "Gebruiksaanwijzing (IFU)",             d: "Nederlandstalige instructies voor veilig gebruik en onderhoud." },
            { i: "boxes",       t: "UDI-DI en basis-UDI",                  d: "Unieke identificatie voor registratie in uw eigen systeem en EUDAMED." },
            { i: "clock",       t: "Kalibratie- en ijkcertificaat",        d: "Waar van toepassing, met vermelding van de geldigheidstermijn." },
            { i: "truck",       t: "Partij- en leveringsregistratie",      d: "Voor volledige traceerbaarheid bij audits of een terugroepactie." },
          ].map((r) => (
            <div key={r.t} className="mdr-doc-row">
              <div className="mdr-doc-icon"><Icon name={r.i} size={20} /></div>
              <div>
                <div className="mdr-doc-title">{r.t}</div>
                <div className="mdr-doc-desc">{r.d}</div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>

    <section className="section section-alt">
      <div className="shell">
        <div className="section-head">
          <div><Eyebrow>Certificeringen</Eyebrow><h2>Aantoonbaar en transparant</h2></div>
          <p className="lead">Ons kwaliteitsmanagementsysteem en assortiment zijn onafhankelijk getoetst. Alle onderliggende documenten zijn op aanvraag beschikbaar.</p>
        </div>
        <div className="certs-row" style={{ gap: 12 }}>
          <CertPill>MDR EU 2017/745</CertPill>
          <CertPill>ISO 13485 : 2016</CertPill>
          <CertPill>ISO 9001 : 2015</CertPill>
          <CertPill>CE-gemarkeerd assortiment</CertPill>
          <CertPill>Farmatec geregistreerd</CertPill>
          <CertPill>GDP-richtlijn</CertPill>
          <CertPill>NEN-EN 60601-1</CertPill>
          <CertPill>EUDAMED-registratie</CertPill>
        </div>
      </div>
    </section>

    <section className="section">
      <div className="shell-narrow" style={{ textAlign: "center" }}>
        <Eyebrow>Documentatie opvragen</Eyebrow>
        <h2 style={{ marginTop: 14 }}>Een specifiek dossier nodig voor een audit</h2>
        <p className="lead" style={{ margin: "16px auto 28px" }}>Vraag de conformiteitsverklaring, het IFU of het kalibratiecertificaat van een artikel op. Onze kwaliteitsafdeling levert het doorgaans binnen één werkdag.</p>
        <Button variant="primary" size="lg" onClick={() => setRoute("contact")} withArrow>Documentatie aanvragen</Button>
      </div>
    </section>

    <CTABand setRoute={setRoute} />
  </>
);

/* ===== WEBSHOPS ==================================================== */
const WebshopsPage = ({ setRoute }) => {
  const shops = [
    { icon: "heart-pulse", name: "Bloeddrukmeter.shop", domain: "bloeddrukmeter.shop", url: "https://bloeddrukmeter.shop",
      desc: "Onze consumentenwebshop voor bloeddrukmeters. Bovenarm en pols, voor thuisgebruik en de praktijk — met advies over de juiste keuze.", status: "live" },
    { icon: "stethoscope", name: "Rossmax.nl / Rossmax.shop", domain: "rossmax.nl · rossmax.shop", url: "https://rossmax.nl",
      desc: "Het officiële verkoopkanaal voor Rossmax-diagnostiek in de Benelux. Bloeddrukmeters, saturatiemeters en thermometers.", status: "live" },
    { icon: "activity", name: "Thuismonitoring.nl", domain: "thuismonitoring.nl", url: null, when: "Vanaf Q1 2027",
      desc: "Apparatuur en diensten voor monitoring op afstand en thuiszorg. Momenteel in ontwikkeling.", status: "soon" },
    { icon: "package", name: "Incontinentiemateriaal.nl", domain: "incontinentiemateriaal.nl", url: null, when: "Vanaf Q2 2027",
      desc: "Incontinentiemateriaal voor consumenten en zorgorganisaties. Momenteel in ontwikkeling.", status: "soon" },
  ];
  return (
    <>
      <PageHeader crumbs="Webshops" setRoute={setRoute}
        eyebrow="Onze webshops"
        title="Consumentenwebshops onder één dak."
        lead="Naast onze groothandel exploiteert AerieCura een aantal consumentgerichte webshops. Elke shop is gespecialiseerd in één productgebied, met dezelfde kwaliteits- en MDR-eisen als onze zakelijke leveringen." />
      <section className="section">
        <div className="shell">
          <div className="shop-grid">
            {shops.map((s) => (
              <div key={s.name} className="shop-card">
                <div className="shop-card-top">
                  <div className="shop-card-icon"><Icon name={s.icon} size={26} strokeWidth={1.5} /></div>
                  <div>
                    <h3 className="shop-card-name">{s.name}</h3>
                    <div className="shop-card-domain">{s.domain}</div>
                  </div>
                </div>
                <p className="shop-card-desc">{s.desc}</p>
                <div className="shop-card-foot">
                  {s.status === "live"
                    ? <span className="shop-status is-live"><span className="dot" />Online</span>
                    : <span className="shop-status is-soon"><span className="dot" />{s.when}</span>}
                  {s.url
                    ? <a className="shop-card-link" href={s.url} target="_blank" rel="noreferrer">Bezoek webshop<Icon name="external-link" size={15} /></a>
                    : <span className="shop-card-link is-muted">Binnenkort beschikbaar</span>}
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
      <CTABand setRoute={setRoute} />
    </>
  );
};

/* ===== NIEUWS ====================================================== */
const NieuwsPage = ({ setRoute }) => (
  <>
    <PageHeader crumbs="Nieuws" setRoute={setRoute}
      eyebrow="Nieuws & inzichten"
      title="Productupdates, regelgeving en klantverhalen."
      lead="Korte artikelen voor inkopers en zorgprofessionals. Geen ruis, alleen wat relevant is voor de keuze, het beheer en het gebruik van uw apparatuur." />
    <section className="section">
      <div className="shell">
        <div className="news-list">
          {NEWS.map((n) => (
            <a key={n.title} className="news-row" href="#" onClick={(e) => e.preventDefault()}>
              <div className="news-row-thumb"><Icon name={n.icon} size={42} strokeWidth={1.25} /></div>
              <div className="news-row-body">
                <h3>{n.title}</h3>
                <p>{n.desc}</p>
              </div>
              <div className="news-row-meta">
                <span className="tag">{n.tag}</span>
                <span className="date">{n.date}</span>
              </div>
            </a>
          ))}
        </div>
      </div>
    </section>
  </>
);

/* ===== CONTACT ===================================================== */
const ContactPage = ({ setRoute }) => {
  const [sent, setSent] = useState(false);
  return (
    <>
      <PageHeader crumbs="Contact" setRoute={setRoute}
        eyebrow="Contact"
        title="Korte lijnen, snelle reactie."
        lead="Of het nu om een offerte gaat, een technische vraag of een lopende bestelling — onze productspecialisten en accountmanagers staan u direct te woord." />
      <section className="section">
        <div className="shell">
          <div className="contact-grid">
            <div className="contact-info">
              <Eyebrow>Bereik ons</Eyebrow>
              <h2 style={{ marginTop: 12 }}>AerieCura B.V.</h2>
              <p className="lead" style={{ marginBottom: 32 }}>Onze klantenservice is op werkdagen bereikbaar van 08:30 tot 17:00. Vóór 16:00 besteld is dezelfde werkdag verzonden.</p>
              <dl>
                <dt>Adres</dt>     <dd>Zuidbaan 548 F<br />2841 MD Moordrecht</dd>
                <dt>Telefoon</dt>  <dd><a href="tel:+31000000000">+31 (0)182 000 000</a></dd>
                <dt>E-mail</dt>    <dd><a href="mailto:info@aeriecura.nl">info@aeriecura.nl</a></dd>
                <dt>Inkoop</dt>    <dd><a href="mailto:inkoop@aeriecura.nl">inkoop@aeriecura.nl</a></dd>
                <dt>Service</dt>   <dd><a href="mailto:service@aeriecura.nl">service@aeriecura.nl</a></dd>
                <dt>KvK</dt>       <dd>82024995</dd>
              </dl>
            </div>
            <form className="contact-form" onSubmit={(e) => { e.preventDefault(); setSent(true); }}>
              <h3 style={{ margin: "0 0 6px", fontSize: 19 }}>Stuur een bericht</h3>
              <p className="muted" style={{ fontSize: 14, margin: "0 0 12px" }}>We reageren binnen één werkdag.</p>
              {sent ? (
                <div style={{ padding: 16, background: "var(--ac-success-bg)", color: "var(--ac-success)", borderRadius: 10, fontSize: 14 }}>
                  Bedankt — we nemen contact op.
                </div>
              ) : (
                <>
                  <div className="field-row">
                    <div className="field"><label>Voornaam</label><input type="text" required /></div>
                    <div className="field"><label>Achternaam</label><input type="text" required /></div>
                  </div>
                  <div className="field-row">
                    <div className="field"><label>E-mailadres</label><input type="email" required /></div>
                    <div className="field"><label>Organisatie</label><input type="text" /></div>
                  </div>
                  <div className="field">
                    <label>Onderwerp</label>
                    <select defaultValue="">
                      <option value="" disabled>Kies een onderwerp…</option>
                      <option>Offerte aanvragen</option>
                      <option>Technische vraag</option>
                      <option>Service / RMA</option>
                      <option>B2B-pilot aanmelden</option>
                      <option>Overig</option>
                    </select>
                  </div>
                  <div className="field"><label>Bericht</label><textarea rows="5" required /></div>
                  <Button variant="primary" size="md" as="button">Bericht versturen<Icon name="send" size={14} /></Button>
                </>
              )}
            </form>
          </div>
        </div>
      </section>
    </>
  );
};

/* ===== Reusable CTA band =========================================== */
const CTABand = ({ setRoute }) => (
  <section className="section">
    <div className="shell">
      <div className="cta-band">
        <div>
          <Eyebrow>Klaar om te beginnen</Eyebrow>
          <h2>Een offerte op maat voor uw instelling</h2>
          <p>Vertel ons wat u nodig heeft — we maken een vrijblijvend voorstel met staffelprijzen, levertijden en de bijbehorende documentatie.</p>
        </div>
        <div className="cta-band-actions">
          <Button variant="on-deep" size="lg" onClick={() => setRoute("contact")} withArrow>Vraag een offerte aan</Button>
          <Button variant="outline-deep" size="lg" onClick={() => setRoute("b2b")}>B2B-platform</Button>
        </div>
      </div>
    </div>
  </section>
);

Object.assign(window, { OverPage, ProductenPage, B2BPage, MDRPage, WebshopsPage, NieuwsPage, ContactPage, CTABand, PageHeader });
