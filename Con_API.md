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
```

---

## Objetivos del proyecto

El objetivo principal del proyecto es desplegar una aplicación web funcional conectada a una base de datos relacional utilizando contenedores Docker y herramientas de orquestación.

### Objetivos específicos

- Desplegar una base de datos MySQL en un contenedor Docker.
- Desarrollar una aplicación web PHP que consulte datos desde MySQL.
- Utilizar volúmenes Docker para garantizar la persistencia de los datos.
- Gestionar el despliegue mediante Portainer.
- Documentar el proceso y las incidencias encontradas.

---

## Tecnologías utilizadas

| Tecnología      | Descripción |
|----------------|-------------|
| Docker         | Plataforma de contenedores utilizada para el despliegue |
| Docker Compose | Orquestación de múltiples servicios |
| Portainer      | Gestión visual de contenedores y stacks |
| MySQL 8.0      | Sistema gestor de bases de datos |
| PHP 8.2        | Lenguaje de programación de la aplicación web |
| Apache         | Servidor web |
| phpMyAdmin     | Administración de la base de datos |

---

## Funcionamiento del sistema

El sistema está compuesto por tres contenedores que se comunican entre sí mediante una red Docker interna creada automáticamente por Docker Compose.

- El contenedor web ejecuta Apache y PHP.
- El contenedor db ejecuta MySQL y expone el servicio internamente.
- El contenedor phpmyadmin se conecta a la base de datos para su administración.

La aplicación web se conecta a MySQL utilizando el nombre del servicio `db` como host, aprovechando la resolución DNS interna de Docker.

---

## Persistencia de datos

Para garantizar que los datos no se pierdan al reiniciar los contenedores, se utiliza un volumen Docker:

- `pokemon_mysql_data`

Este volumen almacena los datos de MySQL en el host y permite que la información persista aunque los contenedores sean eliminados o recreados.

---

## Inicialización de la base de datos

La base de datos se inicializa automáticamente mediante el archivo `init.sql`, que se ejecuta en el primer arranque del contenedor MySQL.

Este script:

- Crea la base de datos `pokemon`.
- Crea la tabla `pokedex`.
- Inserta los 151 Pokémon correspondientes a la primera generación.

---

## Despliegue con Portainer

El despliegue del proyecto se realiza mediante un stack en Portainer, lo que permite gestionar los servicios de forma visual.

Portainer permite:

- Controlar el estado de los contenedores.
- Acceder a los logs.
- Gestionar volúmenes y redes.
- Modificar el stack sin utilizar la línea de comandos.

---

## Justificación de decisiones técnicas

Se ha elegido Docker como tecnología principal debido a su portabilidad y facilidad de despliegue.

MySQL se utiliza como base de datos relacional por su estabilidad y uso extendido.  
PHP se ha seleccionado por su integración sencilla con MySQL.  
Portainer se emplea para simplificar la administración de contenedores.

---

## Limitaciones del proyecto

- La aplicación web solo permite la visualización de datos.
- No se implementa autenticación de usuarios.
- El diseño de la interfaz es básico.

Estas limitaciones se deben a que el proyecto está enfocado en el despliegue y la infraestructura.

---

## Uso del repositorio

1. Clonar el repositorio.
2. Desplegar el stack mediante Docker Compose o Portainer.
3. Acceder a la aplicación web desde el navegador.
4. Administrar la base de datos mediante phpMyAdmin.

---

## Requisitos previos

- Docker instalado
- Docker Compose instalado
- Acceso a Portainer

---

## Notas finales

Este proyecto tiene fines educativos y está orientado a la práctica de despliegue de servicios con Docker y Portainer.
