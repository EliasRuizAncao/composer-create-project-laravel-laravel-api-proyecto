<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Completa | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .avatar-circle { width: 35px; height: 35px; background-color: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .btn-action:hover { transform: scale(1.1); transition: 0.2s; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block p-3">
            <h4 class="text-center mb-4"><i class="fas fa-user-shield me-2"></i>Admin</h4>
            <hr>
            <div class="d-grid gap-2">
                <button class="btn btn-primary text-start"><i class="fas fa-users me-2"></i>Usuarios</button>
            </div>
        </div>

        <div class="col-md-10 col-12 p-4">
            <h2 class="mb-4 text-secondary"><i class="fas fa-tasks me-2"></i>Gestión de Personal</h2>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card card-custom h-100">
                        <div class="card-header bg-white pt-4 border-0">
                            <h5 id="formTitle" class="fw-bold text-primary"><i class="fas fa-plus-circle me-2"></i>Nuevo Usuario</h5>
                        </div>
                        <div class="card-body">
                            <form id="userForm">
                                <input type="hidden" id="userId"> <div class="mb-2">
                                    <label class="small text-muted fw-bold">NOMBRE COMPLETO</label>
                                    <input type="text" id="name" class="form-control" placeholder="Ej: Juan Pérez" required>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <label class="small text-muted fw-bold">AÑO NACIMIENTO</label>
                                        <input type="number" id="birth_year" class="form-control" placeholder="1995" required>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label class="small text-muted fw-bold">SEXO</label>
                                        <select id="gender" class="form-select" required>
                                            <option value="">Seleccione...</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="small text-muted fw-bold">TELÉFONO CELULAR</label>
                                    <input type="tel" id="phone" class="form-control" placeholder="+56 9 1234 5678" required>
                                </div>

                                <div class="mb-2">
                                    <label class="small text-muted fw-bold">EMAIL</label>
                                    <input type="email" id="email" class="form-control" placeholder="correo@ejemplo.com" required>
                                </div>

                                <div class="mb-4">
                                    <label class="small text-muted fw-bold">CONTRASEÑA</label>
                                    <input type="password" id="password" class="form-control" placeholder="••••••">
                                    <small class="text-muted d-none" id="passHelp">Dejar en blanco para no cambiar</small>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary fw-bold" id="btnSubmit">
                                        <i class="fas fa-save me-2"></i> Guardar
                                    </button>
                                    <button type="button" class="btn btn-secondary d-none" id="btnCancel" onclick="resetForm()">
                                        Cancelar Edición
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-custom h-100">
                        <div class="card-body p-0">
                            <div class="table-responsive p-3">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Contacto</th>
                                            <th>Datos</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        <tr><td colspan="4" class="text-center">Cargando...</td></tr>
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
    let isEditing = false;

    // 1. CARGAR USUARIOS
    async function cargarUsuarios() {
        const tbody = document.getElementById('userTableBody');
        try {
            const res = await fetch(API_URL);
            const users = await res.json();
            
            tbody.innerHTML = '';
            users.forEach(u => {
                // Icono según género
                const icon = u.gender === 'Femenino' ? 'fa-female text-danger' : 'fa-male text-primary';
                
                tbody.innerHTML += `
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-2"><i class="fas ${icon}"></i></div>
                                <div>
                                    <div class="fw-bold">${u.name}</div>
                                    <small class="text-muted">ID: ${u.id}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small"><i class="fas fa-envelope me-1 text-muted"></i> ${u.email}</div>
                            <div class="small"><i class="fas fa-phone me-1 text-muted"></i> ${u.phone || '-'}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">Año: ${u.birth_year || '-'}</span>
                            <span class="badge bg-light text-dark border">${u.gender || '-'}</span>
                        </td>
                        <td>
                            <button onclick='editarUsuario(${JSON.stringify(u)})' class="btn btn-sm btn-outline-warning btn-action me-1" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button onclick="borrarUsuario(${u.id})" class="btn btn-sm btn-outline-danger btn-action" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
        } catch (e) { console.error(e); }
    }

    // 2. GUARDAR / ACTUALIZAR
    document.getElementById('userForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('userId').value;
        const data = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            birth_year: document.getElementById('birth_year').value,
            gender: document.getElementById('gender').value,
            password: document.getElementById('password').value
        };

        // Si es edición y no puso password, la borramos del objeto para no enviarla vacía
        if(isEditing && !data.password) delete data.password;

        const url = isEditing ? `${API_URL}/${id}` : API_URL;
        const method = isEditing ? 'PUT' : 'POST';

        try {
            const res = await fetch(url, {
                method: method,
                headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
                body: JSON.stringify(data)
            });

            if(res.ok) {
                alert(isEditing ? 'Usuario actualizado' : 'Usuario creado');
                resetForm();
                cargarUsuarios();
            } else {
                alert('Error al guardar. Revisa los datos.');
            }
        } catch(e) { alert('Error de conexión'); }
    });

    // 3. EDITAR (Llenar formulario)
    window.editarUsuario = (user) => {
        isEditing = true;
        document.getElementById('userId').value = user.id;
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('phone').value = user.phone || '';
        document.getElementById('birth_year').value = user.birth_year || '';
        document.getElementById('gender').value = user.gender || '';
        
        // UI Cambios
        document.getElementById('formTitle').innerHTML = '<i class="fas fa-edit me-2"></i>Editar Usuario';
        document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-sync-alt me-2"></i> Actualizar';
        document.getElementById('btnSubmit').classList.replace('btn-primary', 'btn-warning');
        document.getElementById('btnCancel').classList.remove('d-none');
        document.getElementById('passHelp').classList.remove('d-none');
    };

    // 4. BORRAR
    window.borrarUsuario = async (id) => {
        if(!confirm('¿Eliminar usuario?')) return;
        await fetch(`${API_URL}/${id}`, { method: 'DELETE' });
        cargarUsuarios();
    };

    // 5. RESET
    window.resetForm = () => {
        isEditing = false;
        document.getElementById('userForm').reset();
        document.getElementById('userId').value = '';
        
        // UI Reset
        document.getElementById('formTitle').innerHTML = '<i class="fas fa-plus-circle me-2"></i>Nuevo Usuario';
        document.getElementById('btnSubmit').innerHTML = '<i class="fas fa-save me-2"></i> Guardar';
        document.getElementById('btnSubmit').classList.replace('btn-warning', 'btn-primary');
        document.getElementById('btnCancel').classList.add('d-none');
        document.getElementById('passHelp').classList.add('d-none');
    };

    cargarUsuarios();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>