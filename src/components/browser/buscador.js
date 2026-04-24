/* =========================================================================
   buscador-compartido.js (ONE X CENTO) - FIX DUPLICADO + SUGERENCIAS
   - Autocomplete mientras escribes
   - Enter / click redirige
   - ✅ Soporta rutas relativas ../ y ./
   - ✅ Usa #searchSuggest si ya existe (NO duplica dropdown)
   - ✅ Cierra al scroll / click fuera / ESC
   ======================================================================== */

(function () {
  "use strict";

  // =========================
  // CATÁLOGO / ENLACES
  // =========================
  const ROUTES = [
    {
        key:"Diodo Led",
        label:"Diodo Led",
        href:"C:/xampp/htdocs/Electro_Arduino/pages/electronica/diodo_led/diodo_led.html",
        aliases:["Diodo Led"],
    },
    {
        key:"Resistencia, Resistor",
        label:"Resistencia, Resistor",
        href:"C:/xampp/htdocs/Electro_Arduino/pages/electronica/resistencia/resistencia.html",
        aliases:["Resistencia, Resistor"],
    },
    {
        key:"Capacitor",
        label:"Capacitor",
        href:"C:/xampp/htdocs/Electro_Arduino/pages/electronica/capacitor/capacitor.html",
        aliases:["Capacitor"],
    },
    {
        key:"Potenciometro",
        label:"Potenciometro",
        href:"C:/xampp/htdocs/Electro_Arduino/pages/electronica/potenciometro/potenciometro.html",
        aliases:["Potenciometro"],
    },
    {
        key:"Diodo Led RGB",
        label:"Diodo Led RGB",
        href:"C:/xampp/htdocs/Electro_Arduino/pages/electronica/diodo_led_rgb/diodo_led_rgb.html",
        aliases:["Diodo Led RGB"],
    },
    {/*carpeta: areas_tera*/
        key:"Fotoresistencia, Fotoresistor",
        label:"Fotoresistencia, Fotoresistor",
        href:"C:/xampp/htdocs/Electro_Arduino/pages/electronica/fotoresistencia/#",
        aliases:["Fotoresistor, Fotoresistencia"],
    },
    {
      key:"Pulsador, Boton",
      label:"Pulsador, Boton",
      href:"C:/xampp/htdocs/Electro_Arduino/pages/electronica/pulsador/#",
      aliases:["Pulsador, Boton"],
    },
  ];

  // =========================
  // Config
  // =========================
  const FORM_ID = "searchForm";
  const INPUT_ID = "q";
  const WRAP_ID = "searchWrap";
  const SUGGEST_ID = "searchSuggest";
  const HOME_PATH = "/index.html";
  const MAX_SUGGESTIONS = 6;

  // =========================
  // Helpers
  // =========================
  const norm = (s) =>
    (s || "")
      .toString()
      .trim()
      .toLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "");

  function routeTokens(r) {
    const tokens = new Set();
    if (r.key) tokens.add(norm(r.key));
    if (r.label) tokens.add(norm(r.label));
    if (Array.isArray(r.aliases)) r.aliases.forEach((a) => tokens.add(norm(a)));
    return Array.from(tokens).filter(Boolean);
  }

  function scoreRoute(queryNorm, queryTokens, r) {
    const toks = routeTokens(r);

    if (toks.includes(queryNorm)) return 100;

    for (const qt of queryTokens) {
      if (toks.includes(qt)) return 90;
    }

    for (const t of toks) {
      if (t && queryNorm.includes(t)) return 70;
      if (t && t.includes(queryNorm)) return 60;
    }

    return 0;
  }

  function getMatches(query, limit = MAX_SUGGESTIONS) {
    const q = norm(query);
    if (!q) return [];
    const qTokens = q.split(/\s+/).filter(Boolean);

    const scored = ROUTES
      .filter((r) => r && r.href)
      .map((r) => ({ r, s: scoreRoute(q, qTokens, r) }))
      .filter((x) => x.s > 0)
      .sort((a, b) => b.s - a.s);

    const out = [];
    const seen = new Set();
    for (const x of scored) {
      const href = x.r.href;
      if (seen.has(href)) continue;
      seen.add(href);
      out.push(x.r);
      if (out.length >= limit) break;
    }
    return out;
  }

  function findBestRoute(query) {
    const matches = getMatches(query, 1);
    return matches[0] || null;
  }

  function toAbs(href) {
    try {
      return new URL(href, window.location.href).href;
    } catch {
      return href;
    }
  }

  function normalizeHref(href) {
    if (!href) return href;
    if (href.startsWith("#")) return href;
    if (href.endsWith("/")) return href + "index.html";
    return href;
  }

  function goTo(href) {
    if (!href) return;

    if (href.startsWith("#")) {
      const el = document.querySelector(href);
      if (el) {
        el.scrollIntoView({ behavior: "smooth", block: "start" });
        return;
      }
      window.location.href = toAbs(`${HOME_PATH}${href}`);
      return;
    }

    const finalHref = normalizeHref(href);
    window.location.href = toAbs(finalHref);
  }

  // =========================
  // UI: dropdown
  // =========================
  function getOrCreateDropdown(input) {
    // 1) si existe #searchSuggest, úsalo
    const existingById = document.getElementById(SUGGEST_ID);
    if (existingById) return existingById;

    // 2) si existe uno dentro del wrap, úsalo
    const wrap =
      document.getElementById(WRAP_ID) ||
      input.closest(".search-wrap") ||
      input.closest(".topbar-inner") ||
      input.closest(".search") ||
      input.parentElement;

    if (!wrap) return null;

    const existingInside = wrap.querySelector(".search-suggest");
    if (existingInside) return existingInside;

    // 3) si no hay, créalo (fallback)
    if (getComputedStyle(wrap).position === "static") wrap.style.position = "relative";

    const box = document.createElement("div");
    box.className = "search-suggest";
    box.id = SUGGEST_ID;
    box.setAttribute("role", "listbox");
    box.setAttribute("aria-label", "Sugerencias");
    wrap.appendChild(box);
    return box;
  }

  function escapeHtml(str) {
    return (str || "")
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  function renderDropdown(box, items, activeIndex) {
    if (!box) return;

    if (!items.length) {
      box.style.display = "none";
      box.innerHTML = "";
      return;
    }

    box.style.display = "block";
    box.innerHTML = items
      .map((r, idx) => {
        const title = r.label || r.key;
        const sub = r.href.startsWith("#") ? "Sección" : normalizeHref(r.href);
        const isActive = idx === activeIndex;

        return `
          <div data-idx="${idx}" class="search-suggest__item ${isActive ? "is-active" : ""}">
            <div class="search-suggest__title">${escapeHtml(title)}</div>
            <div class="search-suggest__sub">${escapeHtml(sub)}</div>
          </div>
        `;
      })
      .join("");
  }

  // =========================
  // Init
  // =========================
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById(FORM_ID);
    const input = document.getElementById(INPUT_ID);
    const wrap = document.getElementById(WRAP_ID) || input?.closest(".search-wrap");

    if (!form || !input) return;

    const dropdown = getOrCreateDropdown(input);
    let currentItems = [];
    let active = -1;

    function update() {
      currentItems = getMatches(input.value, MAX_SUGGESTIONS);
      active = -1;
      renderDropdown(dropdown, currentItems, active);
    }

    function close() {
      if (!dropdown) return;
      dropdown.style.display = "none";
      dropdown.innerHTML = "";
      currentItems = [];
      active = -1;
    }

    input.addEventListener("input", update);

    input.addEventListener("keydown", (e) => {
      if (!currentItems.length) {
        if (e.key === "Escape") close();
        return;
      }

      if (e.key === "ArrowDown") {
        e.preventDefault();
        active = Math.min(active + 1, currentItems.length - 1);
        renderDropdown(dropdown, currentItems, active);
      } else if (e.key === "ArrowUp") {
        e.preventDefault();
        active = Math.max(active - 1, 0);
        renderDropdown(dropdown, currentItems, active);
      } else if (e.key === "Escape") {
        close();
      } else if (e.key === "Enter") {
        if (active >= 0 && currentItems[active]) {
          e.preventDefault();
          goTo(currentItems[active].href);
          close();
        }
      }
    });

    // click en item
    dropdown?.addEventListener("mousedown", (e) => {
      const row = e.target.closest("[data-idx]");
      if (!row) return;
      const idx = Number(row.getAttribute("data-idx"));
      const item = currentItems[idx];
      if (item) {
        goTo(item.href);
        close();
      }
    });

    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const route =
        active >= 0 && currentItems[active]
          ? currentItems[active]
          : findBestRoute(input.value);

      if (route) {
        goTo(route.href);
        close();
      } else {
        alert('No encontré coincidencias. Prueba con: "ritmo", "endure", "recover", "detox", "omega", "focus"...');
      }
    });

    // ✅ click fuera
    document.addEventListener("mousedown", (e) => {
      if (!wrap) return;
      if (wrap.contains(e.target)) return;
      close();
    });

    // ✅ scroll -> cierra para poder seleccionar productos abajo
    window.addEventListener("scroll", close, { passive: true });

    // ✅ ESC global (por si no hay items)
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") close();
    });
  });
})();