# Proyecto: Plataforma SaaS de Gestión Escolar (PHP Puro)

Descripción
- Sistema multi-institución para gestión escolar, con MVC propio en PHP puro y base de datos MySQL.
- Soporte de roles, facturación, notificaciones, y API REST para integraciones futuras.

Instalación (guía rápida)
- Clonar el repositorio en el servidor local o hosting compatible.
- Duplicar .env.example a .env y configurar variables de entorno (BD, app, etc.).
- Crear base de datos y ejecutar migraciones en database/migrations/ en orden.
- Configurar permisos de archivo y permisos de PHP.
- Acceder a la aplicación vía http(s)://tu-dominio o localhost.

Estructura de carpetas explicada
- config/: Configuración global y conexión a BD
- core/: Micro-framework propio (Router, Controladores base, Modelos base, Vista)
- app/: Controladores, Modelos y Vistas por módulo
- public/: Punto de entrada y activos públicos
- database/migrations/: Migraciones SQL numeradas
- docs/: Documentación de conocimiento dinámico

Variables de entorno necesarias
- APP_ENV, APP_DEBUG, APP_URL
- DB_HOST, DB_NAME, DB_USER, DB_PASS
- SESSION_NAME, SESSION_LIFETIME

Cómo funciona cada módulo principal
- Ver PROYECTO.md para visión de alto nivel y flujos

Onboarding para nuevos desarrolladores
- Leer BITACORA.md, PROYECTO.md y docs/ antes de tocar código
- Configurar entorno local y first run
- Empezar con un módulo pequeño para validar la arquitectura

Notas
- Este es un proyecto en curso; las decisiones pueden cambiar con ADRs y documentación adicional.
