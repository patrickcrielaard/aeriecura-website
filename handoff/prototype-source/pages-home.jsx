/* global React, Icon, Button, Eyebrow, CertPill, CATEGORIES */
const { useState } = React;

/* ===== Trust strip ================================================== */
const TrustStrip = () => (
  <div className="trust-strip">
    <div className="trust-strip-inner">
      <div className="trust-strip-label">Vertrouwd<br />door</div>
      <div className="trust-strip-logos">
        {[
          { mark: "M", name: "Microlife" },
          { mark: "O", name: "Omron" },
          { mark: "B", name: "Beurer" },
          { mark: "S", name: "Schiller" },
          { mark: "W", name: "Welch Allyn" },
          { mark: "A", name: "A&D Medical" },
        ].map((b) => (
          <div key={b.name} className="trust-strip-logo">
            <span className="lg-mark" style={{ display: "inline-flex", alignItems: "center", justifyContent: "center", borderRadius: 4, background: "currentColor" }}>
              <span style={{ color: "var(--ac-surface)", fontWeight: 700, fontSize: 12 }}>{b.mark}</span>
            </span>
            {b.name}
          </div>
        ))}
      </div>
    </div>
  </div>
);

/* ===== Hero (3 variants) =========================================== */
const HeroIllu = () => (
  <div className="hero-illu">
    <div className="hero-illu-grid">
      {[
        { icon: "heart-pulse", label: "Bloeddrukmeter", meta: "Bovenarm · automatisch", spec: "MDR · Klasse IIa" },
        { icon: "activity",    label: "12-kanaals ECG", meta: "Rust-ECG",             spec: "12 lead · 1000 Hz" },
        { icon: "wind",        label: "Saturatiemeter", meta: "Vingertop pulsoximeter", spec: "SpO\u2082 70\u2013100%" },
        { icon: "thermometer", label: "Thermometer",    meta: "Infrarood voorhoofd",  spec: "\u00b1 0,2\u00b0C" },
      ].map((t, i) => (
        <div key={i} className="hero-illu-tile">
          <div className="hero-illu-tile-icon"><Icon name={t.icon} size={22} /></div>
          <div>
            <div className="hero-illu-tile-meta">{t.meta}</div>
            <div className="hero-illu-tile-label">{t.label}</div>
          </div>
          <div className="hero-illu-tile-spec">{t.spec}</div>
        </div>
      ))}
    </div>
  </div>
);

const HeroStats = () => (
  <div className="hero-trust">
    <div className="hero-trust-stat">
      <div className="hero-trust-stat-num">12+</div>
      <div className="hero-trust-stat-lbl">Jaar ervaring</div>
    </div>
    <div className="hero-trust-stat">
      <div className="hero-trust-stat-num">340+</div>
      <div className="hero-trust-stat-lbl">Zorginstellingen</div>
    </div>
    <div className="hero-trust-stat">
      <div className="hero-trust-stat-num">MDR</div>
      <div className="hero-trust-stat-lbl">Conform leverancier</div>
    </div>
  </div>
);

