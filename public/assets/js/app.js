// =====================================================
// Le Commerce — JS front (vanilla, sans dépendance)
// =====================================================

document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initAdminMobileSidebar();
  initAdminSidebarCollapse();
  initWeatherWidget();
  initChatChips();
  initChatFab();
  initProximityWidget();
});

/**
 * Géolocalisation client : demande la position toutes les 60s et interroge
 * le serveur pour savoir si une campagne de proximité est déclenchée.
 * Ne s'active que si le widget est présent dans la page (client, opt-in activé).
 */
function initProximityWidget() {
  const banner = document.getElementById('proximity-banner');
  if (!banner || !navigator.geolocation || !window.__proximityConfig) return;

  const messageEl = document.getElementById('proximity-message');
  const form = document.getElementById('proximity-claim-form');
  const dismissBtn = document.getElementById('proximity-dismiss');
  let dismissed = false;

  dismissBtn.addEventListener('click', () => {
    dismissed = true;
    banner.classList.add('hidden');
  });

  const checkPosition = (position) => {
    if (dismissed) return;
    const { latitude, longitude } = position.coords;

    const body = new URLSearchParams();
    body.set('_csrf', window.__proximityConfig.csrfToken);
    body.set('lat', latitude);
    body.set('lng', longitude);

    fetch(window.location.origin + '/mon-compte/proximite/verifier', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: body.toString(),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.match) {
          messageEl.textContent = data.campaign.message;
          form.action = window.location.origin + '/mon-compte/proximite/' + data.campaign.id + '/profiter';
          banner.classList.remove('hidden');
        }
      })
      .catch(() => {});
  };

  navigator.geolocation.getCurrentPosition(checkPosition, () => {}, { enableHighAccuracy: false, timeout: 8000 });
  setInterval(() => {
    navigator.geolocation.getCurrentPosition(checkPosition, () => {}, { enableHighAccuracy: false, timeout: 8000 });
  }, 60000);
}

function initAdminSidebarCollapse() {
  const btn = document.getElementById('admin-collapse-menu-btn');
  const sidebar = document.getElementById('admin-sidebar');
  if (!btn || !sidebar) return;

  const storageKey = 'le-commerce-admin-sidebar-collapsed';

  const applyState = (collapsed) => {
    if (collapsed) {
      sidebar.classList.add('sidebar-collapsed');
      btn.setAttribute('aria-pressed', 'true');
    } else {
      sidebar.classList.remove('sidebar-collapsed');
      btn.setAttribute('aria-pressed', 'false');
    }
  };

  const stored = localStorage.getItem(storageKey);
  applyState(stored === '1');

  btn.addEventListener('click', () => {
    const collapsed = !sidebar.classList.contains('sidebar-collapsed');
    applyState(collapsed);
    localStorage.setItem(storageKey, collapsed ? '1' : '0');
  });
}

/** Sidebar admin en drawer mobile */
function initAdminMobileSidebar() {
  const btn = document.getElementById('admin-mobile-menu-btn');
  const sidebar = document.getElementById('admin-sidebar');
  const backdrop = document.getElementById('admin-sidebar-backdrop');
  if (!btn || !sidebar || !backdrop) return;

  const open = () => {
    sidebar.classList.remove('-translate-x-full');
    backdrop.classList.remove('hidden');
  };
  const close = () => {
    sidebar.classList.add('-translate-x-full');
    backdrop.classList.add('hidden');
  };

  btn.addEventListener('click', open);
  backdrop.addEventListener('click', close);
}

/** Menu mobile (burger) */
function initMobileMenu() {
  const btn = document.getElementById('mobile-menu-btn');
  const menu = document.getElementById('mobile-menu');
  if (!btn || !menu) return;

  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
}

/** Récupère la météo réelle via Open-Meteo (API publique, sans clé) */
function initWeatherWidget() {
  const widget = document.getElementById('weather-widget');
  if (!widget) return;

  const lat = widget.dataset.lat;
  const lng = widget.dataset.lng;
  const tempEl = widget.querySelector('#weather-temp');
  const descEl = widget.querySelector('#weather-desc');

  fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lng}&current_weather=true`)
    .then((res) => res.json())
    .then((data) => {
      if (!data.current_weather) return;
      const temp = Math.round(data.current_weather.temperature);
      tempEl.textContent = `${temp}°C`;
      descEl.textContent = weatherCodeToLabel(data.current_weather.weathercode);
    })
    .catch(() => {
      descEl.textContent = 'Météo indisponible';
    });
}

function weatherCodeToLabel(code) {
  const map = {
    0: 'Ensoleillé', 1: 'Plutôt dégagé', 2: 'Partiellement nuageux', 3: 'Couvert',
    45: 'Brouillard', 48: 'Brouillard givrant',
    51: 'Bruine légère', 61: 'Pluie légère', 63: 'Pluie', 65: 'Forte pluie',
    71: 'Neige légère', 73: 'Neige', 75: 'Forte neige',
    80: 'Averses', 95: 'Orage',
  };
  return map[code] || 'Conditions variables';
}

/** Clique sur une suggestion de l'assistant -> remplit le champ */
function initChatChips() {
  document.querySelectorAll('.chat-chip').forEach((chip) => {
    chip.addEventListener('click', () => {
      const input = document.querySelector('#assistant-form input');
      if (input) {
        input.value = chip.textContent.trim();
        input.focus();
      }
    });
  });
}

/** Bouton flottant de l'assistant (scroll vers le bloc assistant en Accueil, sinon no-op) */
function initChatFab() {
  const fab = document.getElementById('chat-fab');
  if (!fab) return;

  fab.addEventListener('click', () => {
    const target = document.getElementById('assistant-form');
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'center' });
      target.querySelector('input')?.focus();
    }
  });
}
