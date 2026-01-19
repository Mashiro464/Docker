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

---

Contenedores utilizados
Servicio	Imagen utilizada
Base de datos	mysql:8.0
Web	Imagen propia (php:8.2-apache)
phpMyAdmin	phpmyadmin:latest

Configuración
Base de datos
Nombre: pokemon

Usuario: pokemonuser

Contraseña: pokemonpass

Tabla principal: pokedex

Puertos utilizados
Servicio	Puerto
Web	8083
phpMyAdmin	8084
MySQL	3307

Docker Compose
yaml
Copiar código
services:
  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: pokemon
      MYSQL_USER: pokemonuser
      MYSQL_PASSWORD: pokemonpass
      MYSQL_ROOT_PASSWORD: rootpass
    volumes:
      - pokemon_mysql_data:/var/lib/mysql
      - ./db/init.sql:/docker-entrypoint-initdb.d/init.sql

  web:
    image: pokemon_web_php:1.0
    environment:
      DB_HOST: db
      DB_USER: pokemonuser
      DB_PASSWORD: pokemonpass
      DB_NAME: pokemon
    ports:
      - "8083:80"

  phpmyadmin:
    image: phpmyadmin:latest
    environment:
      PMA_HOST: db
    ports:
      - "8084:80"

volumes:
  pokemon_mysql_data:
Acceso a la aplicación
Aplicación web:
http://IP_DEL_SERVIDOR:8083

phpMyAdmin:
http://IP_DEL_SERVIDOR:8084
Usuario: root
Contraseña: rootpass

Datos cargados
La base de datos se inicializa automáticamente con 151 Pokémon correspondientes a la primera generación, cargados mediante el script init.sql.

Verificación del sistema
bash
Copiar código
docker exec -it pokemon_db mysql -uroot -prootpass \
-e "USE pokemon; SELECT COUNT(*) FROM pokedex;"
Resultado esperado:

text
Copiar código
151
Capturas del proyecto
Aplicación web Pokédex

Stack desplegado en Portainer

Base de datos en phpMyAdmin

Incidencias encontradas y soluciones
Incidencia 1: Stack en estado limitado en Portainer
Causa:
El stack fue levantado inicialmente desde la línea de comandos y no desde Portainer.

Solución:
Detener el stack y desplegarlo nuevamente desde Portainer para que quede completamente gestionado.

Incidencia 2: Error de acceso a la imagen (pull access denied)
Causa:
Portainer intentaba descargar una imagen que solo existía de forma local en el servidor.

Solución:
Asignar un tag correcto a la imagen local y utilizar image en lugar de build en el archivo docker-compose.yml.

Incidencia 3: El script init.sql no se ejecutaba
Causa:
MySQL solo ejecuta los scripts de inicialización la primera vez que se crea el volumen de datos.

Solución:
Eliminar el volumen y recrear el stack para forzar la ejecución del script.

Incidencia 4: Contenedor inexistente
Causa:
Se intentó ejecutar un comando sobre un contenedor que no estaba en ejecución.

Solución:
Verificar previamente los contenedores activos mediante el comando docker ps.

Posibles mejoras
Implementar operaciones CRUD completas desde la aplicación web

Añadir búsqueda por nombre o tipo de Pokémon

Incorporar paginación de resultados

Añadir más generaciones de Pokémon

Conclusión
El proyecto demuestra el despliegue correcto de una aplicación web conectada a una base de datos MySQL mediante contenedores Docker, utilizando Portainer para su gestión. Se cumplen los objetivos de persistencia de datos, comunicación entre servicios y organización del entorno.