const Hero = ({ variant, setRoute }) => {
  const eyebrow = "Specialistische groothandel";
  const title = "Diagnostiek en monitoring die u kunt vertrouwen.";
  const lead = "AerieCura levert hoogwaardige medische apparatuur aan ziekenhuizen, huisartsenpraktijken en zorginstellingen. Bloeddrukmeters, ECG's, saturatie- en thermometers, weegschalen — zorgvuldig geselecteerd, MDR-conform, snel beschikbaar.";

  if (variant === "b") {
    return (
      <section className="hero hero-variant-b">
        <div className="shell">
          <Eyebrow>{eyebrow}</Eyebrow>
          <h1>{title}</h1>
          <p className="lead">{lead}</p>
          <div className="hero-cta">
            <Button variant="primary" size="lg" onClick={() => setRoute("producten")} withArrow>Bekijk ons assortiment</Button>
            <Button variant="ghost" size="lg" onClick={() => setRoute("contact")}>Neem contact op</Button>
          </div>
          <HeroStats />
        </div>
      </section>
    );
  }
  if (variant === "c") {
    return (
      <section className="hero hero-variant-c">
        <div className="shell">
          <div className="hero-grid">
            <div>
              <Eyebrow>{eyebrow}</Eyebrow>
              <h1>{title}</h1>
              <p className="lead">{lead}</p>
              <div className="hero-cta">
                <Button variant="on-deep" size="lg" onClick={() => setRoute("producten")} withArrow>Bekijk ons assortiment</Button>
                <Button variant="outline-deep" size="lg" onClick={() => setRoute("contact")}>Neem contact op</Button>
              </div>
              <HeroStats />
            </div>
            <HeroIllu />
          </div>
        </div>
      </section>
    );
  }
  return (
    <section className="hero hero-variant-a">
      <div className="shell">
        <div className="hero-grid">
          <div>
            <Eyebrow>{eyebrow}</Eyebrow>
            <h1>{title}</h1>
            <p className="lead">{lead}</p>
            <div className="hero-cta">
              <Button variant="primary" size="lg" onClick={() => setRoute("producten")} withArrow>Bekijk ons assortiment</Button>
              <Button variant="ghost" size="lg" onClick={() => setRoute("contact")}>Neem contact op</Button>
            </div>
            <HeroStats />
          </div>
          <HeroIllu />
        </div>
      </div>
    </section>
  );
};

/* ===== Category grids (3 layouts) ================================== */
const CategoryGrid = ({ layout, setRoute }) => {
  const onClick = () => setRoute("producten");
  if (layout === "detailed") {
    return (
      <div className="cat-grid-detailed">
        {CATEGORIES.map((c) => (
          <a key={c.id} className="cat-card-detailed" onClick={(e) => { e.preventDefault(); onClick(); }} href="#">
            <div className="cat-card-detailed-thumb"><Icon name={c.icon} size={56} strokeWidth={1.5} /></div>
            <div className="cat-card-detailed-body">
              <h3 className="cat-card-detailed-title">{c.title}</h3>
              <p className="cat-card-detailed-desc">{c.desc}</p>
              <div className="cat-card-detailed-tags">
                <CertPill>MDR conform</CertPill>
                <CertPill>Op aanvraag</CertPill>
              </div>
            </div>
          </a>
        ))}
      </div>
    );
  }
  if (layout === "featured") {
    const [first, ...rest] = CATEGORIES;
    return (
      <div className="cat-grid-featured">
        <a className="cat-card-featured-main" onClick={(e) => { e.preventDefault(); onClick(); }} href="#">
          <Eyebrow>Meest gekozen</Eyebrow>
          <h3>{first.title}</h3>
          <p>{first.desc} Van toonaangevende fabrikanten — geijkt en MDR-conform.</p>
          <div className="featured-illu"><Icon name={first.icon} size={120} strokeWidth={1.25} /></div>
        </a>
        <div className="cat-grid-featured-side">
          {rest.map((c) => (
            <a key={c.id} className="cat-card-featured-side" onClick={(e) => { e.preventDefault(); onClick(); }} href="#">
              <div className="cat-card-featured-side-icon"><Icon name={c.icon} size={20} /></div>
              <div>
                <div className="cat-card-featured-side-name">{c.title}</div>
                <div className="cat-card-featured-side-meta">{c.desc.split(",")[0]}</div>
              </div>
              <Icon name="chevron-right" size={18} />
            </a>
          ))}
        </div>
      </div>
    );
  }
  return (
    <div className="cat-grid-compact">
      {CATEGORIES.map((c) => (
        <a key={c.id} className="cat-tile" onClick={(e) => { e.preventDefault(); onClick(); }} href="#">
          <div className="cat-tile-icon"><Icon name={c.icon} size={26} /></div>
          <div>
            <h3 className="cat-tile-title">{c.title}</h3>
            <p className="cat-tile-desc">{c.desc}</p>
          </div>
          <span className="cat-tile-meta">MDR conform</span>
        </a>
      ))}
    </div>
  );
};

