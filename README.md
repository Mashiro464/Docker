```md
# Proyecto: Pokédex con MySQL y Docker (Portainer)

## Descripción general
Este proyecto consiste en el despliegue de una aplicación web Pokédex conectada a una base de datos MySQL real, utilizando contenedores Docker y gestionado mediante Portainer.

La aplicación muestra un listado de Pokémon almacenados en una base de datos MySQL, demostrando el uso de contenedores, volúmenes persistentes y comunicación entre servicios.

---

## Arquitectura del proyecto
El sistema está compuesto por tres servicios principales:

- MySQL 8.0 como sistema gestor de base de datos
- Aplicación web PHP con Apache
- phpMyAdmin para la administración de la base de datos

Todos los servicios se orquestan mediante Docker Compose.

---

## Estructura del proyecto

```text
/opt/pokemon-mysql
├── docker-compose.yml
├── Dockerfile
├── db/
│   └── init.sql
└── www/
    └── index.php
