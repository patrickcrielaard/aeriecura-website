/* global React, ReactDOM, Header, Footer, LoginModal, HomePage, OverPage, ProductenPage, B2BPage, MDRPage, WebshopsPage, NieuwsPage, ContactPage, useTweaks, TweaksPanel, TweakSection, TweakRadio, TweakToggle */
const { useState, useEffect } = React;

const TWEAK_DEFAULTS = /*EDITMODE-BEGIN*/{
  "hero": "a",
  "layout": "compact",
  "dark": false
}/*EDITMODE-END*/;

const App = () => {
  const [route, setRoute] = useState("home");
  const [login, setLogin] = useState(false);
  const [tweaks, setTweak] = useTweaks(TWEAK_DEFAULTS);

  // Apply dark mode at <html>
  useEffect(() => {
    document.documentElement.classList.toggle("theme-dark", !!tweaks.dark);
  }, [tweaks.dark]);

  // Scroll to top on route change
  useEffect(() => { window.scrollTo({ top: 0, behavior: "instant" }); }, [route]);

  const screenLabel = {
    home: "01 Home",
    producten: "02 Assortiment",
    webshops: "03 Webshops",
    over: "04 Over ons",
    b2b: "05 Voor zorgverleners",
    mdr: "06 MDR-conformiteit",
    nieuws: "07 Nieuws",
    contact: "08 Contact",
  }[route];

  return (
    <div data-screen-label={screenLabel}>
      <Header route={route} setRoute={setRoute} onLogin={() => setLogin(true)} />
      <main className="fade-in" key={route}>
        {route === "home"      && <HomePage      setRoute={setRoute} hero={tweaks.hero} layout={tweaks.layout} />}
        {route === "producten" && <ProductenPage setRoute={setRoute} />}
        {route === "webshops"  && <WebshopsPage  setRoute={setRoute} />}
        {route === "over"      && <OverPage      setRoute={setRoute} />}
        {route === "b2b"       && <B2BPage       setRoute={setRoute} />}
        {route === "mdr"       && <MDRPage       setRoute={setRoute} />}
        {route === "nieuws"    && <NieuwsPage    setRoute={setRoute} />}
        {route === "contact"   && <ContactPage   setRoute={setRoute} />}
      </main>
      <Footer setRoute={setRoute} onLogin={() => setLogin(true)} />
      <LoginModal open={login} onClose={() => setLogin(false)} />

      <TweaksPanel title="Tweaks">
        <TweakSection label="Homepage hero">
          <TweakRadio label="Variant" value={tweaks.hero}
            options={["a", "b", "c"]}
            onChange={(v) => setTweak("hero", v)} />
        </TweakSection>
        <TweakSection label="Productcategorieën">
          <TweakRadio label="Layout" value={tweaks.layout}
            options={["compact", "detailed", "featured"]}
            onChange={(v) => setTweak("layout", v)} />
        </TweakSection>
        <TweakSection label="Thema">
          <TweakToggle label="Donkere modus" value={!!tweaks.dark}
            onChange={(v) => setTweak("dark", v)} />
        </TweakSection>
      </TweaksPanel>
    </div>
  );
};

setTimeout(() => {
  ReactDOM.createRoot(document.getElementById("root")).render(<App />);
}, 50);