/* ===== Page: HOME ================================================== */
const HomePage = ({ setRoute, hero, layout }) => (
  <>
    <Hero variant={hero} setRoute={setRoute} />
    <TrustStrip />

    {/* Categories */}
    <section className="section">
      <div className="shell">
        <div className="section-head">
          <div>
            <Eyebrow>Productcategorieën</Eyebrow>
            <h2>Zes categorieën, één betrouwbare leverancier</h2>
          </div>
          <p className="lead">Diagnostiek- en monitoring-apparatuur voor de praktijk en de afdeling. Elk artikel is geselecteerd op klinische nauwkeurigheid, MDR-conformiteit en service-bereikbaarheid.</p>
        </div>
        <CategoryGrid layout={layout} setRoute={setRoute} />
      </div>
    </section>

    {/* Value props */}
    <section className="section section-alt">
      <div className="shell">
        <div className="section-head">
          <div>
            <Eyebrow>Waarom AerieCura</Eyebrow>
            <h2>Inkoop zonder verrassingen</h2>
          </div>
          <p className="lead">Korte lijnen, duidelijke documentatie en levering uit eigen voorraad. Onze inkopers werken nauw samen met fabrikanten en met u.</p>
        </div>
        <div className="values-grid">
          {[
            { icon: "shield-check", h: "MDR-conform aanbod",          p: "Alle apparatuur voldoet aan EU 2017/745. Verklaringen van overeenstemming en IFU's beschikbaar bij elk artikel." },
            { icon: "truck",        h: "Uit voorraad leverbaar",      p: "Eigen magazijn in Moordrecht. Vóór 16:00 besteld, dezelfde werkdag verzonden — ook voor reguliere staf-bestellingen." },
            { icon: "headset",      h: "Technische ondersteuning",    p: "Onze productspecialisten denken mee over keuze, ijking en onderhoud. Direct bereikbaar — niet via een wachtrij." },
            { icon: "file-text",    h: "Volledige documentatie",      p: "Datasheet, gebruikershandleiding en certificaten in één pakket. Aansluiting op uw inkoop- en QMS-systemen." },
            { icon: "boxes",        h: "Maatwerk per zorginstelling", p: "Vaste prijsafspraken, rolgebonden bestelrechten en meerjaarscontracten. Op aanvraag custom verpakking." },
            { icon: "leaf",         h: "Verantwoord inkopen",         p: "We kiezen leveranciers met aantoonbare ESG-criteria en repareren in plaats van vervangen waar mogelijk." },
          ].map((v) => (
            <div key={v.h} className="value-card">
              <div className="value-card-icon"><Icon name={v.icon} size={22} /></div>
              <h3>{v.h}</h3>
              <p>{v.p}</p>
            </div>
          ))}
        </div>
      </div>
    </section>

    {/* Stats + certs */}
    <section className="section">
      <div className="shell">
        <div className="section-head">
          <div>
            <Eyebrow>In cijfers</Eyebrow>
            <h2>Een specialist die meeschaalt</h2>
          </div>
          <p className="lead">Dagelijks werken we met inkopers van ziekenhuizen, GGZ-instellingen, huisartsenposten en thuiszorg-organisaties.</p>
        </div>
        <div className="stats-grid">
          <div className="stat-cell"><div className="stat-num">12+</div><div className="stat-lbl">Jaar ervaring in medische groothandel</div></div>
          <div className="stat-cell"><div className="stat-num">340+</div><div className="stat-lbl">Zorginstellingen werkt met ons</div></div>
          <div className="stat-cell"><div className="stat-num">95</div><div className="stat-lbl">SKU's in eigen voorraad</div></div>
          <div className="stat-cell"><div className="stat-num">24u</div><div className="stat-lbl">Gemiddelde levertijd NL</div></div>
        </div>
        <div style={{ marginTop: 32, display: "flex", flexWrap: "wrap", gap: 24, alignItems: "center", justifyContent: "space-between" }}>
          <div className="certs-row">
            <CertPill>MDR EU 2017/745</CertPill>
            <CertPill>ISO 13485</CertPill>
            <CertPill>ISO 9001</CertPill>
            <CertPill>CE-gemarkeerd</CertPill>
            <CertPill>Farmatec geregistreerd</CertPill>
          </div>
          <a className="btn btn-quiet" onClick={(e) => { e.preventDefault(); setRoute("over"); }} href="#">
            Over onze certificeringen <Icon name="arrow-right" size={14} className="arrow" />
          </a>
        </div>
      </div>
    </section>

    {/* News teaser */}
    <section className="section section-alt">
      <div className="shell">
        <div className="section-head">
          <div>
            <Eyebrow>Nieuws & inzichten</Eyebrow>
            <h2>Laatste artikelen</h2>
          </div>
          <a className="btn btn-quiet" onClick={(e) => { e.preventDefault(); setRoute("nieuws"); }} href="#">
            Alle artikelen <Icon name="arrow-right" size={14} className="arrow" />
          </a>
        </div>
        <NewsGrid setRoute={setRoute} count={3} />
      </div>
    </section>

    {/* CTA */}
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
  </>
);

