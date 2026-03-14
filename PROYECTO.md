# PROYECTO: Plataforma SaaS de Gestión Escolar (RD)

Descripción general
- Plataforma multi-institución para gestión académica y administrativa de colegios en República Dominicana.
- Arquitectura MVC propia, PHP puro, base de datos MySQL/MariaDB, con enfoque modular y escalable.

Roles de usuario
- Super Administrador: gestión de empresa, planes, cobros, notificaciones y logs.
- Administradores de colegio: gestión de estudiantes, docentes, matrícula, calificaciones, pagos, reportes.
- Profesor: cursos, asistencia, tareas, recursos y evaluaciones.
- Estudiante: consulta de cursos, tareas y calificaciones.
- Padres: visualización de calificaciones, asistencia, pagos y boletines.

Módulos principales
- Autenticación y Roles
- Gestión de Instituciones (colegios) y Multi-Tenant
- Gestión de Estudiantes, Docentes, Matrículas
- Sistema de Calificaciones (MINERD compatible)
- Asistencia, Aulas Virtuales, Boletines
- Pagos, Suscripciones y Facturación DGII
- Notificaciones y Mensajería
- Auditoría, Logs y Monitoreo
- API REST para integraciones futuras

Flujos principales
- Registro y activación de colegios
- Proceso de matrícula y pago de plan
- Registro de calificaciones y generación de boletines
- Envío de notificaciones y reportes

Reglas de negocio importantes
- Un registro está ligado a institucíon_id; todo módulo debe respetar la multi-tenant.
- Autenticación segura con hashing bcrypt; uso de prepared statements.
- Los estados de suscripciones: activa, en_prueba, vencida, suspendida, cancelada.
- Todas las migraciones deben registrarse en MIGRATIONS.

Checklist de desarrollo por módulo
- [ ] Arquitectura base y router
- [ ] Modelos y controladores base
- [ ] Módulos de autenticación y permisos
- [ ] Vista base con layout y Bootstrap
- [ ] Pruebas y validaciones básicas
- [ ] Documentación y ADRs

Notas finales
- Este documento se mantiene como guía para el desarrollo; se debe actualizar conforme avances.
