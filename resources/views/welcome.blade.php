<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sistema de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background: #212529; color: white; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .sidebar-header { padding: 20px; background: #1a1d20; border-bottom: 1px solid #343a40; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 15px 20px; display: block; transition: 0.3s; border-left: 4px solid transparent; }
        .sidebar a:hover, .sidebar a.active { background: #2c3034; color: #fff; border-left: 4px solid #0d6efd; }
        .stat-card { border: none; border-radius: 12px; transition: transform 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-box { font-size: 2.5rem; opacity: 0.3; }
        .main-content { padding: 30px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); background: white; }
        .table thead th { border-top: none; background-color: #f8f9fa; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
        .avatar-circle { width: 35px; height: 35px; background-color: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #495057; }
        .status-badge { font-size: 0.75rem; padding: 5px 10px; border-radius: 20px; }
    </style>
</head>
<body>

<div class="row g-0">
    <div class="col-md-2 sidebar d-none d-md-block">
        <div class="sidebar-header text-center">
            <h5 class="mb-0"><i class="fas fa-layer-group text-primary me-2"></i>API Admin</h5>
            <small class="text-muted" style="font-size: 0.75rem;">v1.0.0 Producción</small>
        </div>
        <div class="mt-3">
            <a href="#" class="active"><i class="fas fa-tachometer-alt me-3"></i>Dashboard</a>
            <a href="#"><i class="fas fa-users me-3"></i>Usuarios</a>
            <a href="#"><i class="fas fa-network-wired me-3"></i>Infraestructura</a>
            <a href="#"><i class="fas fa-file-alt me-3"></i>Logs & Reportes</a>
            <a href="#"><i class="fas fa-cog me-3"></i>Configuración</a>
        </div>
        <div class="mt-auto p-4" style="position: absolute; bottom: 0; width: 100%;">
            <div class="card bg-dark border-secondary p-2">
                <small class="text-muted"><i class="fas fa-server me-1"></i> Estado Sistema</small>
                <div class="d-flex align-items-center mt-2">
                    <div class="spinner-grow spinner-grow-sm text-success me-2" role="status"></div>
                    <span class="text-light" style="font-size: 0.85rem;">Online (AWS)</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-10 col-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3">
            <div class="container-fluid p-0">
                <span class="navbar-brand mb-0 h1 text-secondary"><i class="fas fa-bars me-2 d-md-none"></i> Panel de Control</span>
                <div class="d-flex align-items-center">
                    <div class="me-3 text-end d-none d-md-block">
                        <span class="d-block fw-bold text-dark">Administrador</span>
                        <small class="text-muted">admin@inacap.cl</small>
                    </div>
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <div class="row mb-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card stat-card bg-primary text-white h-100">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Usuarios Totales</h6>
                                <h2 class="mb-0 fw-bold" id="totalUsersCount">0</h2>
                            </div>
                            <div class="icon-box"><i class="fas fa-users"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card stat-card bg-success text-white h-100">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">API Status</h6>
                                <h2 class="mb-0 fw-bold">Activo</h2>
                            </div>
                            <div class="icon-box"><i class="fas fa-check-circle"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card bg-info text-white h-100">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <h6 class="text-uppercase mb-1" style="opacity: 0.8;">Base de Datos</h6>
                                <h2 class="mb-0 fw-bold">SQLite</h2>
                            </div>
                            <div class="icon-box"><i class="fas fa-database"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card card-custom h-100">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                            <h5 class="card-title fw-bold text-dark"><i class="fas fa-user-plus text-primary me-2"></i>Nuevo Registro</h5>
                        </div>
                        <div class="card-body p-4">
                            <form id="createUserForm">
                                <div class="mb-3">
                                    <label class="form-label text-secondary small fw-bold">NOMBRE COMPLETO</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                        <input type="text" id="name" class="form-control border-start-0 ps-0 bg-light" placeholder="Ej: Elias Ruiz" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small fw-bold">CORREO ELECTRÓNICO</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" id="email" class="form-control border-start-0 ps-0 bg-light" placeholder="correo@ejemplo.com" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-secondary small fw-bold">CONTRASEÑA</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                        <input type="password" id="password" class="form-control border-start-0 ps-0 bg-light" placeholder="••••••••" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                                    <i class="fas fa-save me-2"></i> Guardar Usuario
                                </button>
                            </form>
                            <div id="alertMessage" class="mt-3"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-custom h-100">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-bold text-dark"><i class="fas fa-table text-primary me-2"></i>Usuarios Registrados</h5>
                            <button onclick="cargarUsuarios()" class="btn btn-outline-light text-secondary btn-sm border hover-shadow">
                                <i class="fas fa-sync-alt me-1"></i> Refrescar
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive p-4">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Estado</th>
                                            <th>Fecha Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        <tr><td colspan="5" class="text-center py-4 text-muted"><i class="fas fa-spinner fa-spin me-2"></i>Cargando datos...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const API_URL = '/api/users'; 

    // 1. CREAR (POST)
    document.getElementById('createUserForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = e.target.querySelector('button');
        const originalText = btn.innerHTML;
        
        // Efecto de carga en el botón
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Guardando...';
        btn.disabled = true;

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        try {
            const response = await fetch(API_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ name, email, password })
            });
            
            const data = await response.json();
            const alertBox = document.getElementById('alertMessage');

            if (response.ok) {
                alertBox.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> <strong>¡Éxito!</strong> Usuario guardado (ID: ${data.id}).
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`;
                document.getElementById('createUserForm').reset();
                cargarUsuarios(); // Recargar tabla
            } else {
                alertBox.innerHTML = `<div class="alert alert-danger border-0 shadow-sm"><i class="fas fa-exclamation-circle me-2"></i> Error: ${data.message || 'Datos inválidos'}</div>`;
            }
        } catch (error) {
            console.error(error);
            alert("Error de conexión con la API");
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });

    // 2. LISTAR (GET)
    async function cargarUsuarios() {
        const tbody = document.getElementById('userTableBody');
        const countBadge = document.getElementById('totalUsersCount');
        
        try {
            const response = await fetch(API_URL);
            const data = await response.json();
            
            tbody.innerHTML = '';
            const usuarios = Array.isArray(data) ? data : (data.data || []);
            
            // Actualizar contador en tarjeta azul
            countBadge.innerText = usuarios.length;

            if(usuarios.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No hay registros en la base de datos</td></tr>';
                return;
            }

            // Generar filas de tabla
            usuarios.forEach(user => {
                // Generar fecha actual si no viene (mock visual)
                const date = user.created_at ? new Date(user.created_at).toLocaleDateString() : new Date().toLocaleDateString();
                
                tbody.innerHTML += `
                    <tr>
                        <td><span class="badge bg-light text-dark border">#${user.id}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">
                                    ${user.name.charAt(0).toUpperCase()}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">${user.name}</div>
                                    <small class="text-muted d-block d-md-none" style="font-size:0.7rem">Admin</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted">${user.email}</td>
                        <td><span class="status-badge bg-success bg-opacity-10 text-success fw-bold">Activo</span></td>
                        <td class="text-muted small"><i class="far fa-calendar-alt me-1"></i> ${date}</td>
                    </tr>`;
            });
        } catch (error) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center text-danger py-4">Error cargando datos de API</td></tr>';
        }
    }

    // Cargar al iniciar
    cargarUsuarios();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>