/* ===== News data shared ============================================ */
const NEWS = [
  { tag: "Productupdate", title: "Nieuwe generatie bloeddrukmeters uit voorraad",        date: "12 mei 2026",   desc: "De nieuwste bovenarmmodellen bieden Bluetooth-connectiviteit en MAM-modus. Beschikbaar voor reguliere bestellingen.", icon: "heart-pulse" },
  { tag: "Regelgeving",   title: "MDR-aanpassingen voor saturatiemeters in 2026",      date: "28 apr 2026",   desc: "Wat verandert er voor inkopers? Een overzicht van de aankomende technische dossiervereisten.",                  icon: "shield-check" },
  { tag: "Bedrijfsnieuws",title: "Nieuw magazijn in Moordrecht operationeel",           date: "15 apr 2026",   desc: "Met de uitbreiding kunnen we een 60% groter assortiment uit eigen voorraad leveren.",                          icon: "truck" },
  { tag: "Klantverhaal",  title: "Hoe Bergweide Zorg z'n bloeddrukmonitoring opzette",  date: "02 apr 2026",   desc: "Een GGZ-instelling met zes locaties standaardiseert haar diagnostiek met één leverancier.",                    icon: "users" },
  { tag: "Productupdate", title: "ECG-systemen — nieuwe firmware beschikbaar",                date: "18 mrt 2026",   desc: "Verbeterde HRV-analyse en directe export naar HiX. Update beschikbaar voor bestaande klanten.",                icon: "activity" },
  { tag: "Inzicht",       title: "Wanneer kiest u een handheld i.p.v. tafelpulsoximeter?", date: "01 mrt 2026", desc: "Praktische richtlijnen voor inkopers van eerste- en tweedelijnszorg.",                                          icon: "wind" },
];

const NewsGrid = ({ setRoute, count = 3 }) => (
  <div className="news-grid">
    {NEWS.slice(0, count).map((n) => (
      <a key={n.title} className="news-card" onClick={(e) => { e.preventDefault(); setRoute("nieuws"); }} href="#">
        <div className="news-card-img"><Icon name={n.icon} size={56} strokeWidth={1.25} /></div>
        <span className="news-card-tag">{n.tag}</span>
        <h3>{n.title}</h3>
        <span className="news-card-meta">{n.date} · 4 min lezen</span>
      </a>
    ))}
  </div>
);

Object.assign(window, { TrustStrip, Hero, CategoryGrid, HomePage, NewsGrid, NEWS });
