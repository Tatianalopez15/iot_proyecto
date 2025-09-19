@extends('layout.app')
@section('title','home')
@section('content')
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel — Tablas • Gráficas • Formulario • Registrar</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
  
    :root {
      --bg: #f9fafb;
      --card: #ffffff;
      --accent: #2563eb;
      --muted: #6b7280;
      --border: #e5e7eb;
    }
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background: var(--bg);
      color: #111827;
    }
    header {
      padding: 16px 24px;
      border-bottom: 1px solid var(--border);
      background: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      font-size: 20px;
      margin: 0;
    }
    header small {
      display: block;
      color: var(--muted);
      font-size: 13px;
    }
    /* Botones */
    .btn {
      padding: 8px 14px;
      border-radius: 6px;
      font-size: 14px;
      border: none;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-primary {
      background: var(--accent);
      color: white;
    }
    .btn-primary:hover {
      background: #1d4ed8;
    }
    .btn-secondary {
      background: #f3f4f6;
      color: #374151;
    }
    .btn-secondary:hover {
      background: #e5e7eb;
    }
    /* Contenedor */
    main {
      padding: 24px;
      max-width: 1200px;
      margin: auto;
    }
    .actions {
      margin: 16px 0;
      display: flex;
      gap: 12px;
    }
    /* Tarjetas */
    .status {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px;
      margin: 24px 0;
    }
    .card {
      background: var(--card);
      padding: 16px;
      border-radius: 12px;
      border: 1px solid var(--border);
      box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }
    .card h3 {
      margin: 0;
      font-size: 20px;
    }
    .card p {
      margin: 6px 0 0;
      font-size: 14px;
      color: var(--muted);
    }
    /* Módulos */
    h2 { margin-top: 32px; font-size: 20px; }
    .modules {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 16px;
    }
    .module {
      background: var(--card);
      padding: 20px;
      border-radius: 12px;
      border: 1px solid var(--border);
      box-shadow: 0 2px 6px rgba(0,0,0,0.04);
      display: flex;
      flex-direction: column;
    }
    .module h4 { margin: 0 0 8px; font-size: 16px; }
    .module p { font-size: 14px; color: var(--muted); flex-grow: 1; }
    .module .btn { margin-top: 12px; font-size: 13px; }
    /* Modal */
    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 12px;
      width: 320px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .modal-content h3 {
      margin-top: 0;
    }
    .modal-content input {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid var(--border);
      border-radius: 6px;
    }
  </style>
</head>
<body>
  <header>
    <div>
      <h1>Panel IoT — Monitoreo & Registros</h1>
      <small>ESP32 + LTE (SIM7670G) + PostgreSQL</small>
    </div>
    <div>
      <button class="btn btn-secondary" onclick="openModal('loginModal')">🔑 Iniciar sesión</button>
      <button class="btn btn-primary" onclick="openModal('registerModal')">👤 Registrarse</button>
    </div>
  </header>

  <main>
    <p>Captura datos, visualízalos en tabla y prepara el entorno para conectar <strong>SENSORES</strong> de dispositivos IoT.</p>
    <div class="actions">
      <button class="btn btn-primary">➕ Registrar dato</button>
      <button class="btn btn-secondary">📊 Ver tabla</button>
    </div>

    <div class="status">
      <div class="card"><h3>3</h3><p>Sensores en línea<br><small>Demo (mock) • Ajustable</small></p></div>
      <div class="card"><h3>hace 2 min</h3><p>Última sincronización<br><small>Simulada para la demo</small></p></div>
      <div class="card"><h3>MYSQL</h3><p>Base de datos<br><small>Conectado vía MYSQL</small></p></div>
    </div>

    <h2>Módulos</h2>
    <div class="modules">
      <div class="module">
        <h4>📑 Gestión de registros</h4>
        <p>Crea y lista registros (base para actores, pacientes o dispositivos).</p>
        <div>
          <button class="btn btn-primary">Nuevo</button>
          <button class="btn btn-secondary">Ver</button>
        </div>
      </div>
      <div class="module">
        <h4>📡 Dispositivos IoT</h4>
        <p>Registro de dispositivos ESP32/SIM7670G, asignación y estado.</p>
        <button class="btn btn-secondary" disabled>Próximamente</button>
      </div>
      <div class="module">
        <h4>📈 Panel tiempo real</h4>
        <p>Gráficas de telemetría (SpO₂, pulso, temperatura) con WebSockets (pendiente).</p>
        <button class="btn btn-secondary" disabled>Próximamente</button>
      </div>
    </div>
  </main>

  <!-- Modal Login -->
  <div class="modal" id="loginModal">
    <div class="modal-content">
      <h3>🔑 Iniciar sesión</h3>
      <input type="email" placeholder="Correo" id="loginEmail" required>
      <input type="password" placeholder="Contraseña" id="loginPassword" required>
      <button class="btn btn-primary" style="width:100%;">Entrar</button>
      <button class="btn btn-secondary" style="width:100%; margin-top:8px;" onclick="closeModal('loginModal')">Cancelar</button>
    </div>
  </div>

  <!-- Modal Registro -->
  <div class="modal" id="registerModal">
    <div class="modal-content">
      <h3>👤 Registro de usuario</h3>
      <input type="text" placeholder="Nombre" id="regNombre" required>
      <input type="email" placeholder="Correo" id="regEmail" required>
      <input type="password" placeholder="Contraseña" id="regPassword" required>
      <button class="btn btn-primary" style="width:100%;">Registrar</button>
      <button class="btn btn-secondary" style="width:100%; margin-top:8px;" onclick="closeModal('registerModal')">Cancelar</button>
    </div>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).style.display = "flex";
    }
    function closeModal(id) {
      document.getElementById(id).style.display = "none";
    }
  </script>
</body>
</html>
