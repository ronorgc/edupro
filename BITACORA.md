# BITÁORA

## RESUMEN DEL PROYECTO
Desarrollo de una plataforma SaaS de Gestión Escolar multi-institución, con arquitectura MVC propia en PHP puro, orientada a colegios en República Dominicana. Este repositorio sirve como base inicial y guía de desarrollo.

## ARQUITECTURA ACTUAL
- Estructura MVC propia: core/, app/, config/, public/.
- Base de datos MySQL/MariaDB con PDO y consultas preparadas.
- Soporte multi-tenant mediante identificador institucion_id en cada registro.
- Módulos base: autenticación, usuarios, roles, logging, notificaciones.

## ✅ COMPLETADO
- Estructura de carpetas base creada.
- Archivos de configuración inicial y router base definidos.
- Esqueleto de controlador y vistas principal implementado.

## 🔄 EN PROGRESO
- Definición de migraciones y sistema de logs.
- Implementación de dashboard y módulos administrativos.

## ⏳ PENDIENTE
- Implementar migraciones iniciales y migración de BD.
- Añadir documentación PROYECTO.md y README.md completos.

## 🚫 PROBLEMAS CONOCIDOS / DEUDA TÉCNICA
- Aún no existe gestor de dependencias; plan para un framework mínimo propio.
- Falta definir ADRs y reglas de negocio en docs.

## 📐 DECISIONES TÉCNICAS (ADRs)
- Se utilizará PHP puro sin Composer para el core.
- Arquitectura MVC interna con Router; no se usarán frameworks externos.
- Todas las consultas a BD con PDO y prepared statements.

## 📅 LOG DE SESIONES ← nueva entrada al final, siempre

### Sesión 1 — 2026-03-14
**Trabajado:** Creación de la estructura base del proyecto y archivos de configuración.
**Estado actualizado:**
- ✅ Completado: Estructura de carpetas y archivos base.
- 🔄 En progreso: Definición de convenciones de código y nuevo layout de vistas.
- ⏳ Pendiente: Crear HomeController, layout y vistas iniciales.
**Decisiones técnicas:** Ninguna nueva.
**Para la próxima sesión:** Implementar Router, Controller base, Model base; crear HomeController y vista inicial.
---
### Sesión 3 — 2026-03-15
**Trabajado:** Seguimiento de repositorio remoto, confirmación de ramas y plan de siguientes actualizaciones.
**Estado actualizado:**
- ✅ Completado: repositorio remoto enlazado; develop y main siguen sincronizados con origin.
- 🔄 En progreso: definir y aplicar protecciones de rama y definir default branch en GitHub.
- ⏳ Pendiente: crear PR inicial de develop a main si procede y comenzar migraciones/db scaffold.
**Decisiones técnicas:** Continuar con flujo develop/main; preparar migraciones iniciales y módulos de autenticación.
**Para la próxima sesión:** Crear migraciones iniciales y un módulo de autenticación básico (login/logout).
---
