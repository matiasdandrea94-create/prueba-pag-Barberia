<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>El Navajero — Barbería</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Mono:wght@300;400;500&family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">
<style>
  :root {
    --cream: #F5EDD8;
    --dark: #1A1209;
    --gold: #C9922A;
    --rust: #8B3A1A;
    --olive: #4A4A2E;
    --ink: #2C1F0E;
    --paper: #EDE3CC;
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: var(--dark); color: var(--cream); font-family: 'DM Mono', monospace; min-height: 100vh; overflow-x: hidden; }
  body::before { content: ''; position: fixed; inset: 0; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E"); pointer-events: none; z-index: 1000; opacity: 0.5; }

  header { border-bottom: 1px solid rgba(201,146,42,0.3); padding: 0 60px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; background: var(--dark); z-index: 100; height: 72px; }
  .logo { display: flex; align-items: center; gap: 14px; }
  .logo-icon { width: 36px; height: 36px; border: 2px solid var(--gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; }
  .logo-text { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 900; letter-spacing: 2px; color: var(--cream); }
  .logo-sub { font-size: 9px; letter-spacing: 4px; color: var(--gold); text-transform: uppercase; display: block; margin-top: -4px; }
  nav { display: flex; gap: 32px; }
  nav a { font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: rgba(245,237,216,0.6); text-decoration: none; cursor: pointer; transition: color 0.2s; padding: 4px 0; border-bottom: 1px solid transparent; }
  nav a:hover, nav a.active { color: var(--gold); border-color: var(--gold); }

  /* DB STATUS INDICATOR */
  .db-status { display: flex; align-items: center; gap: 8px; font-size: 10px; letter-spacing: 2px; color: rgba(245,237,216,0.4); }
  .db-dot { width: 8px; height: 8px; border-radius: 50%; background: #555; transition: background 0.3s; }
  .db-dot.connected { background: #6EC96E; box-shadow: 0 0 6px #6EC96E; }
  .db-dot.error { background: #C96E6E; box-shadow: 0 0 6px #C96E6E; }

  .hero { padding: 100px 60px 80px; display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; min-height: 60vh; position: relative; }
  .hero::after { content: ''; position: absolute; right: 0; top: 0; bottom: 0; width: 50%; background: radial-gradient(ellipse at 70% 50%, rgba(201,146,42,0.06) 0%, transparent 70%); pointer-events: none; }
  .hero-eyebrow { font-size: 10px; letter-spacing: 5px; text-transform: uppercase; color: var(--gold); margin-bottom: 20px; display: flex; align-items: center; gap: 12px; }
  .hero-eyebrow::before { content: ''; display: block; width: 30px; height: 1px; background: var(--gold); }
  h1 { font-family: 'Playfair Display', serif; font-size: clamp(52px, 6vw, 80px); line-height: 1.0; font-weight: 900; color: var(--cream); margin-bottom: 24px; }
  h1 em { font-style: italic; font-family: 'Libre Baskerville', serif; color: var(--gold); }
  .hero-desc { font-size: 13px; line-height: 1.9; color: rgba(245,237,216,0.55); max-width: 380px; margin-bottom: 40px; }
  .hero-cta { display: inline-flex; align-items: center; gap: 12px; background: var(--gold); color: var(--dark); font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; font-weight: 500; padding: 16px 32px; border: none; cursor: pointer; transition: all 0.2s; }
  .hero-cta:hover { background: var(--cream); }
  .hero-visual { display: flex; flex-direction: column; gap: 20px; align-items: flex-end; }
  .stat-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(201,146,42,0.2); padding: 24px 32px; width: 280px; }
  .stat-num { font-family: 'Playfair Display', serif; font-size: 48px; font-weight: 900; color: var(--gold); line-height: 1; }
  .stat-label { font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: rgba(245,237,216,0.4); margin-top: 6px; }
  .ornament { width: 280px; height: 2px; background: linear-gradient(90deg, var(--gold), transparent); }

  .section { padding: 80px 60px; }
  .section-header { display: flex; align-items: baseline; gap: 20px; margin-bottom: 48px; border-bottom: 1px solid rgba(201,146,42,0.15); padding-bottom: 24px; }
  .section-title { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: var(--cream); }
  .section-num { font-size: 11px; letter-spacing: 4px; color: var(--gold); text-transform: uppercase; }

  .booking-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; }
  .form-group { margin-bottom: 24px; }
  label { display: block; font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: rgba(245,237,216,0.5); margin-bottom: 10px; }
  input, select { width: 100%; background: rgba(255,255,255,0.04); border: 1px solid rgba(201,146,42,0.25); color: var(--cream); font-family: 'DM Mono', monospace; font-size: 13px; padding: 14px 16px; outline: none; transition: border-color 0.2s; -webkit-appearance: none; }
  input:focus, select:focus { border-color: var(--gold); background: rgba(201,146,42,0.05); }
  select option { background: var(--ink); color: var(--cream); }

  .btn-primary { background: var(--gold); color: var(--dark); border: none; font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; font-weight: 500; padding: 16px 32px; cursor: pointer; width: 100%; transition: all 0.2s; margin-top: 8px; }
  .btn-primary:hover { background: var(--cream); }
  .btn-primary:disabled { opacity: 0.4; cursor: not-allowed; }
  .btn-secondary { background: transparent; color: var(--gold); border: 1px solid var(--gold); font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; padding: 12px 24px; cursor: pointer; transition: all 0.2s; }
  .btn-secondary:hover { background: rgba(201,146,42,0.1); }
  .btn-danger { background: transparent; color: #C94040; border: 1px solid #C94040; font-family: 'DM Mono', monospace; font-size: 10px; letter-spacing: 2px; text-transform: uppercase; padding: 8px 16px; cursor: pointer; transition: all 0.2s; }
  .btn-danger:hover { background: rgba(201,64,64,0.1); }

  .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px; margin-bottom: 32px; }
  .service-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(201,146,42,0.1); padding: 24px 20px; cursor: pointer; transition: all 0.2s; }
  .service-card:hover, .service-card.selected { border-color: var(--gold); background: rgba(201,146,42,0.06); }
  .service-name { font-family: 'Playfair Display', serif; font-size: 17px; font-weight: 700; color: var(--cream); margin-bottom: 6px; }
  .service-desc { font-size: 10px; color: rgba(245,237,216,0.4); line-height: 1.7; margin-bottom: 12px; }
  .service-price { font-size: 13px; color: rgba(245,237,216,0.6); }
  .service-card.selected .service-price { color: var(--gold); }

  .slots-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 8px; margin-top: 12px; }
  .slot { padding: 10px 8px; text-align: center; font-size: 12px; border: 1px solid rgba(201,146,42,0.2); cursor: pointer; transition: all 0.2s; color: rgba(245,237,216,0.7); }
  .slot:hover:not(.taken) { border-color: var(--gold); color: var(--gold); background: rgba(201,146,42,0.08); }
  .slot.selected { background: var(--gold); color: var(--dark); border-color: var(--gold); font-weight: 500; }
  .slot.taken { opacity: 0.3; cursor: not-allowed; text-decoration: line-through; }

  .data-table { width: 100%; border-collapse: collapse; font-size: 12px; }
  .data-table th { text-align: left; font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: var(--gold); padding: 12px 16px; border-bottom: 1px solid rgba(201,146,42,0.25); font-weight: 400; }
  .data-table td { padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,0.05); color: rgba(245,237,216,0.75); vertical-align: middle; }
  .data-table tr:hover td { background: rgba(201,146,42,0.04); }

  .badge { display: inline-block; padding: 3px 10px; font-size: 9px; letter-spacing: 2px; text-transform: uppercase; }
  .badge-pending { background: rgba(201,146,42,0.15); color: var(--gold); }
  .badge-done { background: rgba(74,180,74,0.15); color: #6EC96E; }
  .badge-cancelled { background: rgba(201,64,64,0.15); color: #C96E6E; }

  .toast { position: fixed; bottom: 40px; right: 40px; background: var(--gold); color: var(--dark); font-family: 'DM Mono', monospace; font-size: 12px; padding: 16px 24px; z-index: 9999; transform: translateY(100px); opacity: 0; transition: all 0.3s cubic-bezier(0.16,1,0.3,1); max-width: 320px; }
  .toast.show { transform: translateY(0); opacity: 1; }
  .toast.error { background: #C94040; color: var(--cream); }

  .overlay { position: fixed; inset: 0; background: rgba(10,8,4,0.85); z-index: 500; display: none; align-items: center; justify-content: center; }
  .overlay.active { display: flex; }
  .modal { background: var(--ink); border: 1px solid rgba(201,146,42,0.3); padding: 48px; max-width: 520px; width: 90%; }
  .modal-title { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: var(--cream); margin-bottom: 8px; }
  .modal-sub { font-size: 11px; color: rgba(245,237,216,0.4); letter-spacing: 2px; margin-bottom: 32px; }
  .confirmation-detail { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 12px; }
  .confirmation-detail .key { color: rgba(245,237,216,0.4); }
  .confirmation-detail .val { color: var(--cream); font-weight: 500; }
  .modal-actions { display: flex; gap: 12px; margin-top: 32px; }
  .modal-actions .btn-primary, .modal-actions .btn-secondary { flex: 1; }

  .tab-buttons { display: flex; margin-bottom: 40px; border-bottom: 1px solid rgba(201,146,42,0.2); }
  .tab-btn { background: none; border: none; font-family: 'DM Mono', monospace; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: rgba(245,237,216,0.4); padding: 14px 24px; cursor: pointer; transition: all 0.2s; border-bottom: 2px solid transparent; margin-bottom: -1px; }
  .tab-btn.active { color: var(--gold); border-bottom-color: var(--gold); }
  .tab-content { display: none; }
  .tab-content.active { display: block; }
  .filter-row { display: flex; gap: 12px; align-items: center; margin-bottom: 24px; flex-wrap: wrap; }
  .filter-row input { width: auto; flex: 1; min-width: 200px; }
  .filter-row select { width: auto; min-width: 160px; }

  .empty-state { text-align: center; padding: 60px 20px; color: rgba(245,237,216,0.25); }
  .empty-state-icon { font-size: 40px; margin-bottom: 16px; }
  .empty-state-text { font-size: 12px; letter-spacing: 2px; }

  .loading { text-align: center; padding: 40px; color: rgba(245,237,216,0.3); font-size: 11px; letter-spacing: 3px; }

  .alert-box { padding: 16px 20px; border: 1px solid; margin-bottom: 20px; font-size: 12px; }
  .alert-error { border-color: #C94040; background: rgba(201,64,64,0.08); color: #C96E6E; }
  .alert-info { border-color: rgba(201,146,42,0.4); background: rgba(201,146,42,0.06); color: var(--gold); }

  hr.divider { border: none; border-top: 1px solid rgba(201,146,42,0.15); margin: 0 60px; }
  ::-webkit-scrollbar { width: 4px; } ::-webkit-scrollbar-thumb { background: rgba(201,146,42,0.3); }

  @media (max-width: 900px) {
    header { padding: 0 24px; } nav { display: none; }
    .hero { grid-template-columns: 1fr; padding: 60px 24px; } .hero-visual { display: none; }
    .section { padding: 60px 24px; } .booking-grid { grid-template-columns: 1fr; gap: 40px; }
    .services-grid { grid-template-columns: 1fr 1fr; } hr.divider { margin: 0 24px; }
  }
</style>
</head>
<body>

<header>
  <div class="logo">
    <div class="logo-icon">✂</div>
    <div>
      <div class="logo-text">EL NAVAJERO</div>
      <span class="logo-sub">Barbería · Est. 1992</span>
    </div>
  </div>
  <nav>
    <a onclick="scrollToSection('booking')" class="active">Turnos</a>
    <a onclick="scrollToSection('admin')">Agenda</a>
  </nav>
  <div class="db-status">
    <div class="db-dot" id="db-dot"></div>
    <span id="db-label">Conectando...</span>
  </div>
</header>

<!-- HERO -->
<section class="hero">
  <div>
    <div class="hero-eyebrow">Reservá tu lugar</div>
    <h1>El corte<br>que <em>merecés</em></h1>
    <p class="hero-desc">Barbería de oficio. Navaja, tijera y presencia. Atendemos con turno para garantizarte el tiempo y el trato que cada cliente se merece.</p>
    <button class="hero-cta" onclick="scrollToSection('booking')">✂ Sacar turno</button>
  </div>
  <div class="hero-visual">
    <div class="stat-card">
      <div class="stat-num" id="stat-hoy">—</div>
      <div class="stat-label">Turnos hoy</div>
    </div>
    <div class="ornament"></div>
    <div class="stat-card">
      <div class="stat-num" id="stat-total">—</div>
      <div class="stat-label">Total reservados</div>
    </div>
  </div>
</section>

<hr class="divider">

<!-- BOOKING -->
<section class="section" id="booking">
  <div class="section-header">
    <span class="section-num">01 — </span>
    <h2 class="section-title">Sacar turno</h2>
  </div>

  <div id="db-error-banner"></div>

  <div class="booking-grid">
    <div>
      <div style="margin-bottom:32px">
        <label>Seleccioná el servicio</label>
        <div class="services-grid" id="services-grid"><div class="loading">Cargando servicios...</div></div>
      </div>
      <div class="form-group">
        <label>Nombre completo</label>
        <input type="text" id="nombre" placeholder="Tu nombre">
      </div>
      <div class="form-group">
        <label>Teléfono</label>
        <input type="tel" id="telefono" placeholder="11 1234 5678">
      </div>
      <div class="form-group">
        <label>Barbero</label>
        <select id="barbero" onchange="loadHorarios()">
          <option value="">— Cargando... —</option>
        </select>
      </div>
      <div class="form-group">
        <label>Fecha</label>
        <input type="date" id="fecha" onchange="loadHorarios()">
      </div>
      <div class="form-group">
        <label>Notas adicionales (opcional)</label>
        <input type="text" id="notas" placeholder="Ej: traer foto de referencia">
      </div>
      <button class="btn-primary" onclick="confirmarTurno()">Confirmar turno →</button>
    </div>

    <div>
      <label>Horarios disponibles</label>
      <div class="slots-grid" id="slots-grid">
        <div class="empty-state"><div class="empty-state-text">Seleccioná barbero y fecha</div></div>
      </div>
      <div style="margin-top:20px; font-size:10px; color:rgba(245,237,216,0.3); letter-spacing:2px; line-height:2.2">
        <span style="border:1px solid rgba(201,146,42,0.25);padding:3px 8px;margin-right:8px">LIBRE</span>
        <span style="background:rgba(201,146,42,0.9);color:#1A1209;padding:3px 8px;margin-right:8px">ELEGIDO</span>
        <span style="opacity:0.4;border:1px solid rgba(255,255,255,0.1);padding:3px 8px;text-decoration:line-through">OCUPADO</span>
      </div>
    </div>
  </div>
</section>

<hr class="divider">

<!-- ADMIN -->
<section class="section" id="admin">
  <div class="section-header">
    <span class="section-num">02 — </span>
    <h2 class="section-title">Agenda & Gestión</h2>
  </div>

  <div class="tab-buttons">
    <button class="tab-btn active" onclick="switchTab('all')">Todos</button>
    <button class="tab-btn" onclick="switchTab('hoy')">Hoy</button>
    <button class="tab-btn" onclick="switchTab('buscar')">Buscar</button>
  </div>

  <div class="tab-content active" id="tab-all">
    <div class="filter-row">
      <select id="filtro-barbero" onchange="loadTurnos()">
        <option value="">Todos los barberos</option>
      </select>
      <select id="filtro-estado" onchange="loadTurnos()">
        <option value="">Todos los estados</option>
        <option>Pendiente</option><option>Realizado</option><option>Cancelado</option>
      </select>
      <button class="btn-secondary" onclick="loadTurnos()">↺ Actualizar</button>
    </div>
    <div id="tabla-all"></div>
  </div>

  <div class="tab-content" id="tab-hoy">
    <div id="tabla-hoy"></div>
  </div>

  <div class="tab-content" id="tab-buscar">
    <div class="filter-row" style="margin-bottom:32px">
      <input type="text" id="busqueda" placeholder="Buscar por nombre o teléfono..." oninput="buscarCliente()">
    </div>
    <div id="tabla-buscar"></div>
  </div>
</section>

<!-- MODAL -->
<div class="overlay" id="modal-overlay">
  <div class="modal">
    <div class="modal-title">Confirmar turno</div>
    <div class="modal-sub">Revisá los detalles antes de reservar</div>
    <div id="modal-details"></div>
    <div class="modal-actions">
      <button class="btn-secondary" onclick="closeModal()">Cancelar</button>
      <button class="btn-primary" id="btn-guardar" onclick="guardarTurno()">Reservar →</button>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
// ==================== CONFIG ====================
const API = 'api'; // Ruta base a la carpeta api/

let selectedServicio = null;
let selectedHorario  = null;
let pendingTurno     = null;
let barberos         = [];
let servicios        = [];

// ==================== INIT ====================
async function init() {
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('fecha').min   = today;
  document.getElementById('fecha').value = today;

  await checkDB();
  await Promise.all([loadServicios(), loadBarberos()]);
  await loadStats();
  await loadTurnos();
}

// ==================== DB STATUS ====================
async function checkDB() {
  try {
    const res = await fetch(`${API}/stats.php`);
    const data = await res.json();
    if (data.success) {
      document.getElementById('db-dot').className = 'db-dot connected';
      document.getElementById('db-label').textContent = 'MySQL conectado';
    }
  } catch(e) {
    document.getElementById('db-dot').className = 'db-dot error';
    document.getElementById('db-label').textContent = 'Sin conexión';
    document.getElementById('db-error-banner').innerHTML = `
      <div class="alert-box alert-error">
        ⚠ No se puede conectar con la base de datos. Verificá que XAMPP esté corriendo y que hayas importado <strong>database.sql</strong> en phpMyAdmin.
      </div>`;
  }
}

// ==================== LOAD DATA ====================
async function loadStats() {
  try {
    const res = await fetch(`${API}/stats.php`);
    const { data } = await res.json();
    document.getElementById('stat-hoy').textContent   = data.turnos_hoy;
    document.getElementById('stat-total').textContent = data.total;
  } catch(e) {}
}

async function loadServicios() {
  try {
    const res  = await fetch(`${API}/servicios.php`);
    const data = await res.json();
    servicios  = data.data;
    const grid = document.getElementById('services-grid');
    grid.innerHTML = servicios.map(s => `
      <div class="service-card" id="serv-${s.id}" onclick="selectServicio(${s.id})">
        <div class="service-name">${s.nombre}</div>
        <div class="service-desc">${s.descripcion}</div>
        <div class="service-price">$${Number(s.precio).toLocaleString('es-AR')} · ${s.duracion}min</div>
      </div>`).join('');
  } catch(e) {
    document.getElementById('services-grid').innerHTML = '<div style="color:#C96E6E;font-size:11px">Error al cargar servicios</div>';
  }
}

async function loadBarberos() {
  try {
    const res  = await fetch(`${API}/barberos.php`);
    const data = await res.json();
    barberos   = data.data;
    const sel  = document.getElementById('barbero');
    sel.innerHTML = '<option value="">— Elegir barbero —</option>' +
      barberos.map(b => `<option value="${b.id}">${b.nombre}</option>`).join('');

    // populate filter too
    const filtro = document.getElementById('filtro-barbero');
    filtro.innerHTML = '<option value="">Todos los barberos</option>' +
      barberos.map(b => `<option value="${b.id}">${b.nombre}</option>`).join('');
  } catch(e) {}
}

async function loadHorarios() {
  const barbero_id = document.getElementById('barbero').value;
  const fecha      = document.getElementById('fecha').value;
  const grid       = document.getElementById('slots-grid');

  if (!barbero_id || !fecha) {
    grid.innerHTML = '<div class="empty-state"><div class="empty-state-text">Seleccioná barbero y fecha</div></div>';
    return;
  }

  grid.innerHTML = '<div class="loading">Cargando horarios...</div>';
  selectedHorario = null;

  try {
    const res  = await fetch(`${API}/horarios.php?barbero_id=${barbero_id}&fecha=${fecha}`);
    const data = await res.json();
    grid.innerHTML = data.data.map(h => `
      <div class="slot ${h.disponible ? '' : 'taken'}" 
           onclick="${h.disponible ? `selectSlot('${h.horario}')` : ''}">
        ${h.horario}
      </div>`).join('');
  } catch(e) {
    grid.innerHTML = '<div style="color:#C96E6E;font-size:11px;padding:16px">Error cargando horarios</div>';
  }
}

// ==================== SELECTS ====================
function selectServicio(id) {
  selectedServicio = servicios.find(s => s.id == id);
  document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
  document.getElementById(`serv-${id}`).classList.add('selected');
}

function selectSlot(h) {
  selectedHorario = h;
  document.querySelectorAll('.slot').forEach(s => {
    s.classList.toggle('selected', s.textContent.trim() === h);
  });
}

// ==================== BOOKING ====================
function confirmarTurno() {
  const nombre     = document.getElementById('nombre').value.trim();
  const telefono   = document.getElementById('telefono').value.trim();
  const barbero_id = document.getElementById('barbero').value;
  const fecha      = document.getElementById('fecha').value;
  const notas      = document.getElementById('notas').value.trim();

  if (!nombre)          { showToast('Ingresá tu nombre', true); return; }
  if (!barbero_id)      { showToast('Elegí un barbero', true); return; }
  if (!selectedServicio){ showToast('Seleccioná un servicio', true); return; }
  if (!fecha)           { showToast('Elegí una fecha', true); return; }
  if (!selectedHorario) { showToast('Elegí un horario', true); return; }

  const barberoNombre = barberos.find(b => b.id == barbero_id)?.nombre || '';

  pendingTurno = { nombre, telefono, barbero_id, barberoNombre, fecha, horario: selectedHorario, notas,
                   servicio_id: selectedServicio.id, servicioNombre: selectedServicio.nombre,
                   precio: selectedServicio.precio };

  const d = new Date(fecha + 'T12:00:00');
  const dias = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];
  const fechaStr = `${dias[d.getDay()]} ${d.getDate()}/${d.getMonth()+1}/${d.getFullYear()}`;

  document.getElementById('modal-details').innerHTML = `
    <div class="confirmation-detail"><span class="key">Cliente</span><span class="val">${nombre}</span></div>
    <div class="confirmation-detail"><span class="key">Barbero</span><span class="val">${barberoNombre}</span></div>
    <div class="confirmation-detail"><span class="key">Servicio</span><span class="val">${selectedServicio.nombre}</span></div>
    <div class="confirmation-detail"><span class="key">Precio</span><span class="val">$${Number(selectedServicio.precio).toLocaleString('es-AR')}</span></div>
    <div class="confirmation-detail"><span class="key">Fecha</span><span class="val">${fechaStr}</span></div>
    <div class="confirmation-detail"><span class="key">Horario</span><span class="val">${selectedHorario}hs</span></div>
    ${telefono ? `<div class="confirmation-detail"><span class="key">Teléfono</span><span class="val">${telefono}</span></div>` : ''}
    ${notas ? `<div class="confirmation-detail"><span class="key">Notas</span><span class="val">${notas}</span></div>` : ''}
  `;
  document.getElementById('modal-overlay').classList.add('active');
}

async function guardarTurno() {
  const btn = document.getElementById('btn-guardar');
  btn.disabled = true; btn.textContent = 'Guardando...';

  try {
    const res = await fetch(`${API}/turnos.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(pendingTurno)
    });
    const data = await res.json();
    if (data.success) {
      closeModal();
      showToast(`✓ Turno reservado para las ${pendingTurno.horario}hs`);
      document.getElementById('nombre').value   = '';
      document.getElementById('telefono').value = '';
      document.getElementById('notas').value    = '';
      selectedHorario = null; selectedServicio = null;
      document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
      await Promise.all([loadHorarios(), loadTurnos(), loadStats()]);
    } else {
      showToast(data.error || 'Error al guardar', true);
    }
  } catch(e) {
    showToast('Error de conexión con la base de datos', true);
  }
  btn.disabled = false; btn.textContent = 'Reservar →';
}

function closeModal() {
  document.getElementById('modal-overlay').classList.remove('active');
}

// ==================== TABLES ====================
async function loadTurnos() {
  const barbero_id = document.getElementById('filtro-barbero').value;
  const estado     = document.getElementById('filtro-estado').value;
  let url = `${API}/turnos.php?`;
  if (barbero_id) url += `barbero_id=${barbero_id}&`;
  if (estado) url += `estado=${estado}&`;

  document.getElementById('tabla-all').innerHTML = '<div class="loading">Cargando...</div>';
  try {
    const res  = await fetch(url);
    const data = await res.json();
    document.getElementById('tabla-all').innerHTML = buildTable(data.data);
  } catch(e) {
    document.getElementById('tabla-all').innerHTML = '<div style="color:#C96E6E;padding:20px;font-size:12px">Error al cargar turnos. Verificá la conexión con MySQL.</div>';
  }
}

async function loadHoy() {
  const today = new Date().toISOString().split('T')[0];
  const res   = await fetch(`${API}/turnos.php?fecha=${today}`);
  const data  = await res.json();
  document.getElementById('tabla-hoy').innerHTML = buildTable(data.data, 'No hay turnos para hoy');
}

async function buscarCliente() {
  const q = document.getElementById('busqueda').value.trim();
  if (q.length < 2) { document.getElementById('tabla-buscar').innerHTML = ''; return; }
  const res  = await fetch(`${API}/turnos.php?busqueda=${encodeURIComponent(q)}`);
  const data = await res.json();
  document.getElementById('tabla-buscar').innerHTML = buildTable(data.data, 'Sin resultados');
}

function buildTable(rows, emptyMsg = 'Sin turnos') {
  if (!rows || !rows.length) return `<div class="empty-state"><div class="empty-state-icon">✂</div><div class="empty-state-text">${emptyMsg}</div></div>`;
  return `<table class="data-table">
    <thead><tr><th>#</th><th>Nombre</th><th>Barbero</th><th>Servicio</th><th>Precio</th><th>Fecha</th><th>Horario</th><th>Estado</th><th>Acciones</th></tr></thead>
    <tbody>${rows.map(r => {
      const badge = r.estado==='Realizado'?'done':r.estado==='Cancelado'?'cancelled':'pending';
      const [y,m,d] = r.fecha.split('-');
      return `<tr>
        <td style="color:rgba(245,237,216,0.3)">${r.id}</td>
        <td><div>${r.nombre}</div><div style="font-size:10px;color:rgba(245,237,216,0.3)">${r.telefono||''}</div></td>
        <td>${r.barbero}</td>
        <td style="font-size:11px">${r.servicio}</td>
        <td style="color:var(--gold)">$${Number(r.precio).toLocaleString('es-AR')}</td>
        <td>${d}/${m}</td>
        <td><strong>${r.horario}hs</strong></td>
        <td><span class="badge badge-${badge}">${r.estado}</span></td>
        <td><div style="display:flex;gap:8px">
          ${r.estado==='Pendiente' ? `<button class="btn-secondary" style="padding:6px 12px;font-size:9px" onclick="cambiarEstado(${r.id},'Realizado')">✓</button>` : ''}
          ${r.estado!=='Cancelado' ? `<button class="btn-danger" onclick="cambiarEstado(${r.id},'Cancelado')">✕</button>` : ''}
        </div></td>
      </tr>`;
    }).join('')}</tbody></table>`;
}

async function cambiarEstado(id, estado) {
  if (estado === 'Cancelado' && !confirm('¿Cancelar este turno?')) return;
  try {
    const res  = await fetch(`${API}/turnos.php`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id, estado })
    });
    const data = await res.json();
    if (data.success) {
      showToast(estado === 'Realizado' ? '✓ Marcado como realizado' : 'Turno cancelado');
      await Promise.all([loadTurnos(), loadHoy(), loadStats()]);
    }
  } catch(e) { showToast('Error de conexión', true); }
}

// ==================== TABS ====================
function switchTab(tab) {
  document.querySelectorAll('.tab-btn').forEach((b,i) => {
    b.classList.toggle('active', ['all','hoy','buscar'][i] === tab);
  });
  document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
  document.getElementById(`tab-${tab}`).classList.add('active');
  if (tab === 'hoy') loadHoy();
}

// ==================== UTILS ====================
function scrollToSection(id) {
  document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
}

let toastTimer;
function showToast(msg, error = false) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'toast show' + (error ? ' error' : '');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => { t.className = 'toast'; }, 3200);
}

document.getElementById('modal-overlay').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});

// START
init();
</script>
</body>
</html>
