/* global React */
/* AerieCura — shared UI primitives */

/* ---- Inline icon set (Lucide-style, 1.75 stroke) -------------------- */
const Icon = ({ name, size = 20, strokeWidth = 1.75, ...rest }) => {
  const paths = ICONS[name];
  if (!paths) return null;
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width={size} height={size} viewBox="0 0 24 24"
      fill="none" stroke="currentColor"
      strokeWidth={strokeWidth} strokeLinecap="round" strokeLinejoin="round"
      aria-hidden="true"
      {...rest}
    >
      {paths}
    </svg>
  );
};

const ICONS = {
  "arrow-right":   <><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></>,
  "arrow-left":    <><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></>,
  "chevron-right": <path d="m9 18 6-6-6-6"/>,
  "check":         <path d="M20 6 9 17l-5-5"/>,
  "shield-check":  <><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></>,
  "award":         <><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></>,
  "package":       <><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></>,
  "stethoscope":   <><path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"/><path d="M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/></>,
  "activity":      <path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.5.5 0 0 1-.96 0L9.24 2.18a.5.5 0 0 0-.96 0l-2.35 8.36A2 2 0 0 1 4 12H2"/>,
  "thermometer":   <path d="M14 4v10.54a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z"/>,
  "scale":         <><path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/></>,
  "heart-pulse":   <><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/><path d="M3.22 12H9.5l.5-1 2 4.5 2-7 1.5 3.5h5.27"/></>,
  "wind":          <><path d="M17.7 7.7a2.5 2.5 0 1 1 1.8 4.3H2"/><path d="M9.6 4.6A2 2 0 1 1 11 8H2"/><path d="M12.6 19.4A2 2 0 1 0 14 16H2"/></>,
  "user":          <><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></>,
  "log-in":        <><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></>,
  "lock":          <><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></>,
  "phone":         <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/>,
  "mail":          <><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></>,
  "map-pin":       <><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></>,
  "clock":         <><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></>,
  "menu":          <><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></>,
  "x":             <><path d="M18 6 6 18"/><path d="m6 6 12 12"/></>,
  "search":        <><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></>,
  "sparkles":      <><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3z"/></>,
  "truck":         <><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></>,
  "headset":       <><path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H4a1 1 0 0 1-1-1z"/><path d="M21 11h-3a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h2a1 1 0 0 0 1-1z"/><path d="M3 11a9 9 0 0 1 18 0"/><path d="M21 16a4 4 0 0 1-4 4h-2"/></>,
  "boxes":         <><path d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z"/><path d="m7 16.5-4.74-2.85"/><path d="m7 16.5 5-3"/><path d="M7 16.5v5.17"/><path d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z"/><path d="m17 16.5-5-3"/><path d="m17 16.5 4.74-2.85"/><path d="M17 16.5v5.17"/><path d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0Z"/><path d="M12 8 7.26 5.15"/><path d="m12 8 4.74-2.85"/><path d="M12 13.5V8"/></>,
  "file-text":     <><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></>,
  "users":         <><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></>,
  "building":      <><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></>,
  "linkedin":      <><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></>,
  "external-link": <><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></>,
  "globe":         <><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></>,
  "send":          <><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></>,
  "trending-up":   <><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></>,
  "leaf":          <><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19.2 2.96c.42 5.94-1.34 10.36-4.42 13.05A7 7 0 0 1 11 20z"/><path d="M2 21c0-3 1.85-5.36 5.08-6"/></>,
  "droplet":       <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/>,
};

/* ---- Button -------------------------------------------------------- */
const Button = ({ variant = "primary", size = "md", as = "button", children, onClick, href, withArrow, ...rest }) => {
  const Tag = href ? "a" : as;
  const cls = `btn btn-${variant} btn-${size}`;
  return (
    <Tag className={cls} onClick={onClick} href={href} {...rest}>
      {children}
      {withArrow ? <Icon name="arrow-right" size={16} className="arrow" /> : null}
    </Tag>
  );
};

/* ---- Eyebrow + small parts ---------------------------------------- */
const Eyebrow = ({ children }) => <span className="eyebrow">{children}</span>;

/* ---- Cert pill --------------------------------------------------- */
const CertPill = ({ children }) => (
  <span className="cert-pill"><Icon name="check" size={14} />{children}</span>
);

/* ---- Categories: SOURCE OF TRUTH ---------------------------------- */
const CATEGORIES = [
  { id: "bloeddrukmeters",   icon: "heart-pulse", title: "Bloeddrukmeters",   desc: "Boven- en onderarm, handmatig en automatisch." },
  { id: "bloedsuikermeters", icon: "droplet",     title: "Bloedsuikermeters", desc: "Glucosemeters, teststrips en lancetten." },
  { id: "thermometers",      icon: "thermometer", title: "Thermometers",      desc: "Infrarood, voorhoofd en oorthermometers." },
  { id: "saturatiemeters",   icon: "wind",        title: "Saturatiemeters",   desc: "Vingertop pulsoximeters en handheld monitoren." },
  { id: "ecg",               icon: "activity",    title: "ECG-apparatuur",    desc: "Rust-, inspannings- en draagbare ECG-systemen." },
  { id: "weegschalen",       icon: "scale",       title: "Weegschalen",       desc: "Personenweegschalen tot bariatrische modellen." },
];

/* ---- export to window for cross-script use ------------------------ */
Object.assign(window, { Icon, Button, Eyebrow, CertPill, CATEGORIES });
