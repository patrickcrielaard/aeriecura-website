/* global React, Icon, Button, Eyebrow, CertPill, CATEGORIES */
const { useState, useEffect } = React;

/* ===== Header ====================================================== */
const Header = ({ route, setRoute, onLogin, dark, setDark }) => {
  const links = [
    { id: "home",      label: "Home" },
    { id: "producten", label: "Assortiment" },
    { id: "webshops",  label: "Webshops" },
    { id: "over",      label: "Over ons" },
    { id: "b2b",       label: "Voor zorgverleners" },
    { id: "mdr",       label: "MDR" },
    { id: "nieuws",    label: "Nieuws" },
    { id: "contact",   label: "Contact" },
  ];
  return (
    <header className="ac-header">
      <div className="ac-header-bar">
        <div className="ac-header-bar-inner">
          <a href="tel:+31000000000"><Icon name="phone" size={13} />+31 (0)182 000 000</a>
          <span className="sep" />
          <a href="mailto:info@aeriecura.nl"><Icon name="mail" size={13} />info@aeriecura.nl</a>
          <span className="sep" />
          <a><Icon name="globe" size={13} />NL</a>
        </div>
      </div>
      <div className="ac-header-inner">
        <a className="ac-logo" onClick={(e) => { e.preventDefault(); setRoute("home"); }} href="#">
          <img src="assets/logo-wordmark.svg" alt="AerieCura" />
        </a>
        <nav className="ac-nav">
          {links.map((l) => (
            <a
              key={l.id}
              className={`ac-nav-link ${route === l.id ? "is-active" : ""}`}
              onClick={(e) => { e.preventDefault(); setRoute(l.id); }}
              href="#"
            >{l.label}</a>
          ))}
        </nav>
        <div className="ac-header-actions">
          <a className="login-link" href="https://b2b.aeriecura.nl" target="_blank" rel="noreferrer" title="Inloggen op het B2B-portaal">
            <Icon name="lock" size={13} />Inloggen
          </a>
          <Button variant="primary" size="sm" onClick={() => setRoute("contact")}>
            Offerte aanvragen
          </Button>
        </div>
      </div>
    </header>
  );
};

/* ===== Footer ====================================================== */
const Footer = ({ setRoute, onLogin }) => {
  const go = (id) => (e) => { e.preventDefault(); setRoute(id); };
  return (
    <footer className="ac-footer">
      <div className="ac-footer-inner">
        <div>
          <img src="assets/logo-wordmark.svg" className="ac-footer-logo" alt="AerieCura" />
          <p className="ac-footer-tag">Specialistische groothandel in medische apparatuur. Diagnostiek en monitoring voor zorgprofessionals.</p>
          <div className="ac-footer-meta">
            AerieCura B.V.<br />
            Zuidbaan 548 F, 2841 MD Moordrecht<br />
            KvK 82024995
          </div>
        </div>
        <div className="ac-footer-col">
          <h4 className="ac-footer-h">Assortiment</h4>
          {CATEGORIES.map((c) => (
            <a key={c.id} onClick={go("producten")} href="#">{c.title}</a>
          ))}
        </div>
        <div className="ac-footer-col">
          <h4 className="ac-footer-h">Bedrijf</h4>
          <a onClick={go("over")} href="#">Over ons</a>
          <a onClick={go("b2b")} href="#">Voor zorgverleners</a>
          <a onClick={go("mdr")} href="#">MDR-conformiteit</a>
          <a onClick={go("nieuws")} href="#">Nieuws</a>
          <a onClick={go("contact")} href="#">Contact</a>
        </div>
        <div className="ac-footer-col">
          <h4 className="ac-footer-h">Webshops</h4>
          <a onClick={go("webshops")} href="#">Alle webshops</a>
          <a href="https://bloeddrukmeter.shop" target="_blank" rel="noreferrer">Bloeddrukmeter.shop</a>
          <a href="https://rossmax.nl" target="_blank" rel="noreferrer">Rossmax.nl</a>
          <a onClick={go("webshops")} href="#">Thuismonitoring.nl</a>
          <a onClick={go("webshops")} href="#">Incontinentiemateriaal.nl</a>
        </div>
        <div className="ac-footer-col">
          <h4 className="ac-footer-h">Beheer</h4>
          <a href="https://b2b.aeriecura.nl" target="_blank" rel="noreferrer">B2B-portaal</a>
          <a>API-documentatie</a>
        </div>
      </div>
      <div className="ac-footer-bottom">
        <span>© {new Date().getFullYear()} AerieCura B.V. Alle rechten voorbehouden.</span>
        <div className="ac-footer-bottom-links">
          <a>Algemene voorwaarden</a>
          <a>Privacyverklaring</a>
          <a>Cookies</a>
        </div>
      </div>
    </footer>
  );
};

/* ===== Login modal ================================================= */
const LoginModal = ({ open, onClose }) => {
  const [user, setUser] = useState("");
  const [pw, setPw] = useState("");
  const [err, setErr] = useState("");
  useEffect(() => { if (!open) { setUser(""); setPw(""); setErr(""); } }, [open]);
  const submit = (e) => {
    e.preventDefault();
    if (!user || !pw) { setErr("Vul gebruikersnaam en wachtwoord in."); return; }
    setErr("");
    alert("Demo · in productie wordt doorverwezen naar /wp-admin/");
  };
  return (
    <div className={`modal-scrim ${open ? "is-open" : ""}`} onClick={onClose}>
      <div className="modal modal-rel" onClick={(e) => e.stopPropagation()}>
        <button className="modal-close" onClick={onClose} aria-label="Sluiten"><Icon name="x" size={18} /></button>
        <Eyebrow>Beheer</Eyebrow>
        <h2>Inloggen op het beheer</h2>
        <p>Toegang tot het WordPress-beheer en aangesloten plug-ins (klantportaal, B2B-platform).</p>
        <form onSubmit={submit}>
          <div className="field">
            <label>Gebruikersnaam of e-mailadres</label>
            <input type="text" value={user} onChange={(e) => setUser(e.target.value)} autoFocus />
          </div>
          <div className="field">
            <label>Wachtwoord</label>
            <input type="password" value={pw} onChange={(e) => setPw(e.target.value)} />
          </div>
          {err ? <div style={{ color: "var(--ac-danger)", fontSize: 13 }}>{err}</div> : null}
          <div className="modal-foot">
            <span className="small">Wachtwoord vergeten?</span>
            <Button variant="primary" size="md" as="button">Inloggen<Icon name="log-in" size={14} /></Button>
          </div>
        </form>
      </div>
    </div>
  );
};

Object.assign(window, { Header, Footer, LoginModal });
