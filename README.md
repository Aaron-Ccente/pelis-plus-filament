# NEXUS - Plataforma Empresarial de Gestión y Telefonía

NEXUS es una plataforma empresarial desarrollada en Laravel 12, diseñada para centralizar la gestión administrativa mediante múltiples módulos CRUD y una integración avanzada con telefonía Genesys Cloud.

El sistema permite administrar entidades internas, estructuras organizacionales y configuraciones de telefonía desde un panel administrativo moderno construido con Filament.

---

## Características Principales

### Módulos Administrativos (Arquitectura basada en CRUD)

- Gestión de Usuarios
- Roles y Permisos
- Divisiones y Estructura Organizacional
- Catálogos Parametrizables
- Configuración de Entidades Operativas
- Auditoría y Registro de Actividad
- Gestión de Configuración General del Sistema

Todos los módulos administrativos están desarrollados con **Filament**, permitiendo:
- Panel administrativo moderno
- Formularios dinámicos
- Tablas con filtros avanzados
- Acciones masivas
- Validaciones integradas
- Control de acceso por roles

---

## Módulo de Telefonía (Integración con Genesys Cloud)

NEXUS integra funcionalidades de telefonía mediante la API oficial de Genesys Cloud.

### Funcionalidades implementadas:

- Creación de teléfonos (`/api/v2/telephony/providers/edges/phones`)
- Configuración de Phone Base Settings
- Gestión de Lines y asignación de divisiones
- Integración con Edges y Sites
- Autenticación OAuth (Client Credentials)
- Manejo de errores de API (401, 404, etc.)
- Procesamiento en segundo plano mediante Jobs
- Logs de integración y trazabilidad

La integración permite automatizar la provisión y configuración de dispositivos telefónicos directamente desde el sistema administrativo.

---

## Arquitectura Tecnológica

### Backend

- Framework: Laravel 12
- PHP: 8.2+
- Base de Datos: Amazon DynamoDB
- Autenticación: Laravel Sanctum
- Autorización: Spatie Laravel Permission
- Jobs y Colas: Laravel Queue
- Cliente HTTP: Laravel HTTP Client

### Base de Datos

Se utiliza Amazon DynamoDB como motor NoSQL, lo que permite:

- Alta escalabilidad
- Baja latencia
- Modelo flexible basado en documentos
- Optimización para cargas de lectura y escritura intensivas

Las entidades están diseñadas considerando claves primarias y secundarias según los patrones de acceso del sistema.

### Panel Administrativo

Desarrollado con:

- Filament Admin Panel
- Recursos CRUD personalizados
- Formularios reactivos
- Gestión de relaciones
- Políticas de acceso integradas

---

## Instalación

### Requisitos

- PHP 8.2+
- Composer
- Node.js y npm
- Cuenta AWS con acceso a DynamoDB
- Credenciales de Genesys Cloud (Client ID y Client Secret)

---

### Pasos de Instalación

1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd nexus
