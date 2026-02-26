# Document CRUD - Prueba Técnica

## Descripción
Aplicación CRUD para gestión de documentos...

## Tecnologías
- PHP 8+
- MySQL
- Eloquent ORM (illuminate/database)
- Composer
- Arquitectura MVC
- Principios SOLID
- Inyección de Dependencias (IoC Container)
- Middleware (Autenticación y CSRF)
- Manejo Global de Excepciones
- Sistema de Logging

## Instalación
1. Clonar repositorio
2. Ejecutar composer install
3. Importar scripts SQL desde database/sql/
4. Configurar base de datos
5. Acceder a http://localhost/document-crud/public

## Caracterízticas Implementadas
- Login de usuario (credenciales definidas en código)
- Logout seguro
- CRUD completo de documentos
- Búsqueda por nombre o código
- Generación automática de código documental

- Recalculo automático del código si cambia tipo o proceso
- No reutilización de consecutivos por combinación tipo/proceso
- Protección de rutas mediante Middleware
- Protección CSRF en formularios
- Manejo global de excepciones
- Sistema de logging en `storage/logs/app.log`

---

##  Modelo de Datos

### Tabla `proceso`
Contiene los procesos del sistema.

Ejemplo:

| id | nombre       | prefijo |
|----|-------------|----------|
| 1  | Ingeniería  | ING      |

---

### Tabla `tipo_documento`
Contiene los tipos de documento.

Ejemplo:

| id | nombre       | prefijo |
|----|-------------|----------|
| 1  | Instructivo | INS      |

---

### Tabla `documento`
Tabla principal del sistema.

| Campo        | Descripción |
|--------------|------------|
| id           | ID del documento |
| nombre       | Nombre del documento |
| contenido    | Contenido del documento |
| codigo       | Código generado automáticamente |
| consecutivo  | Número consecutivo por tipo/proceso |
| tipo_id      | FK tipo_documento |
| proceso_id   | FK proceso |

---

## Scripts de Base de Datos

Los scripts necesarios se encuentran en:
- `01_schema.sql` → Creación de tablas (DDL)
- `02_seed.sql` → Datos iniciales (DML)

## Instalación
- Clonar repositorio
- Instalalr dependencias. composer install


## Crear base de datos
- Nombre document_crud
- Importar en el siguente orden
- database/sql/01_schema.sql
- database/sql/02_seed.sql

## Configuración de credenciales en la BD
- app/Core/Database.php

## URL del proyecto 
- http://localhost/document-crud/public

## Credenciales de acceso 
- username: admin
- pasword: 123456

## Seguridad implementada
-	Middleware de autenticación
-	Middleware CSRF
-	Session hardening
-	Sanitización de salidas
-	Manejo global de excepciones
-	Logging de errores

##  Testing

El proyecto incluye pruebas unitarias utilizando **PHPUnit 12** para validar la lógica de negocio del `DocumentoService`.

###  ¿Qué valida?

Se prueban los siguientes casos:

1. Generación correcta del código documental  
   - `INS-ING-1`
2. Incremento correcto del consecutivo  
   - `INS-ING-2`
3. Delegación correcta al Repository en:
   - update
   - delete
   - search
4. Recalculo automático del código cuando cambia tipo o proceso.