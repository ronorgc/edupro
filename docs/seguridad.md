# Seguridad del Sistema

- Autenticación y sesiones: cifrado de contraseñas con bcrypt; verificación con password_verify; regeneración de session_id al iniciar sesión; cierre de sesión destruye sesión.
- Input y BD: PDO con prepared statements; evita concatenación de variables; validación y sanitización de inputs; escape en salidas con htmlspecialchars.
- Formularios: CSRF token para modificaciones; validación en servidor y cliente.
- Archivos subidos: verificación MIME y renombrado seguro.
- Configuración: APP_DEBUG false en producción; credenciales en .env; .env gitignored.
